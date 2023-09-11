<?php
// Define a custom module for Divi Builder that allows embedding of a Flutter App.
class Flutter_Divi_Module extends ET_Builder_Module
{
    // Unique slug for the module.
    public $slug = 'et_pb_' . PLUGIN_ID;

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
        $fields = array(
            // Width attribute for the Flutter App's container.
            'width' => array(
                'label' => esc_html__('Width', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Enter the width of your Flutter app.', 'et_builder'),
                'toggle_slug' => 'main_content',
                'default' => '300px',

            ),
            // Height attribute for the Flutter App's container.
            'height' => array(
                'label' => esc_html__('Height', 'et_builder'),
                'type' => 'text',
                'description' => esc_html__('Enter the height of your Flutter app.', 'et_builder'),
                'toggle_slug' => 'main_content',
                'default' => '300px',
            ),
        );

        return $fields;
    }

    // Generate the module's output when it's used on the frontend.
    public function shortcode_callback($atts, $content = null, $function_name)
    {
        return generate_flutter_container($atts['width'], $atts['height']);
    }
}
