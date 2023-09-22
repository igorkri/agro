<?php

use yii\helpers\Url;

?>
<div class="block-sidebar__item">
    <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse
         data-collapse-opened-class="filter--opened">
        <h4 class="widget-filters__title widget__title">Фільтр</h4>
        <div class="widget-filters__list">
            <div class="widget-filters__item">
                <div class="filter" data-collapse-item>
                    <button type="button" class="filter__title" data-collapse-trigger>
                        Категорії
                        <svg class="filter__arrow" width="12px" height="7px">
                            <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                    <div class="filter__body" data-collapse-content>
                        <div class="filter__container">
                            <div class="filter-categories">
                                <ul class="filter-categories__list">
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category->parentId === null): ?>
                                            <li class="filter-categories__item filter-categories__item--parent">
                                                <svg class="filter-categories__arrow" width="6px"
                                                     height="9px">
                                                    <use xlink:href="/images/sprite.svg#arrow-rounded-left-6x9"></use>
                                                </svg>
                                                <a href="#" style="font-weight: 600;"><?php echo $category->name ?></a>
                                                <div class="filter-categories__counter"><?= $category->getCountProductCategory($category->id) ?></div>
                                            </li>
                                            <?php foreach ($categories as $child): ?>
                                                <?php if ($category->id === $child->parentId): ?>
                                                    <li class="filter-categories__item filter-categories__item--child">
                                                        <a
                                                                href="<?= Url::to(['category/catalog', 'slug' => $child->slug]) ?>"><?= $child->name ?></a>
                                                        <div class="filter-categories__counter"><?= $child->getCountProductCategoryChild($child->id) ?></div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-filters__item">
                <div class="filter" data-collapse-item>
                    <button type="button" class="filter__title" data-collapse-trigger>
                        Ціна
                        <svg class="filter__arrow" width="12px" height="7px">
                            <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                    <div class="filter__body" data-collapse-content>
                        <div class="filter__container">
                            <div class="filter-price" data-min="<?php echo $minPrice ?>"
                                 data-max="<?php echo $maxPrice ?>"
                                 data-from="3000" data-to="12000">
                                <div class="filter-price__slider"></div>
                                <div class="filter-price__title">Ціна: ₴ <span
                                            class="filter-price__min-value"></span> – ₴ <span
                                            class="filter-price__max-value"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-filters__item">
                <div class="filter" data-collapse-item>
                    <button type="button" class="filter__title" data-collapse-trigger>
                        Бренд
                        <svg class="filter__arrow" width="12px" height="7px">
                            <use xlink:href="/images/sprite.svg#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                    <div class="filter__body" data-collapse-content>
                        <div class="filter__container">
                            <div class="filter-list">
                                <div class="filter-list__list">
                                    <? foreach ($brands as $brand): ?>
                                        <?php if ($brand->getProductBrand($brand->id) > 0) { ?>
                                            <label class="filter-list__item ">
                                                <span class="filter-list__input input-radio">
                                                    <span class="input-radio__body">
                                                        <input class="input-radio__input"
                                                               name="filter_radio" type="radio">
                                                        <span class="input-radio__circle"></span>
                                                    </span>
                                                </span>
                                                <span class="filter-list__title">
                                                        <?= $brand->name ?>
                                                </span>
                                                <span class="filter-list__counter"><?= $brand->getProductBrand($brand->id) ?></span>
                                            </label>
                                        <?php } else { ?>
                                            <label class="filter-list__item  filter-list__item--disabled ">
                                                <span class="filter-list__input input-radio">
                                                    <span class="input-radio__body">
                                                        <input class="input-radio__input"
                                                               name="filter_radio"
                                                               type="radio"
                                                               disabled>
                                                        <span class="input-radio__circle"></span>
                                                    </span>
                                                </span>
                                                <span class="filter-list__title">
                                       <?= $brand->name ?>
                                                </span>
                                            </label>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-filters__actions d-flex">
            <button class="btn btn-primary btn-sm">Фільтрувати</button>
            <button class="btn btn-secondary btn-sm">Скинути</button>
        </div>
    </div>
</div>