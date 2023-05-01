<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?= $host . '/'; ?></loc>
        <lastmod><?= date(DATE_W3C); ?></lastmod>
        <priority>1.00</priority>
    </url>
    <?php foreach ($urls as $url) { ?>
        <url>
            <loc><?= $host .'/product'. $url['loc']; ?></loc>
            <?php if (isset($url['lastmod'])) { ?>
                <lastmod><?= $url['lastmod']; ?></lastmod>
            <?php } ?>
        </url>
    <?php } ?>
</urlset>