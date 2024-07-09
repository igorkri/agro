<?php

use common\models\shop\ActivePages;
use frontend\controllers\SiteController;

/** @var SiteController $host */
/** @var SiteController $urls */

ActivePages::setActiveUser();

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="https://www.google.com/schemas/sitemap-image/1.1"
        xmlns:xhtml="https://www.w3.org/1999/xhtml"
        xmlns:xsd="https://www.w3.org/2001/XMLSchema"
>
    <url>
        <loc><?= $host . '/'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>1.00</priority>
    </url>
    <?php foreach ($urls as $url) { ?>
        <url>
            <loc><?= $host . $url['loc']; ?></loc>
            <changefreq><?= $url['changefreq']; ?></changefreq>
            <lastmod><?= $url['lastmod']; ?></lastmod>
            <priority><?= $url['priority']; ?></priority>
            <xhtml:link rel="alternate" hreflang="uk" href="<?= $host . $url['loc'] ?>" />
            <xhtml:link rel="alternate" hreflang="en" href="<?= $host .'/en' . $url['loc'] ?>" />
            <xhtml:link rel="alternate" hreflang="ru" href="<?= $host .'/ru' . $url['loc'] ?>" />
            <?php if (isset($url['image'])) { ?>
                <image:image>
                    <image:loc><?= $host . $url['image']; ?></image:loc>
                    <image:caption><?= $url['caption']; ?></image:caption>
                </image:image>
            <?php } ?>
        </url>
    <?php } ?>
</urlset>