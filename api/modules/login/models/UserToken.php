<?php

namespace api\modules\login\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use common\models\User;
use api\modules\login\models\UserImage;
use api\modules\login\models\UserProfil;
use api\modules\login\models\Corp;

class UserToken extends \yii\db\ActiveRecord
//class Userlogin extends ActiveRecord implements IdentityInterface
{
	
	const SCENARIO_USER = 'createuser';
	
	public $new_pass;
    
	
	public static function getDb()
    {
        return Yii::$app->get('api_dbkg');
    }
	
	public static function tableName()
    {
        return '{{user}}';
    }

    public function rules()
    {
        return [
			[['username','auth_key','password_hash','POSITION_ACCESS'], 'required','on' => self::SCENARIO_USER],		
			[['username','auth_key','password_hash','password_reset_token'], 'string'],
			[['update_at'],'safe'],
			[['ACCESS_UNIX','UUID'], 'safe'],
		];
    }

	public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'User Name'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'ACCESS_UNIX' => Yii::t('app', 'ACCESS_UNIX'),
			'UUID' => Yii::t('app', 'UUID')			
        ];
    }
	
	public function fields()
	{
		return [		
			'access_token'=>function($model){
				return $model->auth_key;
			},	
			'ACCESS_UNIX'=>function($model){
				return $model->ACCESS_UNIX;
			},
			'UUID'=>function($model){
				return $model->UUID;
			}				 	
		];
	} 	
}
?>
