<?php  
/* 
Plugin Name: Mobile-Friendly Flickr Slideshow 
Plugin URI: http://www.wordpress.org/
Description: Use the <code>[fshow]</code> shorttag with <code>username=</code>, <code>photosetid=</code>, and <code>thumburl=</code> parameters to display a mobile-friendly Flickr slideshow
Author: Robert Peake
Version: 0.1 
Author URI: http://www.robertpeake.com/ 
Text Domain: flickr_slideshow
Domain Path: /languages/
*/ 
namespace flickr_slideshow;

if ( !function_exists( 'add_action' ) ) {
    die();
}

function fshow_func( $atts ) {
        extract( shortcode_atts( array(
                    'username' => get_option('fshow_default_username'),
                    'photosetid' => get_option('fshow_default_photosetid'),
                    'thumburl' => get_option('fshow_default_thumburl'),
                ), $atts, 'fshow' ) );
        $galleryURL = 'http://www.flickr.com/photos/'.$username.'/sets/'.$photosetid.'/';
        $slideshowURL = $galleryURL . 'show/';
        $slideshow = sprintf('<a href="%s" target="_blank" />&#9658; '.__('Play Slideshow','flickr_slideshow').'</a>', $slideshowURL);
        $gallery = sprintf('<a href="%s" target="_blank"><span class="galleryIcon">&#9633;&#9633;</span> '.__('View Gallery and Share','flickr_slideshow').'</a>', $galleryURL);
        $shareCode = $slideshow.' '.$gallery;
        $objectCode = '<div id="'.$photosetid.'" class="slideshowWrapper"><object width="100%" height="480"> <param name="flashvars" value="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F'.$username.'%2Fsets%2F'.$photosetid.'%2Fshow%2F&page_show_back_url=%2Fphotos%2F'.$username.'%2Fsets%2F'.$photosetid.'%2F&set_id='.$photosetid.'&jump_to="></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=109615"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=109615" allowFullScreen="true" flashvars="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F'.$username.'%2Fsets%2F'.$photosetid.'%2Fshow%2F&page_show_back_url=%2Fphotos%2F'.$username.'%2Fsets%2F'.$photosetid.'%2F&set_id='.$photosetid.'&jump_to=" width="100%" height="480"></embed></object><div class="shareLinks" style="width: 100%">'.$gallery.'</div></div>';
	$simpleLink = sprintf('<a href="http://www.flickr.com/photos/%s/sets/%s/show/" class="mobileSlideshowSimpleLink" target="_blank">'.__('Click to Play','flickr_slideshow').'</a>',$username, $photosetid, $thumburl);
        $return = '<script src="'.plugins_url('flickr-slideshow/swfobject.js', dirname(__FILE__)).'" type="text/javascript"></script>'."\n";
        $return .= '<script type="text/javascript">'."\n";
        $return .= 'if(swfobject.hasFlashPlayerVersion("1")) {'."\n";
        $return .= '    document.write(\'';
        $return .= $objectCode;
        $return .= '\');'."\n";
        $return .= '} else {'."\n";
        $return .= '    document.write(\'';
        $return .= sprintf('<div class="slideshowWrapper"><a href="http://www.flickr.com/photos/%s/sets/%s/show/" class="mobileSlideshowLink" target="_blank"><div width="100%%" height="400" class="mobileSlideshow" style="background: url('."\'".'%s'."\'".') #000 no-repeat; background-size: 100%%"><br/><span class="circle"><span class="play">&#9658;</span></span></div></a><p class="bottomText">'.$simpleLink.'</p></div>', $username, $photosetid, $thumburl, $shareCode);
        $return .= '\');'."\n";
        $return .= '}'."\n";
        $return .= '</script>'."\n";
        $return .= '<noscript>'."\n";
        $return .= $simpleLink;
        $return .= '</noscript>'."\n";
        return $return;
}

function fshow_func_head() {
    wp_register_style('fshow_css', plugins_url('flickr-slideshow/style.css', dirname(__FILE__)));
    wp_enqueue_style('fshow_css');
}

function fshow_load_textdomain() {
    load_plugin_textdomain( 'flickr_slideshow', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function fshow_register_menu_page(){
    add_options_page( __('Flickr Slideshow Options','flickr_slideshow'), __('Flickr Slideshow','flickr_slideshow'), 'manage_options', 'flickr-slideshow/admin.php');
}

function fshow_register_settings() {
    add_option('fshow_default_username', 'photomatt');
    add_option('fshow_default_photosetid', '72157600645614333');
    add_option('fshow_default_thumburl', includes_url('images/wlw/wp-watermark.png'));
    register_setting( 'flickr_slideshow', 'fshow_default_username', '\flickr_slideshow\fshow_username_check' ); 
    register_setting( 'flickr_slideshow', 'fshow_default_photosetid', 'intval' ); 
    register_setting( 'flickr_slideshow', 'fshow_default_thumburl', '\flickr_slideshow\fshow_thumburl_check' ); 
}

function fshow_username_check( $string ) {
    return filter_var($string, FILTER_SANITIZE_STRING);
}

function fshow_thumburl_check( $url ) {
    return filter_var($url, FILTER_SANITIZE_URL);
}

add_action( 'plugins_loaded', '\flickr_slideshow\fshow_load_textdomain' );
add_action( 'admin_menu', '\flickr_slideshow\fshow_register_menu_page' );
add_action( 'admin_init', '\flickr_slideshow\fshow_register_settings' );
add_action('wp_enqueue_scripts', '\flickr_slideshow\fshow_func_head');
add_shortcode( 'fshow', '\flickr_slideshow\fshow_func' );
