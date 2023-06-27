<div class="col-12 col-lg-6">
    <h4 class="contact-us__header card-title">Залиште нам повідомлення</h4>
    <div class="alert alert-success" style="display: none;" id="success-message" role="alert">
        Вітаемо Ваше повідомлення -- надіслане !!!
    </div>
    <form id="form-messages">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="messages-name">Ваше ім'я</label>
                <input type="text" name="name" class="form-control"
                       oninvalid="this.setCustomValidity('Укажіть будь ласка Ваше ім’я')"
                       oninput="this.setCustomValidity('')"
                       placeholder="Ваше ім'я" required>
            </div>
            <div class="form-group col-md-6">
                <label for="messages-email">Email</label>
                <input type="text" name="email" class="form-control"
                       placeholder="Адреса електронної пошти"
                       oninvalid="this.setCustomValidity('Укажіть будь ласка Ваш email')"
                       oninput="this.setCustomValidity('')"
                       required>
            </div>
        </div>
        <div class="form-group">
            <label for="messages-subject">Тема</label>
            <input type="text" name=subject class="form-control"
                   placeholder="Тема"
                   oninvalid="this.setCustomValidity('Укажіть будь ласка Тему')"
                   oninput="this.setCustomValidity('')"
                   required>
        </div>
        <div class="form-group">
            <label for="messages-messages">Повідомлення</label>
            <textarea name=message class="form-control" rows="4"
                      oninvalid="this.setCustomValidity('Напишіть будь ласка Ваше повідомлення')"
                      oninput="this.setCustomValidity('')"
                      required></textarea>
        </div>
        <button type="submit" id="messages-form-submit" class="btn btn-primary btn-lg">Відправити</button>
    </form>
</div>

<style>
    #success-message {
        position: absolute;
        top: -13%;
        left: 0;
        width: 100%;
    }

    #form-messages {
        position: relative;
    }
</style>

<?php
$js = <<<JS
    $('#form-messages').submit(function(event) {
    event.preventDefault();
    var subject = $('input[name=subject]').val();
    var name = $('input[name=name]').val();
    var email = $('input[name=email]').val();
    var mess = $('textarea[name=message]').val();
    if (name !== '') {
        $.ajax({
            url: '/contact/create',
            type: 'post',
            data: {
                subject: subject,
                name: name,
                email: email,
                mess: mess
            },
            success: function(data) {
                $('#form-messages')[0].reset();
                 $('#success-message').fadeIn(); // Показать сообщение

    setTimeout(function() {
        $('#success-message').fadeOut(); // Скрыть сообщение после 2 секунд
    }, 2500);
            },
            error: function(data) {
                console.log("Ошибка", data);
            }
        });
    }
    return false;
});


JS;
$this->registerJs($js);

?>