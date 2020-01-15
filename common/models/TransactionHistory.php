<?php

namespace common\models;

use yii\db\ActiveRecord;

class TransactionHistory extends base\TransactionHistory
{
    const WITHDRAWAL = 1;
    const RECHARGE = 2;
    const BY_EXAM = 3;
    const SELL_EXAM = 4;

    const ADMIN_HANDLING = 0;
    const SUCCESS = 1;
    const FAILURE = 2;

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
    public function getStatusLabel()
    {
        $key = $this->status;
        $arr = $this->statusLabel();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function getStatusBg()
    {
        $key = $this->status;
        $arr = $this->statusBg();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function getStatusIcon()
    {
        $key = $this->status;
        $arr = $this->statusIcon();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function statusBg()
    {
        return [
            self::ADMIN_HANDLING=> 'btn btn-primary',
            self::SUCCESS => 'btn btn-success',
            self::FAILURE => 'btn btn-danger',
        ];
    }

    public function statusLabel()
    {
        return [
            self::ADMIN_HANDLING=> 'Adminh xử lý',
            self::SUCCESS => 'Thành công',
            self::FAILURE => 'Thất bại',
        ];
    }
    public function statusIcon()
    {
        return [
            self::ADMIN_HANDLING => 'fa fa-hourglass-end',
            self::SUCCESS => 'fa fa-check-square-o',
            self::FAILURE => 'fa fa-times',
        ];
    }

}