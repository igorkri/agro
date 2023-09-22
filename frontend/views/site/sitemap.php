<?php
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