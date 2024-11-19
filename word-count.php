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


