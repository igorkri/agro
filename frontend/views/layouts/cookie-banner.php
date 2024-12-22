<?php if (Yii::$app->request->cookies->getValue('cookies_accepted') !== '1'): ?>
    <div id="cookie-banner"
         class="cookie-banner">
        <span>Цей веб-сайт застосовує файли cookie та інші технології, щоб спростити ваш пошук, забезпечити зручність користування, проводити аналіз використання наших послуг і продуктів. </span>
        <button id="accept-cookies"
                class="btn btn-danger cookie-button">
            <?=Yii::t('app','Дати згоду')?>
        </button>
    </div>
    <style>
        #cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #000;
            color: #fff;
            padding: 15px;
            text-align: center;
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }
        #cookie-banner.hidden {
            opacity: 0;
        }
        .cookie-button {
            margin-left: 15px;
        }
    </style>
    <?php
    $this->registerJs(<<<JS
    document.getElementById('accept-cookies').addEventListener('click', function() {
        fetch('/site/accept-cookies', {
            method: 'POST',
            headers: {
                'X-CSRF-Token': yii.getCsrfToken()
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  const banner = document.getElementById('cookie-banner');
                  banner.classList.add('hidden'); // Добавляем класс для плавного исчезновения
                  setTimeout(() => {
                      banner.remove(); // Удаляем элемент после завершения анимации
                  }, 500); // Время соответствует transition в CSS
              }
          }).catch(error => console.error('Ошибка:', error));
    });
JS
    );
    ?>
<?php endif; ?>


