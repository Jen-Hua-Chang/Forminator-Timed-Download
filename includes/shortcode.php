<?php
// Email HTML content using shortcode
add_shortcode('tfd_email_html', function ($atts) {
    $a = shortcode_atts([
        'name' => '',
        'file_name' => '',
        'product' => '',
        'version' => '',
        'file_size' => '',
        'valid_period' => '',
        'download_url' => '',
        'checksum' => ''
    ], $atts);

    ob_start(); ?>
    <div>
        <p>Dear <?php echo esc_html($a['name']); ?>,</p>
        <p>Below is the download link for the software you requested. The link is valid for
            <?php echo esc_html($a['valid_period']); ?>:</p>
        <p><a href="<?php echo esc_url($a['download_url']); ?>">Download Link</a></p>
        <ul>
            <li>Product: <?php echo esc_html($a['product']); ?></li>
            <li>Version: <?php echo esc_html($a['version']); ?></li>
            <li>File Name: <?php echo esc_html($a['file_name']); ?></li>
            <li>File Size: <?php echo esc_html($a['file_size']); ?></li>
            <li>Checksum: <?php echo esc_html($a['checksum']); ?></li>
        </ul>
        <p>Best regards,<br>[Company]</p>
    </div>
    <?php return ob_get_clean();
});
