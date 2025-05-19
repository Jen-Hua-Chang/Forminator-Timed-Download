<?php
// Convert seconds to human-readable string
function tfd_human_time($seconds) {
    if ($seconds >= 3600) return round($seconds / 3600) . ' hours';
    if ($seconds >= 60) return round($seconds / 60) . ' minutes';
    return $seconds . ' seconds';
}

// Query file data by filename
function tfd_get_file_data_by_filename($file_name) {
    global $wpdb;
    $table = $wpdb->prefix . 'tfd_files';
    return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE file_name = %s", $file_name), ARRAY_A);
}
