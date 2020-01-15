<?php

namespace common\models;

use yii\db\ActiveRecord;

class ReportQuestion extends base\ReportQuestion
{
    const STATUS_SUCCESS = 4;
    const STATUS_PROCESSED = 3;
    const STATUS_WARNING_HENDLE = 2;
    const STATUS_ERROR= 1;

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