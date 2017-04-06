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
	
	/*
	 * TREE MENU 
	 * Yii::$app->getUserOpt->UserMenu() //set menuLeft.
	*/
	public function UserMenu(){
		if (!Yii::$app->user->isGuest){
			$modelUser = Userlogin::find()->where(['id'=>Yii::$app->user->identity->id])->asArray()->one();
			//Get Model data Menu, $param 'UserUnix'=>'20170404081602',
			$searchModel = new ModulMenuSearch(['UserUnix'=>$modelUser['ACCESS_UNIX']]);
			//$searchModel = new ModulMenuSearch(['UserUnix'=>'20170404081602']);
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
					if($val1['modulMenuTbl']['STATUS']==1 ){
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
				}			
				$menuSub1=$tmpSub!=''?'<ul class="treeview-menu">'.$tmpSub.'</ul>':'';
				$getMenu=$getMenu.'<li class="treeview">'.$menuHeader.$menuSub1.'</li>';			
			};
			$menu=$menuBegin.$getMenu.$menuEnd;
			return $menu;
		}
	}
	
	/*
	 * PERMISSION MODUL MENU
	 * Yii::$app->getUserOpt->UserMenuPermission(3)['BTN_SIGN1'] //set controllers beforeAction($action)
	*/
	public function UserMenuPermission($valueMenu){
		if (!Yii::$app->user->isGuest){
			$modelUser = Userlogin::find()->where(['id'=>Yii::$app->user->identity->id])->asArray()->one();
			$searchModel = new ModulMenuSearch(['UserUnix'=>$modelUser['ACCESS_UNIX']]);
			$dataProvider = $searchModel->searchUserMenu(Yii::$app->request->queryParams);
			$modelMenu=$dataProvider->getModels();
			//return $modelMenu;
			//Yii::$app->arrayBantuan->array_find($modelMenu, 'ID',3)
			return Yii::$app->arrayBantuan->array_find($modelMenu, 'ID',$valueMenu)[0]['modulMenuTbl'];
		}
	}
	
	
}