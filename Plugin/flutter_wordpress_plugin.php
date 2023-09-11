<?php
/*
Plugin Name: my_flutter_app
Description: A Plugin that hosts an Flutter App as embedded component in WordPress, also supports Divi Builder.
Version: 1.0
Author: Your Name
*/

// Define constants for plugin's metadata.
define('PLUGIN_AUTHOR', 'Your Name');
define('PLUGIN_NAME', 'My Flutter App');
define('PLUGIN_ID', 'my_flutter_app');
define('PLUGIN_URI', 'yourpage.com');

// prepare plugin for usage
function enqueue_flutter_scripts()
{
    $pluginDirectory = plugin_dir_url(__FILE__);
    $flutterAppDirectory = $pluginDirectory . 'flutter_app/';

    //register scripts
    wp_register_script('flutter-main', $flutterAppDirectory . 'flutter.js', array(), null, true);
    wp_register_script('flutter-loader', $pluginDirectory . 'js/flutter-loader.js', array(), null, true);

    // pass path data to script
    wp_localize_script('flutter-loader', 'flutterData', array(
        'flutterPluginPath' => $flutterAppDirectory
    ));

    // enqueue scripts
    wp_enqueue_script('flutter-main');
    wp_enqueue_script('flutter-loader');
}
add_action('wp_enqueue_scripts', 'enqueue_flutter_scripts');

// generate the flutter div container
function generate_flutter_container($width, $height)
{
    if (!isset($width) || !isset($height)) {
        return 'Error: width and height are required!';
    }

    //loading additional args
    $args = func_get_args();

    //remove width and height from args
    array_shift($args);
    array_shift($args);

    $output = sprintf('<div class="%1$s" id="%1$s" style="width: %2$s; height: %3$s;"></div>', PLUGIN_ID, $width, $height);


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
add_shortcode(PLUGIN_ID, 'flutter_wpplugin_shortcode');

// add divi module
function initialize_flutter_divi_module()
{
    $module_file_path = get_template_directory() . '/includes/builder/module/Flutter_Divi_Module.php';
    if (!class_exists('Flutter_Divi_Module') && file_exists($module_file_path)) {
        require_once $module_file_path;
    }
}
add_action('et_builder_ready', 'initialize_flutter_divi_module');
