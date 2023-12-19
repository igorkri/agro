<?php

use common\models\shop\ActivePages;

ActivePages::setActiveUser();

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?= $host . '/'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc><?= $host . '/catalog/zasobi-zahistu-roslin'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/catalog/dobriva'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/catalog/posivniy-material'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/catalog/antilid'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/catalog/dacha'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/fumiganti'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/rodentitsidi'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/gerbitsidi'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/fungitsidi'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/insektitsidi'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/protruyniki'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/prilipachi'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/desikant'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/mineral-ni-dobriva'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/organichni-dobriva'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/kukurudza'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/gazonna-trava-v-ukraini'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/sonyashnik'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/girchitsya-kupiti-nedorogo-v-ukraini'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/protiozheledni-reagenti-v-ukraini'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/sad-gorod'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/vid-khvorob'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/vid-zhuka'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?= $host . '/product-list/vid-grizuniv'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>0.80</priority>
    </url>
    <?php foreach ($urls as $url) { ?>
        <url>
            <loc><?= $host . $url['loc']; ?></loc>
            <?php if (isset($url['lastmod'])) { ?>
                <lastmod><?= $url['lastmod']; ?></lastmod>
                <priority>0.80</priority>
            <?php } ?>
        </url>
    <?php } ?>
</urlset>