<?php

use yii\helpers\Url;

/** @var \common\models\shop\Tag $tags */
/** @var \frontend\controllers\TagController $language */

?>
<div class="block-sidebar__item">
    <div class="widget-tags widget">
        <h4 class="widget__title"><?= Yii::t('app', 'Хмара тегів') ?></h4>
        <div class="tags tags--lg">
            <div class="tags__list">
                <?php foreach ($tags as $tag): ?>
                    <a href="<?= Url::to(['tag/view', 'slug' => $tag->slug]) ?>">
                    <?php if ($language == 'en'): ?>
                        <?= $tag->name_en ?>
                    <?php elseif ($language == 'ru'): ?>
                        <?= $tag->name_ru ?>
                    <?php else: ?>
                        <?= $tag->name ?>
                    <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
