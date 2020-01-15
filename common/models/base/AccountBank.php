<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "account_bank".
 *
 * @property int $id
 * @property string $account_name
 * @property string $name_bank
 * @property string $account_number
 * @property string $bank_branch
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $type
 *
 * @property User $user
 * @property TransactionHistory[] $transactionHistories
 */
class AccountBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_name', 'name_bank', 'account_number', 'bank_branch', 'user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status', 'type'], 'integer'],
            [['account_name', 'name_bank', 'account_number', 'bank_branch'], 'string', 'max' => 255],
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
            'account_name' => 'Account Name',
            'name_bank' => 'Name Bank',
            'account_number' => 'Account Number',
            'bank_branch' => 'Bank Branch',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionHistories()
    {
        return $this->hasMany(TransactionHistory::className(), ['account_id' => 'id']);
    }
}
