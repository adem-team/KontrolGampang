<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "karyawan".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $KARYAWAN_ID
 * @property string $NAMA_DPN
 * @property string $NAMA_TGH
 * @property string $NAMA_BLK
 * @property string $KTP
 * @property string $TMP_LAHIR
 * @property string $TGL_LAHIR
 * @property string $GENDER
 * @property string $ALAMAT
 * @property string $STS_NIKAH
 * @property string $TLP
 * @property string $HP
 * @property string $EMAIL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class Karyawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'karyawan';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('production_api');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'KARYAWAN_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TGL_LAHIR', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ALAMAT', 'DCRP_DETIL'], 'string'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['KARYAWAN_ID'], 'string', 'max' => 30],
            [['NAMA_DPN', 'NAMA_TGH', 'NAMA_BLK', 'TMP_LAHIR', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['KTP', 'TLP', 'HP'], 'string', 'max' => 100],
            [['GENDER'], 'string', 'max' => 10],
            [['STS_NIKAH'], 'string', 'max' => 255],
            [['EMAIL'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'KARYAWAN_ID' => 'Karyawan  ID',
            'NAMA_DPN' => 'Nama  Dpn',
            'NAMA_TGH' => 'Nama  Tgh',
            'NAMA_BLK' => 'Nama  Blk',
            'KTP' => 'Ktp',
            'TMP_LAHIR' => 'Tmp  Lahir',
            'TGL_LAHIR' => 'Tgl  Lahir',
            'GENDER' => 'Gender',
            'ALAMAT' => 'Alamat',
            'STS_NIKAH' => 'Sts  Nikah',
            'TLP' => 'Tlp',
            'HP' => 'Hp',
            'EMAIL' => 'Email',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}
