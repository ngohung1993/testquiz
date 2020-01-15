<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property string $ten
 * @property string $ten_tieng_anh
 * @property string $cap
 * @property int $province_id
 * @property double $phi_van_chuyen
 *
 * @property Province $province
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten', 'province_id'], 'required'],
            [['province_id'], 'integer'],
            [['phi_van_chuyen'], 'number'],
            [['ten', 'ten_tieng_anh', 'cap'], 'string', 'max' => 255],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ten' => Yii::t('app', 'Ten'),
            'ten_tieng_anh' => Yii::t('app', 'Ten Tieng Anh'),
            'cap' => Yii::t('app', 'Cap'),
            'province_id' => Yii::t('app', 'Province ID'),
            'phi_van_chuyen' => Yii::t('app', 'Phi Van Chuyen'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
}
