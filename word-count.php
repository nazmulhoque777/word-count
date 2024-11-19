<?php 

/*
 * Plugin Name:       Word Count
 * Plugin URI:        https://example.com/plugins/word-count/
 * Description:       This plugin counts the total number of words in a post.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md Nazmul Hoque
 * Author URI:        https://nazmulhoque.xyz
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       word-count
 * Domain Path:       /languages/
 */

// Load text domain for translations
function wordcount_load_textdomain() {
    load_plugin_textdomain('word-count', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'wordcount_load_textdomain');

// Count words in the content
function wordcount_count_words($content) {
    $stripped_content = strip_tags($content);
    $word_count = str_word_count($stripped_content);
    $label = __('Total Number of Words', 'word-count');
    $content .= sprintf('<h2>%s: %s</h2>', $label, $word_count);
    return $content;
}
add_filter('the_content', 'wordcount_count_words');
function wordcount_reading_time($content) {
    // কন্টেন্ট থেকে HTML ট্যাগ সরানো
    $stripped_content = strip_tags($content);

    // শব্দ সংখ্যা গণনা করা (ডিফল্ট হিসাবে ৯০০ ব্যবহার করা হচ্ছে)
    $wordn = 900;

    // পড়ার সময় গণনা করা
    $reading_minute = floor($wordn / 200);
    $reading_seconds = floor($wordn % 200 / (200 / 60));

    // ফিল্টার দিয়ে দৃশ্যমানতা চেক করা
    $is_visible = apply_filters('wordcount_display_readingtime', 1);
    if ($is_visible) {
        // লেবেল এবং ট্যাগের জন্য ফিল্টার প্রয়োগ করা
        $label = __('Total Reading Time', 'word_count');
        $label = apply_filters("wordcount_readingtime_heading", $label);
        $tag = apply_filters('wordcount_readingtime_tag', 'h4');

        // কন্টেন্টের সাথে যোগ করা হচ্ছে
        $content .= sprintf(
            '<%s>%s: %s minutes %s seconds</%s>',
            $tag,
            $label,
            $reading_minute,
            $reading_seconds,
            $tag
        );
    }

    return $content;
}
add_filter('the_content', 'wordcount_reading_time');

// ফিল্টার ডিফাইন করা
function customize_reading_time_visibility($is_visible) {
    return 1; // দৃশ্যমান রাখার জন্য 1 রিটার্ন
}
add_filter('wordcount_display_readingtime', 'customize_reading_time_visibility');

function customize_reading_time_heading($label) {
    return 'Estimated Reading Time'; // নতুন শিরোনাম
}
add_filter('wordcount_readingtime_heading', 'customize_reading_time_heading');

function customize_reading_time_tag($tag) {
    return 'h3'; // ট্যাগ পরিবর্তন
}
add_filter('wordcount_readingtime_tag', 'customize_reading_time_tag');


