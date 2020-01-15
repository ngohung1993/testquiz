<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "audit_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $browser
 * @property string $ip
 * @property string $time
 * @property int $total
 *
 * @property User $user
 */
class AuditLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'audit_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'total'], 'integer'],
            [['time'], 'safe'],
            [['browser', 'ip'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'browser' => 'Browser',
            'ip' => 'Ip',
            'time' => 'Time',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
