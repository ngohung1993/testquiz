<?php

namespace common\models;

use yii\db\ActiveRecord;

class Topic extends base\Topic
{
    const CHO_DUYET = 0;
    const DUYET = 1;
    const KHONG_DUYET = 2;
    const KHO_USER = 3;

    const ACTIVE = 1;
    const NO_ACTIVE = 0;

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
            self::CHO_DUYET => 'bg-yellow',
            self::DUYET => 'bg-blue',
            self::KHONG_DUYET => 'bg-red',
            self::KHO_USER => 'bg-red'
        ];
    }

    public function statusLabel()
    {
        return [
            self::CHO_DUYET => 'Chờ duyệt',
            self::DUYET => 'Đã duyệt',
            self::KHONG_DUYET => 'Không được duyệt',
            self::KHO_USER => 'Lưu nháp'
        ];
    }

    public function statusIcon()
    {
        return [
            self::CHO_DUYET => 'fa fa-clock-o',
            self::DUYET => 'fa fa-check-square-o',
            self::KHONG_DUYET => 'fa fa-ban',
            self::KHO_USER => 'fa fa-bookmark-o'
        ];
    }

    public function getExtensionImg()
    {
        $extension = str_replace('.', '', substr($this->file_exam, -4));

        $img = '/uploads/advertises/icon-' . $extension . '.png';

        return $img;
    }

    public function getAvatar()
    {
        return $this->avatar ? $this->avatar : 'avatar-default';
    }
}