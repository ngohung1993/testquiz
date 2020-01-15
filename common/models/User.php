<?php

namespace common\models;

use common\models\base;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $permission
 * @property string $avatar
 * @property integer $auth
 */
class User extends base\User
{
    const ROLE_ADMIN = 2;
    const ROLE_CENSOR = 3;
    const ROLE_EDITOR = 4;
    const ROLE_CASHIER = 5;

    const ROLE_USER = 6;

    const AUTH_FACEBOOK = 1;
    const AUTH_GOOGLE = 2;

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

    public function getRoleLabel()
    {
        $key = $this->permission;
        $arr = $this->roleLabel();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'N/A';
    }

    public function roleLabel()
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_CENSOR => 'Kiểm duyệt viên',
            self::ROLE_EDITOR => 'Biên tập viên',
            self::ROLE_CASHIER => 'Thanh toán viên',
            self::ROLE_USER => 'Thành viên'
        ];
    }

    public function getRoleBg()
    {
        $key = $this->permission;
        $arr = $this->roleBg();

        if (isset($arr[$key])) {
            return $arr[$key];
        }

        return 'label-danger';
    }

    public function roleBg()
    {
        return [
            self::ROLE_ADMIN => 'label-warning',
            self::ROLE_CENSOR => 'label-default',
            self::ROLE_EDITOR => 'label-default',
            self::ROLE_CASHIER => 'label-default',
            self::ROLE_USER => 'label-success',
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

    public function statusLabel()
    {
        return [
            self::STATUS_ACTIVE => 'Hoạt động',
            self::STATUS_DELETED => 'Ngừng hoạt động'
        ];
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

    public function statusBg()
    {
        return [
            self::STATUS_ACTIVE => 'bg-blue',
            self::STATUS_DELETED => 'bg-red'
        ];
    }

    public function getAvatar()
    {
        $avatar = $this['avatar'] ? $this['avatar'] : '/theme/images/default-size-32x32-znd.png';
        if ($this->auth == User::AUTH_FACEBOOK) {
            $avatar = 'https://graph.facebook.com/' . $this['avatar'] . '/picture?type=large';
        }
        return $avatar;
    }
}