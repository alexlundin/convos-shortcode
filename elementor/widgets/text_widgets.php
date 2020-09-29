<?php
/**
 * Elementor Text Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

namespace Elementor;

class Elementor_Text_Widget extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'text_widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Text Blocks', 'elementor-text-extension');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'fa fa-info-circle';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['convos_category'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Text Shortcodes', 'elementor-text-extension'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'bg',
            [
                'label' => __('Сhoosing a design', 'elementor-text-extension'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'plus_h' => __('✅ Success', 'elementor-text-extension'),
                    'minus_h' => __('⛔ Error', 'elementor-text-extension'),
                    'gray' => __('Gray Table', 'elementor-text-extension'),
                    'p_bd' => __('Purple Border', 'elementor-text-extension'),
                    'p_bg' => __('Purple Background', 'elementor-text-extension'),
                    'gradient_bd' => __('Light Gradient Border', 'elementor-text-extension'),
                    'gradient_bg' => __('Light Gradient Background', 'elementor-text-extension'),
                    'gradient_color' => __('Gradient', 'elementor-text-extension'),
                    'root_check' => __('Check', 'elementor-text-extension'),
                    'root_warning' => __('Warning', 'elementor-text-extension'),
                    'root_info' => __('Info', 'elementor-text-extension'),
                    'root_error' => __('Error', 'elementor-text-extension'),
                    'quote' => __('Quote', 'elementor-text-extension'),
                ],
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __('Text', 'elementor-text-extension'),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $text = wp_oembed_get($settings['text']);
        $html = wp_oembed_get($settings['bg']);

//        var_dump($html);
//        var_dump($text);
        echo '<div class="custom_text_widget">';
        switch (($html) ? $html : $settings['bg']) {
            case 'plus_h':
                echo "<blockquote class='h3'>✅ <span>{$settings['text']}</span></blockquote>";
                break;
            case 'minus_h':
                echo "<blockquote class='h3'>⛔ <span>{$settings['text']}</span></blockquote>";
                break;
            case 'gray':
                echo "<blockquote class='gray_table'>{$settings['text']}</blockquote>";
                break;
            case 'p_bd':
                echo "<blockquote class='p_bd'>{$settings['text']}</blockquote>";
                break;
            case 'p_bg':
                echo "<blockquote class='p_bg'> {$settings['text']}</blockquote>";
                break;
            case 'gradient_bd':
                echo "<blockquote class='p_bd ng_bd'>{$settings['text']}</blockquote>";
                break;
            case 'gradient_bg':
                echo "<blockquote class='p_bg ng_bg'>{$settings['text']}</blockquote>";
                break;
            case 'gradient_color':
                echo "<blockquote class='gr_color'>{$settings['text']}</blockquote>";
                break;
            case 'quote':
                echo "<blockquote class='quote'>{$settings['text']} </blockquote>";
                break;
            case 'root_check':
                echo "<blockquote class='check'>{$settings['text']}</blockquote>";
                break;
            case 'root_error':
                echo "<blockquote class='danger'>{$settings['text']}</blockquote>";
                break;
            case 'root_info':
                echo "<blockquote class='info'>{$settings['text']}</blockquote>";
                break;
            case 'root_warning':
                echo "<blockquote class='warning'>{$settings['text']}</blockquote>";
                break;
        }
        echo '</div>';

    }

}