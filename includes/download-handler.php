<?php
// Handle download requests based on token
add_action('template_redirect', function () {
    if ((int) get_query_var('download_file') !== 1)
        return;

    $token = sanitize_text_field($_GET['token'] ?? '');
    $file = get_transient('tfd_token_' . $token);
    if (!$file)
        wp_die('Link expired or invalid');
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Downloading...</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 40px;
            }

            .btn {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 24px;
                background-color: #1b61b8;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-size: 16px;
            }

            .btn:hover {
                background-color: #144a88;
            }
        </style>
        <script>
            window.onload = function () {
                setTimeout(function () {
                    window.location.href = <?php echo json_encode($file); ?>;
                }, 1200);
            };
        </script>
    </head>

    <body>
        <div style="text-align: center;">
            <h2>📥 Download is starting...</h2>
            <p>Please wait while the file is being prepared.</p>
            <a class="btn" href="<?php echo esc_url($file); ?>" target="_blank">🔗 Manual Download</a>
        </div>
    </body>

    </html>
    <?php
    exit;
});
