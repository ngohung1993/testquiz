<?php

namespace common\models;

use yii\helpers\Url;
use Yii;
use common\models\base;
use yii\db\ActiveRecord;

class Post extends base\Post
{

    public $category_child;
    public $tab_post;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => time()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['category_child', 'string'],
            ['tab_post', 'string']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'status' => Yii::t('backend', 'Status'),
            'featured' => Yii::t('backend', 'Featured'),
            'display_homepage' => Yii::t('backend', 'Display Homepage'),
        ]);
    }

    public function getLink()
    {
        return $this->link ? $this->link : Url::to(['site/post', 'slug' => $this->slug]);
    }
}
