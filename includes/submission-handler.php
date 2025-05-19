<?php
// Handle form submission, generate token and email download link
add_action('forminator_custom_form_submit_before_set_fields', 'tfd_handle_submission', 10, 3);

function tfd_handle_submission($entry_model, $form_id, $field_data) {
    if ((int) $form_id !== TFD_FORM_ID) return;

    $name = $email = $file_name = '';
    $file_data = [];

    foreach ($field_data as $field) {
        if (!isset($field['name'], $field['value'])) continue;

        $name_attr = $field['name'];
        $value = is_array($field['value']) ? implode(', ', $field['value']) : $field['value'];

        if (in_array($name_attr, ['select-2', 'select-3', 'select-4'])) {
            $file_name = $value;
            $file_data = tfd_get_file_data_by_filename($file_name);
        }

        switch ($name_attr) {
            case 'name-1': $name = $value; break;
            case 'email-1': $email = $value; break;
        }
    }

    $download_value = $file_data['download_url'] ?? '';
    $file_size = $file_data['file_size'] ?? 'unknown';
    $product = $file_data['product'] ?? 'unknown';
    $version = $file_data['version'] ?? 'unknown';
    $file_name = $file_data['file_name'] ?? 'unknown';
    $checksum = $file_data['checksum'] ?? 'unknown';

    $token = bin2hex(random_bytes(16));
    $transient_key = 'tfd_token_' . $token;

    if (!empty($download_value)) {
        set_transient($transient_key, $download_value, TFD_TOKEN_TTL);
    }

    $download_url = add_query_arg('token', $token, site_url('/download-file'));
    $subject = sprintf('【Company】Download Link (valid for %s)', tfd_human_time(TFD_TOKEN_TTL));

    $shortcode = sprintf('[tfd_email_html name="%s" file_name="%s" product="%s" version="%s" file_size="%s" valid_period="%s" download_url="%s" checksum="%s"]',
        esc_attr($name), esc_attr($file_name), esc_attr($product), esc_attr($version),
        esc_attr($file_size), esc_attr(tfd_human_time(TFD_TOKEN_TTL)), esc_url($download_url), esc_attr($checksum));

    $message = do_shortcode($shortcode);

    if (!empty($email)) {
        wp_mail($email, $subject, $message, ['Content-Type: text/html; charset=UTF-8']);
    }
}
