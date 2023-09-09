<div class="block block-brands">
    <div class="container">
        <div class="block-brands__slider">
            <div class="owl-carousel">
                <?php foreach ($brands as $brand): ?>
                    <div class="block-brands__item">
                        <img src="/brand/<?= $brand->file ?>" width="136" height="32" alt="<?= $brand->name ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>