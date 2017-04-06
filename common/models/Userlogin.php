<?php

namespace common\models;

use Yii;

class Userlogin extends \yii\db\ActiveRecord
{
	const SCENARIO_USER = 'createuser';

	public static function getDb()
	{
		/* Author -ptr.nov- : HRD | Dashboard I */
		return \Yii::$app->db;
	}
	public $new_pass;
    
	public static function tableName()
    {
        return '{{user}}';
    }

    public function rules()
    {
        return [
			[['username','auth_key','password_hash','POSITION_ACCESS'], 'required','on' => self::SCENARIO_USER],
			[['new_pass','username','status'], 'required','on' =>'updateuser'],
			[['username','auth_key','password_hash','password_reset_token'], 'string'],
			[['email'], 'string'],
			[['id','status','create_at','update_at'],'safe'],
			[['ACCESS_UNIX','ACCESS_GROUP','ACCESS_SITE','ONLINE','UUID'], 'safe'],
		];
    }

	public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'User.ID'),
            'username' => Yii::t('app', 'User Name'),
			'auth_key' => Yii::t('app', 'Access Token'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'password_reset_token' => Yii::t('app', 'Reset Password'),
			'email' => Yii::t('app', 'Email'),
			'create_at' => Yii::t('app', 'create_at'),
			'update_at' => Yii::t('app', 'update_at'),
			'ACCESS_UNIX' => Yii::t('app', 'ACCESS_UNIX'),
			'ACCESS_GROUP' => Yii::t('app', 'ACCESS_GROUP'),
			'ACCESS_SITE' => Yii::t('app', 'ACCESS_SITE'),
			'ONLINE' => Yii::t('app', 'ONLINE'),
			'UUID' => Yii::t('app', 'UUID')			
        ];
    }
	
	public function fields()
	{
		return [
			'id'=>function($model){
				return $model->id;
			},
			'username'=>function($model){
				return $model->username;
			},
			'auth_key'=>function($model){
				return $model->auth_key;
			},		
			'password_hash'=>function($model){
				return $model->password_hash;
			},		
			'password_reset_token'=>function($model){
				return $model->password_reset_token;
			},		
			'email'=>function($model){
				return $model->email;
			},		
			'ACCESS_UNIX'=>function($model){
				return $model->ACCESS_UNIX;
			},	
			'ACCESS_GROUP'=>function($model){
				return $model->ACCESS_GROUP;
			},
			'ACCESS_SITE'=>function($model){
				return $model->ACCESS_SITE;
			},
			'ONLINE'=>function($model){
				return $model->ONLINE;
			},
			'UUID'=>function($model){
				return $model->UUID;
			},		
		
		];
	}

  
	/**
     * Generates password hash from password signature
     *
     * @param string $SIGPASSWORD
	 * @author ptrnov  <piter@lukison.com>
	 * @since 1.1
     */
    public function setPassword_login($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

	/**
     * return Password Signature
     *
     * @param string $SIGPASSWORD
	 * @author ptrnov  <piter@lukison.com>
	 * @since 1.1
     */
	public function validateOldPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);

    }

}
