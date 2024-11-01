<?php

/**
 * Plugin Name: Buttom to Top
 * Plugin URI: https://wordpress.org/plugins/search/buttom-to-top/
 * Description:  Buttom to top plugin will help you to enable Bottom to Top button to your WordPress website. 
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Masum
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Test Domain: btp
 */

//  includeing css 
function btp_enqueue_style() {
    wp_enqueue_style('btp-style', plugins_url('css/btp-style.css', __FILE__));
}

add_action("wp_enqueue_scripts", "btp_enqueue_style");

// including javascript
function btp_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('btp-plugin-script', plugins_url('js/btp-plugin.js', __FILE__), 
    array(), '1.0.0', 'true');
}
add_action("wp_enqueue_scripts", "btp_enqueue_scripts");

// including fontawesome 
function btp_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'btp_enqueue_font_awesome');


// jquery plugin setting activation
function btp_scroll_script() { ?>
<script>
jQuery(document).ready(function() {
    // jQuery.scrollUp();
    jQuery('body').append('<button id="scrollUp" style="display:none;"><i class="fas fa-arrow-up"></i></button>')

      // Show the button when scrolling down 100px
      jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#scrollUp').fadeIn();
            } else {
                jQuery('#scrollUp').fadeOut();
            }
        });
        
        // On click, scroll to top
        jQuery('#scrollUp').click(function() {
            jQuery('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });

})
</script>
<?php }
add_action("wp_footer", "btp_scroll_script"); 

//plugin customization settings 
// add_action("customize_register", "btp_scroll_to_top" );
// function btp_scroll_to_top($wp_customize) {
    


// };
function btp_scroll_to_top($wp_customize) {
    // Add custom section
    $wp_customize->add_section('btp_scroll_top_section', array(
        'title'       => __('Scroll to Top Settings', 'btp'),
        'description' => __('Customize the Scroll to Top button', 'btp'),
        'priority'    => 160,
    ));

    // // Add setting for button color
    // $wp_customize->add_setting('btp_default_color', array(
    //     'default'           => '#000000',
    //     'sanitize_callback' => 'sanitize_hex_color',
    //     'transport'         => 'postMessage', // postMessage for live preview
    // ));
    $wp_customize->add_setting('btp_default_color', array(
        'default'=> '#000000',
    ));

    // Add control for button color
    // $wp_customize->add_control(new WP_Customize_Color_Control(
    //     $wp_customize,
    //     'btp_default_color',
    //     array(
    //         'label'    => __('Button Color', 'btp'),
    //         'section'  => 'btp_scroll_top_section',
    //         'settings' => 'btp_default_color',
    //     )
    // ));
 
$wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,'btp_default_color', array(
    'label' => 'Background Color',
    'section' => 'btp_scroll_top_section', 
    'type' => 'color',
        )
));

$wp_customize->add_setting('btp_rounded_corner', array(
    'default'=> '5px',
));
 
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,'btp_rounded_corner', array(
'label' => 'Rounded Corner',
'section' => 'btp_scroll_top_section', 
'type' => 'text',
    )
));
 
}
add_action('customize_register', 'btp_scroll_to_top');

// theme css customization
function btn_scroll_background_color_change() { 
    $bg_color = esc_attr(get_theme_mod("btp_default_color")); 
    ?>
<style>
    #scrollUp {  
    background-color: <?php print get_theme_mod("btp_default_color"); ?>; 
    /* background-color: url('<?php echo $bg_color; ?>'); */
    border-radius: <?php print get_theme_mod("btp_rounded_corner"); ?>; 
    url('<?php echo $bg_image; ?>');
    
}

</style>
<?php }
 add_action('wp_head', 'btn_scroll_background_color_change');
?>