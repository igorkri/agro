<?php

namespace console\controllers;

use common\models\User;
use Yii;

class AddUserController extends \yii\console\Controller
{
    /**
     * Добавление пользователя в таблицу user
     */
    public function actionAddUser()
    {
        $user = new User();
        $user->username = 'Пользователь';
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->password_hash = Yii::$app->security->generatePasswordHash('Пароль');
        $user->password_reset_token = null;
        $user->email = 'test@i.ua';
        $user->status = User::STATUS_ACTIVE;
        $user->created_at = time();
        $user->updated_at = time();
        $user->verification_token = null;

        if ($user->save()) {
            echo 'Пользователь успешно добавлен.';
        } else {
            echo 'Ошибка при добавлении пользователя: ' . implode(', ', $user->getErrors());
        }
    }

}