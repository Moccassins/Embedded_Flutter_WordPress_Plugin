<?php

namespace MyFlutterApp;

// Define a custom module for Divi Builder that allows embedding of a Flutter App.
class Flutter_Divi_Module extends \ET_Builder_Module
{
    // Unique slug for the module.
    public $slug = PLUGIN_ID;

    // Enable support for Divi's visual builder.
    public $vb_support = 'on';

    // Metadata about the module's creator and associated page.
    protected $module_credits = array(
        'module_uri' => PLUGIN_URI,
        'author' => PLUGIN_AUTHOR,
        'author_uri' => PLUGIN_URI,
    );

    // Initialize the module; set the module's name.
    public function init()
    {
        $this->name = esc_html__(PLUGIN_NAME, 'et_builder');
    }

    // Define the fields that the module will accept.
    public function get_fields()
    {
        return array(
            // Width attribute for the Flutter App's container.
            'width' => array(
                'label' => esc_html__('Breite', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Breite des Quadrats eingeben.', 'et_builder'),
                'default' => '100px',
                'option_category' => 'layout',
            ),
            // Height attribute for the Flutter App's container.
            'height' => array(
                'label' => esc_html__('Höhe', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Höhe des Quadrats eingeben.', 'et_builder'),
                'default' => '100px',
                'option_category' => 'layout',
            ),
        );
    }

    // Generate the module's output when it's used on the frontend.
    public function render($attrs, $content = null, $render_slug)
    {
        return generate_flutter_container($attrs['width'], $attrs['height']);
    }
}

new Flutter_Divi_Module;
