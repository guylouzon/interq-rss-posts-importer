<?php

/*
  Plugin Name: InterQ Rss Posts Importer
  Plugin URI: https://wordpress.org/plugins/interq-rss-posts-importer/
  Description: This plugin lets you set up an import posts from one or several rss-feeds and save them as posts on your site, simple and flexible.
  Author: Guy Louzon
  Version: 2026.9.2
  Author URI: https://github.com/guylouzon/RSS-posts-importer
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
  Text Domain: interq-rss-posts-importer
 */

/*
  Copyright (C) 2025-2026 Guy Louzon

  Based on "RSS Post Importer" 2.5.2 by feedsapi / mobilova UG (haftungsbeschraenkt),
  Copyright (C) feedsapi, released under the GNU General Public License v2 or later.
  https://wordpress.org/plugins/rss-post-importer/

  This program is free software; you can redistribute it and/or modify it under the
  terms of the GNU General Public License as published by the Free Software Foundation;
  either version 2 of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful, but WITHOUT ANY
  WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
  PARTICULAR PURPOSE. See the GNU General Public License for more details.
  See the LICENSE file in this folder, or http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// define some constants
if (!defined('INTERQ_RSS_PI_PATH')) {
    define('INTERQ_RSS_PI_PATH', trailingslashit(plugin_dir_path(__FILE__)));
}

if (!defined('INTERQ_RSS_PI_PL_PATH')) {
    define('INTERQ_RSS_PI_PL_PATH', trailingslashit(plugin_dir_path(dirname(__FILE__))));
}

if (!defined('INTERQ_RSS_PI_URL')) {
    define('INTERQ_RSS_PI_URL', trailingslashit(plugin_dir_url(__FILE__)));
}

if (!defined('INTERQ_RSS_PI_BASENAME')) {
    define('INTERQ_RSS_PI_BASENAME', plugin_basename(__FILE__));
}

if (!defined('INTERQ_RSS_PI_VERSION')) {
    define('INTERQ_RSS_PI_VERSION', '2026.9.2');
}

if (!defined('INTERQ_RSS_PI_LOG_PATH')) {
    $interq_rss_pi_upload_dir = wp_upload_dir();
    define('INTERQ_RSS_PI_LOG_PATH', trailingslashit($interq_rss_pi_upload_dir['basedir']) . 'interq-rss-posts-importer/');
}

if (!is_dir(INTERQ_RSS_PI_LOG_PATH)) {
    wp_mkdir_p(INTERQ_RSS_PI_LOG_PATH);
}

// helper classes
include_once INTERQ_RSS_PI_PATH . 'app/classes/helpers/class-interq-rss-pi-log.php';
include_once INTERQ_RSS_PI_PATH . 'app/classes/helpers/class-interq-rss-pi-featured-image.php';
include_once INTERQ_RSS_PI_PATH . 'app/classes/helpers/class-interq-rss-pi-parser.php';
include_once INTERQ_RSS_PI_PATH . 'app/classes/helpers/interq-rss-pi-functions.php';

// admin classes
include_once INTERQ_RSS_PI_PATH . 'app/classes/admin/class-interq-rss-pi-admin-processor.php';
include_once INTERQ_RSS_PI_PATH . 'app/classes/admin/class-interq-rss-pi-admin.php';

// Front classes
include_once INTERQ_RSS_PI_PATH . 'app/classes/front/class-interq-rss-pi-front.php';

// main importers
include_once INTERQ_RSS_PI_PATH . 'app/classes/import/class-interq-rss-pi-engine.php';
include_once INTERQ_RSS_PI_PATH . 'app/classes/import/class-interq-rss-pi-cron.php';

// the main loader class
include_once INTERQ_RSS_PI_PATH . 'app/class-interq-rss-posts-importer.php';

/**
 * Schedule the import cron event on activation.
 *
 * The event is otherwise only created on front-end page loads
 * (InterQ_Rss_Pi_Cron::schedule() runs on the 'wp' action) or when the
 * settings form is saved with a recurrence. A fresh (re)install activated
 * from wp-admin would otherwise have no scheduled event at all.
 */
function interq_rss_pi_activate(): void {
    if (!wp_next_scheduled('interq_rss_pi_cron')) {
        wp_schedule_event(time(), 'hourly', 'interq_rss_pi_cron');
    }
}
register_activation_hook(__FILE__, 'interq_rss_pi_activate');

/**
 * Clear the scheduled import event on deactivation.
 */
function interq_rss_pi_deactivate(): void {
    wp_clear_scheduled_hook('interq_rss_pi_cron');
}
register_deactivation_hook(__FILE__, 'interq_rss_pi_deactivate');

// initialise plugin as a global var
global $interq_rss_post_importer;

$interq_rss_post_importer = new InterQ_Rss_Posts_Importer();

$interq_rss_post_importer->init();

