<?php

use common\models\shop\ActivePages;

ActivePages::setActiveUser();

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
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
            <link rel="alternate" hreflang="uk" href="<?= $host . $url['loc']; ?>" />
            <link rel="alternate" hreflang="en" href="<?= $host .'/en' . $url['loc']; ?>" />
            <link rel="alternate" hreflang="ru" href="<?= $host .'/ru' . $url['loc']; ?>" />
            <?php if (isset($url['image'])) { ?>
                <image:image>
                    <image:loc><?= $host . $url['image']; ?></image:loc>
                    <image:caption><?= $url['caption']; ?></image:caption>
                </image:image>
            <?php } ?>
        </url>
    <?php } ?>
</urlset>