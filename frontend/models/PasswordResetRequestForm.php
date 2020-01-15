<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Không có tài khoản nào trùng với email bạn đã nhập!'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        $new_password = $this->randomPassword();

        $user->setPassword($new_password);
        $user->save();

        return $this->myEmail($this->email, $new_password, $user);
    }

    public function myEmail($email, $new_password, $user)
    {

        $mail = new PHPMailer(true);

        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();

        $mail->SMTPDebug = 0;

        $mail->Host = 'smtp.gmail.com';

        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = 'cskhtigerweb@gmail.com';

        $mail->Password = '270295thai';

        $mail->setFrom('cskhtigerweb@gmail.com', 'TIGERWEB.VN');

        $mail->addAddress($email, $user['email']);

        $mail->Subject = 'Reset Password';

        $body = file_get_contents('./../../uploads/core/reset-password.html');

        $data = ['new_password' => $new_password, 'username' => $user->username, 'last_name' => $user->name];

        foreach ($data as $key => $value) {
            $body = str_replace('{{' . $key . '}}', $value, $body);
        }

        $mail->msgHTML($body);

        $mail->AltBody = 'This is a plain-text message body';

        return $mail->send();
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
