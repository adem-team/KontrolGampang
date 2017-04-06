<?php
/**
 * Created by PhpStorm.
 * User: ptr.nov
 * Date: 10/08/15
 * Time: 19:44
 */
namespace common\components;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use Yii\base\Model;
use yii\data\ArrayDataProvider;

use common\models\UserloginSearch;
use common\models\Userlogin;
use common\models\ModulMenuSearch;
/** 
  * Components User Option
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
*/
class Useroption extends Component{	
	
	/** Example usage
	  * Example1 		: Yii::$app->getUserOpt->user();
	  * Example3 Field	: Yii::$app->getUserOpt->Profile_user()->username;
	  * Example2 Join 	: Yii::$app->getUserOpt->user()->emp->EMP_NM;
	*/	 
	public function User(){
		if (!Yii::$app->user->isGuest){
			$ModelUser = Userlogin::find()->where(['id'=>Yii::$app->user->identity->id])->asArray()->one();
			if (count($ModelUser)<>0){ //RECORD TIDAK ADA 
			//$userid=$ModelProfile->user->id;			
			//$deptid=$ModelProfile->emp->DEP_ID;			
				return $ModelUser;
			} else{
				return 0;
			}
		}		 
	}
	
	public function UserMenu(){
		//Get Model data Menu, $param 'UserUnix'=>'20170404081602',
		$searchModel = new ModulMenuSearch(['UserUnix'=>'20170404081602']);
		$dataProvider = $searchModel->searchUserMenu(Yii::$app->request->queryParams);
		$modelMenu=$dataProvider->getModels();
		//Grouping Menu by field, MODUL_GRP
		$groupingMenu= Yii::$app->arrayBantuan->array_group_by($modelMenu,'MODUL_GRP');

		$getMenu='';
		$menuBegin='<ul class="sidebar-menu" >';
		$menuEnd='</ul>';

		foreach($groupingMenu as $row0 => $val0){
			//$menu[]=$row0; //get ID Group
			$menuHeader='';
			$tmpSub='';			
			foreach($groupingMenu[$row0] as $row1 => $val1){
				$menuSub1='';
				//Array Bantuan - | 1= not treeview-menu; >1 = have  treeview-menu;
				$cntHdr=count(Yii::$app->arrayBantuan->array_find($modelMenu,'MODUL_GRP',$row0));
				if($val1['MODUL_ID']==$val1['MODUL_GRP']){
					$iconHead=$val1['BTN_ICON']!=''?'fa-'.$val1['BTN_ICON']:'fa-circle-o';
					if($cntHdr==1){
						$menuHeader='
							<a href="'.$val1['BTN_URL'].'">
								 <i class="fa '.$iconHead.'"></i>
								 <span>'.$val1['BTN_NM'].'</span>
							</a>				
						';
					}else{
						$menuHeader='
							<a href="'.$val1['BTN_URL'].'">
								 <i class="fa '.$iconHead.'"></i>
								 <span>'.$val1['BTN_NM'].'</span>
								 <i class="fa fa-angle-left pull-right"></i>
							</a>				
						';
					}			
				}else{
					$iconSub1=$val1['BTN_ICON']!=''?'fa-'.$val1['BTN_ICON']:'fa-angle-double-right';
					//$tmpSub.='<li>'.$val1['BTN_NM'].'</li>';				
					$tmpSub.='
						<li><a href="'.$val1['BTN_URL'].'"><i class="fa '.$iconSub1.'"></i>'.$val1['BTN_NM'].'</a></li>
					';				
				};		
			}
			
			$menuSub1=$tmpSub!=''?'<ul class="treeview-menu">'.$tmpSub.'</ul>':'';
			$getMenu=$getMenu.'<li class="treeview">'.$menuHeader.$menuSub1.'</li>';
		};
		$menu=$menuBegin.$getMenu.$menuEnd;
		return $menu;
	}
	
	
	 
	 // public function Profile_user(){
		// $UserloginSearch = new UserloginSearch();
		// if (!Yii::$app->user->isGuest){
			// $ModelProfile = UserloginSearch::findUserAttr(Yii::$app->user->identity->id)->one();
			// if (count($ModelProfile)<>0){ //RECORD TIDAK ADA 
				//$userid=$ModelProfile->user->id;			
				//$deptid=$ModelProfile->emp->DEP_ID;			
				// return $ModelProfile;
			// } else{
				// return 0;
			// }
		// }
	 // }
	 
	  /** 		 
	  * Refrensi 		  
	  * Fields 				: id,username,auth_key,password_hash,password_reset_token,email,status,created_at,updated_at,access_token,EMP_ID,avatar,avatarImage  
	  * mdlpermission->field: ID,USER_ID,MODUL_ID,STATUS,BTN_CREATE,BTN_EDIT,BTN_DELETE,BTN_VIEW
	  *						  BTN_PROCESS1,BTN_PROCESS2,BTN_PROCESS3,BTN_PROCESS4,BTN_PROCESS5,
	  *						  BTN_SIGN1,BTN_SIGN2,BTN_SIGN3,BTN_SIGN4,BTN_SIGN5,
	  *						  CREATED_BY,UPDATED_BY,UPDATED_TIME
	  *
	  * Declaration Components
	  * Default: Yii::$app->getUserOpt->Modul_akses($modul_id);
	  * UseObject: Yii::$app->getUserOpt->Modul_akses(1)->emp->Field;
	  * Yii::$app->getUserOpt->Modul_akses(1)->mdlpermission[0]->ID
	  *
	  * Example usage modul_id=1
	  * Example3 : Yii::$app->getUserOpt->Modul_akses(1)->mdlpermission[0]->MODUL_ID;
	  * Example4 : $modulakses=Yii::$app->getUserOpt->Modul_akses(1);
	  *			   $modulakses->mdlpermission[0]->MODUL_ID;	  Description hasMany join 
	*/
	 public function Modul_akses($modul_id){	
		/*
		 * @since 1.2 
		*/
		if (!Yii::$app->user->isGuest){
			$qry="SELECT * FROM dbm001.user a LEFT JOIN dbm002.a0001 b on b.EMP_ID=a.EMP_ID LEFT JOIN 
				  dbm001.modul_permission c on c.USER_ID=a.id WHERE a.id='".Yii::$app->user->identity->id."' AND c.MODUL_ID='".$modul_id."' AND EMP_STS<>'3' GROUP BY c.id ";
			$userPermission=Mdlpermission::findBySql($qry)->one();
			return $userPermission!=''?$userPermission:''; 
		};//else{}
		/*
		 * @since 1.1 
		 * Problem query hasMany
		*/		
		/* $UserloginSearch = new UserloginSearch();	
		$ModelAksesModul = UserloginSearch::findModulAcess(Yii::$app->user->identity->id,$modul_id)->one();
		if (count($ModelAksesModul)<>0){ //RECORD TIDAK ADA
			//$userid=$ModelAksesModul->username;			
			//$deptid=$ModelAksesModul->emp->DEP_ID;
			//$deptid=$ModelAksesModul->mdlpermission[0]->MODUL_ID;				
			return $ModelAksesModul;
		} else{
			return 0;
		} */	 
	 } 
	 
	 public function Modul_aksesDeny($modul_id){	
		/*
		 * Modul	: Permission Allow or Danied.
		 * @since	: 1.3 
		 * update 	: 01/02/2017.
		*/
		if (!Yii::$app->user->isGuest){
			$aryRslt= new ArrayDataProvider([
				'allModels'=>Yii::$app->db_esm->createCommand("
					SELECT * FROM dbm001.user a LEFT JOIN dbm002.a0001 b on b.EMP_ID=a.EMP_ID LEFT JOIN 
					  dbm001.modul_permission c on c.USER_ID=a.id WHERE a.id='".Yii::$app->user->identity->id."' AND c.MODUL_ID='".$modul_id."' AND EMP_STS<>'3' GROUP BY c.id
				")->queryAll(), 
				'pagination' => [
						'pageSize' => 200,
				],				 
			]);
			$resltModel=$aryRslt->getModels();
			foreach($resltModel[0] as $row => $value){
				$reslt[]=$value;
			};
			//Btn Create - Btn Sign5 array(52-67).			
			for ($x = 53; $x <= 67; $x++) {
				//$rsltDeny[]=$reslt[$x].',';
				$val=$reslt[$x]!=''?$reslt[$x]:0;
				$rsltVal=$rsltVal + $val;
			};
			$rsltDeny=$rsltVal!=0?1:0;
			return $rsltDeny;
		}
		
	 }
}