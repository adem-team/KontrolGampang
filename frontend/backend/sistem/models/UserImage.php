<?php

namespace app\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "user_64".
 *
 * @property string $ACCESS_UNIX
 * @property string $USER_NM
 * @property string $CORP_64
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class UserImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_64';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_UNIX'], 'required'],
            [['CORP_64'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ACCESS_UNIX', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['USER_NM'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCESS_UNIX' => 'Access  Unix',
            'USER_NM' => 'User  Nm',
            'CORP_64' => 'Corp 64',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}
