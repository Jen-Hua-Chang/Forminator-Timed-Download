<?php
// Register download-file rewrite rule
add_action('init', function () {
    add_rewrite_rule('^download-file/?$', 'index.php?download_file=1', 'top');
});

// Register custom query var
add_filter('query_vars', function ($vars) {
    $vars[] = 'download_file';
    return $vars;
});
