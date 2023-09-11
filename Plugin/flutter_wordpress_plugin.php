<?php
/*
Plugin Name: my_flutter_app
Description: A Plugin that hosts an Flutter App as embedded component in WordPress.
Version: 1.0
Author: Your Name
*/

function flutter_wpplugin_shortcode($atts)
{
    $pluginDirectory = plugin_dir_path(__FILE__);
    $flutterDirectory = $pluginDirectory . 'flutter_app/';
    $atts = shortcode_atts(array(
        'width' => '100%',
        'height' => '100%',
    ), $atts);

    $output = sprintf('<div class="flutter-app-container" id="flutter_target" style="width: %s; height: %s;"></div>', $atts['width'], $atts['height']);
    // Currently it seems to be necessary to set the plugin path here and reusing it in the flutter.js file.
    // When the "assetBase" parameter is working in an later Flutter Release, it should be set using this parameter.
    $output .= sprintf('<script>window.flutterPluginPath = "%s";</script>', $flutterDirectory);
    $output .= sprintf('<script src="%s"></script>', $flutterDirectory . 'flutter.js');
    $output .= sprintf('<script>
        window.addEventListener("load", function (ev) {
          // Embed flutter into div#flutter_target
          let target = document.querySelector("#flutter_target");
          window.onload = function() {
            _flutter.loader.loadEntrypoint({
                onEntrypointLoaded: async function (engineInitializer) {
                let appRunner = await engineInitializer.initializeEngine({
                    hostElement: target,
                    assetBase: "%s",
                });
                await appRunner.runApp();
                },
            });
          };
        });
      </script>', $flutterDirectory);
    $output .= '</div>';

    return $output;
}
add_shortcode('my_flutter_app', 'flutter_wpplugin_shortcode');
