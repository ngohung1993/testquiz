<?php

namespace common\models;

use Yii;
use common\models\base;
use yii\db\ActiveRecord;
class Category extends base\Category
{
    const POST = 0;
    const TOPIC = 1;
    /**
     * @inheritdoc
     */

    public $_cats = [];

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

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'status' => Yii::t('backend', 'Status'),
        ]);
    }

    public function getParent($parent = Null, $leval = '')
    {
        $data = Category::find()->where(['status' => 1])->andwhere(['parent_id' => $parent])->all();
        $leval .= '|-- ';
        if ($data):
            foreach ($data as $iteam) {
                if ($iteam->parent_id == Null) {
                    $leval = '';
                }
                $this->_cats[$iteam->id] = $leval . $iteam->title;
                self::getParent($iteam->id, $leval);
            }
        endif;
        return $this->_cats;
    }

}
