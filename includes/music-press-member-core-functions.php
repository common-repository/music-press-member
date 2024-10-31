<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mp_member_doing_it_wrong( $function, $message, $version ) {
    $message .= ' Backtrace: ' . wp_debug_backtrace_summary();

    if ( is_ajax() ) {
        do_action( 'doing_it_wrong_run', $function, $message, $version );
        error_log( "{$function} was called incorrectly. {$message}. This message was added in version {$version}." );
    } else {
        _doing_it_wrong( $function, $message, $version );
    }
}

function mp_member_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( ! empty( $args ) && is_array( $args ) ) {
        extract( $args );
    }

    $located = mp_member_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        mp_member_doing_it_wrong( __FUNCTION__, sprintf( esc_html__( '%s does not exist.', 'music-press-member' ), '<code>' . $located . '</code>' ), '2.1' );
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin.
    $located = apply_filters( 'mp_member_get_template', $located, $template_name, $args, $template_path, $default_path );

    do_action( 'mp_before_template_part', $template_name, $template_path, $located, $args );

    include( $located );

    do_action( 'mp_after_template_part', $template_name, $template_path, $located, $args );
}

function mp_member_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    global $music_press_member;
    if ( ! $template_path ) {
        $template_path = $music_press_member->music_press_member_template_path();
    }

    if ( ! $default_path ) {
        $default_path =$music_press_member->music_press_member_plugin_path() . '/templates/';
    }

    // Look within passed path within the theme - this is priority.
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name,
        )
    );

    // Get default template/
    if ( ! $template || TZ_MUSIC_TEMPLATE_DEBUG_MODE ) {
        $template = $default_path . $template_name;
    }

    // Return what we found.
    return apply_filters( 'music_press_member_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'is_ajax' ) ) {

    /**
     * is_ajax - Returns true when the page is loaded via ajax.
     * @return bool
     */
    function is_ajax() {
        return defined( 'DOING_AJAX' );
    }
}

function mp_member_deprecated_function( $function, $version, $replacement = null ) {
    if ( is_ajax() ) {
        do_action( 'deprecated_function_run', $function, $replacement, $version );
        $log_string  = "The {$function} function is deprecated since version {$version}.";
        $log_string .= $replacement ? " Replace with {$replacement}." : '';
        error_log( $log_string );
    } else {
        _deprecated_function( $function, $version, $replacement );
    }
}
function music_press_member_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    mp_member_deprecated_function( __FUNCTION__, '3.0', 'mp_locate_template' );
    return mp_member_locate_template( $template_name, $template_path, $default_path );
}