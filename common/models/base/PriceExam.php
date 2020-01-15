<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "price_exam".
 *
 * @property int $id
 * @property int $price
 * @property int $price_discount
 * @property int $created_at
 * @property int $updated_at
 */
class PriceExam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'price_discount', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'price' => Yii::t('app', 'Price'),
            'price_discount' => Yii::t('app', 'Price Discount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
