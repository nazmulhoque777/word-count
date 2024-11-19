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
// function wordcount_load_textdomain() {
//     load_plugin_textdomain('word-count', false, dirname(plugin_basename(__FILE__)) . '/languages/');
// }
// add_action('plugins_loaded', 'wordcount_load_textdomain');

// // Count words in the content
// function wordcount_count_words($content) {
//     $stripped_content = strip_tags($content);
//     $word_count = str_word_count($stripped_content);
//     $label = __('Total Number of Words', 'word-count');
//     $content .= sprintf('<h2>%s: %s</h2>', $label, $word_count);
//     return $content;
// }
// add_filter('the_content', 'wordcount_count_words');





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


// **Function: wordcount_load_textdomain**
// এই ফাংশনটি প্লাগিনের জন্য ভাষা ফাইল লোড করতে ব্যবহার করা হয়।
function wordcount_load_textdomain() {
    // load_plugin_textdomain() ফাংশনটি ওয়ার্ডপ্রেসকে বলে দেয় কোন ডিরেক্টরি থেকে ভাষার ফাইল লোড করতে হবে।
    load_plugin_textdomain('word-count', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
// প্লাগিন লোড হওয়ার পর এই ফাংশনটি চালানো হবে।
add_action('plugins_loaded', 'wordcount_load_textdomain');

// **Function: wordcount_count_words**
// এই ফাংশনটি পোস্ট কন্টেন্ট থেকে শব্দের সংখ্যা গণনা করবে এবং সেই সংখ্যা প্রদর্শন করবে।
function wordcount_count_words($content) {
    // strip_tags() ফাংশনটি HTML ট্যাগ বাদ দিয়ে কন্টেন্টকে শুধুমাত্র টেক্সটে রূপান্তর করে।
    $stripped_content = strip_tags($content);
    
    // str_word_count() ফাংশনটি টেক্সট থেকে মোট শব্দের সংখ্যা গণনা করে।
    $word_count = str_word_count($stripped_content);
    
    // __('Total Number of Words', 'word-count') এর মাধ্যমে একটি অনুবাদযোগ্য স্ট্রিং তৈরি করা হয়।
    $label = __('Total Number of Words', 'word-count');
    $label = apply_filters("wordcount_heading", $label);
    $tag = apply_filters('wordcount_tag', 'h2');
    
    // sprintf() ফাংশনটি ব্যবহার করে কন্টেন্টের শেষে শব্দ সংখ্যা যোগ করা হয়।
    // $content .= sprintf('<h2>%s: %s</h2>', $tag, $label, $word_count,$tag);
    $content .= sprintf('<%s> %s: %s</%s>', $tag, $label, $word_count,$tag);
    
    // কন্টেন্ট রিটার্ন করা হয়, যাতে পোস্টের মধ্যে প্রদর্শিত হয়।
    return $content;
}

// **Filter: 'the_content'**
// ওয়ার্ডপ্রেস ফিল্টার ব্যবহার করা হয়েছে, যা পোস্টের কন্টেন্ট পরিবর্তন করার জন্য ব্যবহৃত হয়।
add_filter('the_content', 'wordcount_count_words');   


