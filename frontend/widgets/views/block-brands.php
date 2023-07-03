<div class="block block-brands">
    <div class="container">
        <div class="block-brands__slider">
            <div class="owl-carousel">
                <?php foreach ($brands as $brand): ?>
                    <div class="block-brands__item">
                        <img src="brand/<?= $brand->file ?>" alt="<?= $brand->name ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>