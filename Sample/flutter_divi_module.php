<?php

namespace MyFlutterApp;

require_once plugin_dir_path(__FILE__) . 'plugin_config.php';

// Define a custom module for Divi Builder that allows embedding of a Flutter App.
class Flutter_Divi_Module extends \ET_Builder_Module
{
    // Unique slug for the module.
    public $slug;

    // Metadata about the module's creator and associated page.
    protected $module_credits;

    public function __construct()
    {
        $this->slug = 'divi_' . PluginConfig::get('id');
        $this->module_credits = array(
            'module_uri' => PluginConfig::get('uri'),
            'author' => PluginConfig::get('author'),
            'author_uri' => PluginConfig::get('uri'),
        );

        parent::__construct(); // calling base constructor
    }

    // Enable support for Divi's visual builder.
    public $vb_support = 'on';

    // Initialize the module; set the module's name.
    public function init()
    {
        $this->name = esc_html__(PluginConfig::get('name'), 'et_builder');
    }

    // Define the fields that the module will accept.
    public function get_fields()
    {
        return array(
            // Width attribute for the Flutter App's container.
            'width' => array(
                'label' => esc_html__('Width', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Width of the container.', 'et_builder'),
                'default' => '300px',
                'option_category' => 'layout',
            ),
            // Height attribute for the Flutter App's container.
            'height' => array(
                'label' => esc_html__('Height', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Height of the container.', 'et_builder'),
                'default' => '300px',
                'option_category' => 'layout',
            ),
        );
    }

    // Generate the module's output when it's used on the frontend.
    public function render($attrs, $content = null, $render_slug)
    {
        // temporary fixed values, as the default does not work
        //return generate_flutter_container($attrs['width'], $attrs['height']);
        return generate_flutter_container("300px", "300px");
    }
}

new Flutter_Divi_Module;
