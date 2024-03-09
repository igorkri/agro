<?php

use yii\bootstrap5\ActiveForm;
use common\models\shop\ActivePages;

ActivePages::setActiveUser();

?>
<div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
    <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
            <h1 class="mb-0 fs-3">Увійти</h1>
            <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">Увійдіть до свого облікового запису, щоб продовжити.</div>
            <div class="mb-4">
                <label class="form-label">Логін</label>
                <input type="text" name="LoginForm[username]" class="form-control form-control-lg" />
            </div>
            <div class="mb-4">
                <label class="form-label">Пароль</label>
                <input type="password" name="LoginForm[password]" class="form-control form-control-lg" />
            </div>
            <div class="mb-4 row py-2 flex-wrap">
                <div class="col-auto me-auto">
                    <label class="form-check mb-0">
                        <input type="checkbox" name="LoginForm[rememberMe]" class="form-check-input" />
                        <span class="form-check-label">Запам'ятай мене</span>
                    </label>
                </div>
<!--                <div class="col-auto d-flex align-items-center"><a href="auth-forgot-password.html">Забули пароль?</a></div>-->
                <div class="col-auto d-flex align-items-center"><a href="/">Забули пароль?</a></div>
            </div>
            <div><button type="submit" class="btn btn-primary btn-lg w-100">Увійти</button></div>
        </div>
        <?php ActiveForm::end(); ?>

        <!-- <div class="sa-divider sa-divider--has-text">
            <div class="sa-divider__text">ИЛИ ПРОДОЛЖИТЬ</div>
        </div>
        <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
            <div class="d-flex flex-wrap me-n3 mt-n3">
                <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Google</button>
                <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Facebook</button>
                <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Twitter</button>
            </div>
            <div class="form-group mb-0 mt-4 pt-2 text-center text-muted">
                У вас нет аккаунта?
                <a href="signup">Зарегистрироваться</a>
            </div>
        </div> -->
    </div>
</div>