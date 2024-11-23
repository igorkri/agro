<?php ?>
<button
    class="sa-toolbar__button"
    type="button"
    id="dropdownMenuButton2"
    data-bs-toggle="dropdown"
    data-bs-reference="parent"
    data-bs-offset="0,1"
    aria-expanded="false"
>
    <svg width="20px" height="20px" style="display: unset; font-size: larger; color: rgba(255,90,90)">
        <use xlink:href="/admin/images/sprite.svg#tasks-admin"/>
    </svg>
    <span class="sa-toolbar__button-indicator"><?= count($tasks) ?></span>
</button>
<div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuButton2">
    <div class="sa-notifications">
        <div class="sa-notifications__header">
            <div class="sa-notifications__header-title">Повідомлення</div>
            <a class="sa-notifications__header-action" href="/">До задач...</a>
        </div>
        <ul class="sa-notifications__list">
            <?php foreach ($tasks as $task): ?>
            <li class="sa-notifications__item">
                <a href="/#" class="sa-notifications__item-button">
                    <div class="sa-notifications__item-icon">
                        <div class="sa-symbol sa-symbol--shape--rounded sa-symbol--style--primary">
                            <div class="sa-symbol__icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="1em"
                                    height="1em"
                                    viewBox="0 0 16 16"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M14.5,15h-1c-0.8,0-1.5-0.7-1.5-1.5v-8C12,4.7,12.7,4,13.5,4h1C15.3,4,16,4.7,16,5.5v8C16,14.3,15.3,15,14.5,15z M8.5,15h-1C6.7,15,6,14.3,6,13.5v-11C6,1.7,6.7,1,7.5,1h1C9.3,1,10,1.7,10,2.5v11C10,14.3,9.3,15,8.5,15z M2.5,15h-1C0.7,15,0,14.3,0,13.5v-5C0,7.7,0.7,7,1.5,7h1C3.3,7,4,7.7,4,8.5v5C4,14.3,3.3,15,2.5,15z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="sa-notifications__item-body">
                        <div class="sa-notifications__item-title sa-notifications__item-title--nowrap">
                            <?= $task['title'] ?>
                        </div>
                        <div class="sa-notifications__item-subtitle sa-notifications__item-subtitle--nowrap">
                            <?= $task['descr'] ?>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="sa-notifications__footer"><a class="sa-notifications__footer-action"
                                                 href="/">See all 15 notifications</a></div>
    </div>
</div>
