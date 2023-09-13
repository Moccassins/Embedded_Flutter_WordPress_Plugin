<?php
/*
Plugin Name: my_flutter_app
Description: A Plugin that hosts an Flutter App as embedded component in WordPress, also supports Divi Builder.
Version: 1.0
Author: Your Name
*/

namespace MyFlutterApp;

// Define constants for plugin's metadata.
define('PLUGIN_AUTHOR', 'Your Name');
define('PLUGIN_NAME', 'My Flutter App');
define('PLUGIN_ID', 'my_flutter_app');
define('PLUGIN_URI', 'yourpage.com');

// prepare plugin for usage
function enqueue_flutter_scripts()
{
    if (!is_page_or_post_using_flutter()) {
        return;
    }

    $pluginDirectory = plugin_dir_url(__FILE__);
    $flutterAppDirectory = $pluginDirectory . 'flutter_app/';

    $flutterData = array(
        'flutterPluginPath' => $flutterAppDirectory,
        'pluginId' => PLUGIN_ID
    );

    //register scripts
    wp_register_script('flutter-main', $flutterAppDirectory . 'flutter.js', array(), null, true);
    wp_register_script('flutter-loader', $pluginDirectory . 'js/flutter_loader.js', array(), null, true);

    // pass path data to script
    wp_localize_script('flutter-main', 'flutterData', $flutterData);
    wp_localize_script('flutter-loader', 'flutterData', $flutterData);

    // enqueue scripts
    wp_enqueue_script('flutter-main');
    wp_enqueue_script('flutter-loader');
}
add_action('wp_footer', 'MyFlutterApp\enqueue_flutter_scripts');

function is_page_or_post_using_flutter()
{
    global $post;
    return is_a($post, 'WP_Post') && has_shortcode($post->post_content, PLUGIN_ID);
}

// generate the flutter div container
function generate_flutter_container($width, $height)
{
    if (!isset($width) || !isset($height)) {
        return 'Error: width and height are required!';
    }

    static $counter = 0; // Hinzufügen des Zählers
    $counter++;
    $id = PLUGIN_ID . '_' . $counter;

    //loading additional args
    $args = func_get_args();

    //remove width and height from args
    array_shift($args);
    array_shift($args);

    $output = sprintf('<div class="%s" id="%s" style="width: %s; height: %s;"></div>', PLUGIN_ID, $id, $width, $height);

    return $output;
}

// add wordpress shorcode
function flutter_wpplugin_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'width' => '300',
        'height' => '300',
    ), $atts);

    return generate_flutter_container($atts['width'], $atts['height']);
}
add_shortcode(PLUGIN_ID, 'MyFlutterApp\flutter_wpplugin_shortcode');

// add divi module
function flutter_divi_initialize_module()
{
    if (class_exists('ET_Builder_Module')) {
        include(plugin_dir_path(__FILE__) . 'flutter_divi_module.php');
    }
}
add_action('et_builder_ready', 'MyFlutterApp\flutter_divi_initialize_module');
