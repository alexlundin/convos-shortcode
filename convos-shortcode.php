<?php
/**
 * Plugin Name: Custom ShortCodes by Alex Lundin
 * Author:      Alex Lundin
 * Version:     1.2.51
 * Description: Custom Shortcodes for text
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/alexlundin/convos-shortcode/',
	__FILE__,
	'convos-shortcode'
);

// //Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');

//Optional: Set the branch that contains the stable release.
// $myUpdateChecker- > > setBranch('master');

add_shortcode("plus_h", function ($args = null, $content = null) {
    return "<div class='h3'>✅ {$content}</div>";
});
add_shortcode("minus_h", function ($args = null, $content = null) {
    return "<div class='h3'>⛔ {$content}</div>";
});
add_shortcode("gray", function ($args = null, $content = null) {
    return "<div class='gray_table'> {$content} </div>";
});
add_shortcode("purple_bd", function ($args = null, $content = null) {
    return "<span class='p_bd'> {$content} </span>";
});
add_shortcode("purple_bg", function ($args = null, $content = null) {
    return "<span class='p_bg'> {$content} </span>";
});
add_shortcode("gradient_bd", function ($args = null, $content = null) {
    return "<span class='p_bd ng_bd'> {$content} </span>";
});
add_shortcode("gradient_bg", function ($args = null, $content = null) {
    return "<span class='p_bg ng_bg'> {$content} </span>";
});
add_shortcode("gradient_color", function ($args = null, $content = null) {
    return "<span class='gr_color'> {$content} </span>";
});

add_action('wp', 'add_css');

function add_css()
{
    /* Получаем глобальную переменную $post */
    global $post;

    /* Регистрируем таблицу стилей */
//    wp_register_style('customShortcodes', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
    wp_register_style('customShortcodes', plugins_url( 'elementor/assets/styles.css', __FILE__ ));
    wp_register_style('fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');


    /* Проверяем нет присутствует ли в записи шорткод, если да то выводит css */
//    if ( has_shortcode($post->post_content, 'plus_h') ||
//         has_shortcode($post->post_content, 'minus_h') ||
//         has_shortcode($post->post_content, 'gray') ||
//         has_shortcode($post->post_content, 'purple_bd') ||
//         has_shortcode($post->post_content, 'purple_bg') ||
//         has_shortcode($post->post_content, 'gradient_bd') ||
//         has_shortcode($post->post_content, 'gradient_bg') ||
//         has_shortcode($post->post_content, 'gradient_color')
//    ) {
//        wp_enqueue_style('customShortcodes');
//    }
}


add_action("admin_enqueue_scripts", function () {
    wp_enqueue_script("custom_shortcode_btn", plugin_dir_url(__FILE__) . 'assets/js/custom_short_btns.js', array('wp-tinymce-root'), '1.2.4' , true);
});
add_action( 'admin_init', function () {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        add_filter( 'mce_buttons_3', function ($buttons) {
            array_push( $buttons, "minus", "plus", "gray", "custom_table", "purple_background", "purple_border", "gradient_background", "gradient_border", "light_gradient");
            return $buttons;
        });
        add_filter( 'mce_external_plugins', function ($plugin_array) {
            $plugin_array['custom_shortcodes'] =  plugin_dir_url(__FILE__) .'assets/js/custom_short_btns.js';
            return $plugin_array;
        });
    }
} );

if ( is_plugin_active( 'elementor/elementor.php' ) ) {
    function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'convos_category',
            [
                'title' => __( 'Custom Widgets', 'elementor-text-extension' ),
                'icon' => 'fa fa-plug',
            ]
        );

    }
    add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


    require 'elementor/elementor-extension.php';
}