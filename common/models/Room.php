<?php

namespace common\models;

use yii\db\ActiveRecord;

class Room extends base\Room
{
    const STATUS_CLOSED = 0;
    const STATUS_OPENING = 1;

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

    public function timeToMinutes()
    {
        $arr = explode(':', $this->completion_time);
        $min = ($arr[0] * 60) + ($arr[1]) + ($arr[2] > 30 ? 1 : 0);
        return $min == 0 ? $min + 1 : $min;
    }
}