<?php
/*
Plugin Name: wehodev Disable Image Downloading
Description: Disables images from being downloaded
Author: Adrian Boisclair
Version: 0.0.1
*/

class WehoDevDisableImageDownloading {

    /**
     * WehoDevDisableImageDownloading constructor.
     * Initializes Plugin
     */
    public function __construct() {
        $this->init();
    }

    public function init()
    {
        add_action('wp_footer', array( $this, 'load_scripts') );
    }

    public function load_scripts()
    {
        ?>
        <script>
            (function($){
                $(document).on('ready', function(){
                    $(document).bind('contextmenu', function(e) {
                        return false;
                    });
                });
            })(jQuery);
        </script>
        <?php
    }

}

/******************************************************
 ******************** Options Page ********************
 ******************************************************/

add_action( 'admin_menu', 'WehoDevDisableImageDownloading_add_admin_menu' );
add_action( 'admin_init', 'WehoDevDisableImageDownloading_settings_init' );

function WehoDevDisableImageDownloading_add_admin_menu() {
    add_options_page( 'WehoDevDisableImageDownloading', 'WehoDevDisableImageDownloading', 'manage_options', 'wehodev_staging_site_resources', 'WehoDevDisableImageDownloading_options_page' );
}


function WehoDevDisableImageDownloading_settings_init() {

    register_setting( 'pluginPage', 'WehoDevDisableImageDownloading_settings' );

    add_settings_section(
        'WehoDevDisableImageDownloading_pluginPage_section',
        __( 'Loads Images from Production Site', 'wordpress' ),
        'WehoDevDisableImageDownloading_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'WehoDevDisableImageDownloading_checkbox_field_1',
        __( 'Enable', 'wordpress' ),
        'WehoDevDisableImageDownloading_checkbox_field_1_render',
        'pluginPage',
        'WehoDevDisableImageDownloading_pluginPage_section'
    );

}

function WehoDevDisableImageDownloading_checkbox_field_1_render() {

    $options = get_option( 'WehoDevDisableImageDownloading_settings' );
    ?>
    <input type='checkbox' name='WehoDevDisableImageDownloading_settings[WehoDevDisableImageDownloading_checkbox_field_1]' <?php checked( $options['WehoDevDisableImageDownloading_checkbox_field_1'], 1 ); ?> value='1'>
    <?php

}


function WehoDevDisableImageDownloading_settings_section_callback() {

    echo __( '', 'wordpress' );

}


function WehoDevDisableImageDownloading_options_page() {

    ?>
    <form action='options.php' method='post'>

        <h2>WEHODEV Disable Image Downloading</h2>

        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>

    </form>
    <?php

}

$WehoDevDisableImageDownloading = new WehoDevDisableImageDownloading();