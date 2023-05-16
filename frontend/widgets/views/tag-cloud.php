

<div class="block-sidebar__item">
    <div class="widget-tags widget">
        <h4 class="widget__title">Хмара тегів</h4>
        <div class="tags tags--lg">
            <div class="tags__list">
                <?php foreach ($tags as $tag): ?>
                    <a href="/"><?= $tag->name ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
