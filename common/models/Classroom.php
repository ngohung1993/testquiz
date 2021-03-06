<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class Classroom extends base\Classroom
{
    const ACTIVE = 1;
    const NO_ACTIVE = 0;

    /**
     * @return array
     */
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
}
