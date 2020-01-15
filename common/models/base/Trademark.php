<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "trademark".
 *
 * @property int $id
 * @property string $title
 * @property string $avatar
 * @property string $describe
 * @property int $serial
 * @property string $content
 * @property int $display_homepage
 * @property int $featured
 * @property int $status
 * @property string $slug
 * @property string $key
 * @property string $code
 * @property string $link
 * @property int $example
 *
 * @property Product[] $products
 */
class Trademark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trademark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['describe', 'content', 'code'], 'string'],
            [['serial', 'display_homepage', 'featured', 'status', 'example'], 'integer'],
            [['title', 'avatar', 'slug', 'key', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'avatar' => Yii::t('app', 'Avatar'),
            'describe' => Yii::t('app', 'Describe'),
            'serial' => Yii::t('app', 'Serial'),
            'content' => Yii::t('app', 'Content'),
            'display_homepage' => Yii::t('app', 'Display Homepage'),
            'featured' => Yii::t('app', 'Featured'),
            'status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('app', 'Slug'),
            'key' => Yii::t('app', 'Key'),
            'code' => Yii::t('app', 'Code'),
            'link' => Yii::t('app', 'Link'),
            'example' => Yii::t('app', 'Example'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['trademark_id' => 'id']);
    }
}
