<?php
/**
 * Plugin Name: Forminator Timed File Download
 * Description: Collects an email via Forminator and sends a customizable time-limited download link.
 * Version: 1.5.0
 * Author: Jen-Hua Chang
 * License: GPL2
 */

if (!defined('ABSPATH'))
    exit(); // Prevent direct access

require_once plugin_dir_path(__FILE__) . 'includes/constants.php';
require_once plugin_dir_path(__FILE__) . 'includes/helpers.php';
require_once plugin_dir_path(__FILE__) . 'includes/submission-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/rewrite-rules.php';
require_once plugin_dir_path(__FILE__) . 'includes/download-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
