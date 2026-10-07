<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Fallback Functions
 *
 * @author mobilova UG (haftungsbeschränkt) <rsspostimporter@feedsapi.com>
 */

/*
 * array_intersect_key for PHP earlier than 5.1.0
 */
if (!function_exists('array_intersect_key'))
{
    function array_intersect_key ($isec, $arr2)
    {
        $argc = func_num_args();
 
        for ($i = 1; !empty($isec) && $i < $argc; $i++)
        {
             $arr = func_get_arg($i);
 
             foreach ($isec as $k => $v)
                 if (!isset($arr[$k]))
                     unset($isec[$k]);
        }
 
        return $isec;
    }
}

/*
 * Download a feed-provided image URL to a temporary file.
 * The URL is untrusted. download_url() uses wp_safe_remote_get (private/loopback hosts and odd ports are rejected,
 * also on redirects). On top of that: only http(s), and a size limit (filter interq_rss_pi_max_image_bytes).
 *
 * @param string $url Image URL
 * @param int $timeout Timeout in seconds
 * @return string|WP_Error Path of the temporary file, or an error
 */
if (!function_exists('interq_rss_pi_download_image')) {
    function interq_rss_pi_download_image($url, $timeout = 30) {

        if (!is_string($url) || !preg_match('#^https?://#i', $url)) {
            return new WP_Error('interq_rss_pi_scheme', 'Only http and https image URLs are downloaded.');
        }

        $max_bytes = (int) apply_filters('interq_rss_pi_max_image_bytes', 10 * MB_IN_BYTES);

        $limit = function ($args) use ($max_bytes) {
            $args['limit_response_size'] = $max_bytes;
            return $args;
        };

        add_filter('http_request_args', $limit, 99);
        $tmp = download_url($url, $timeout);
        remove_filter('http_request_args', $limit, 99);

        if (is_wp_error($tmp)) {
            return $tmp;
        }

        // the response is cut at the limit, so a file of that size was too big
        if (filesize($tmp) >= $max_bytes) {
            wp_delete_file($tmp);
            return new WP_Error('interq_rss_pi_too_big', 'Image is larger than the allowed size.');
        }

        return $tmp;
    }
}
