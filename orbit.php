<?php
if ( ! defined( 'WPINC' ) ) {
    die();
}?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet prefetch" href="<?php echo plugin_dir_url( __FILE__ ) . 'css/foundation.css'; ?>">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ) . 'css/foundation-icons.css'; ?>">
<style>
@media only screen and (max-width: 40em) {
    .orbit-next, .orbit-prev,  .orbit-timer {
        display: block !important;
    }
}
.orbit-container {
  width: 100%;
  height: 100%;
  background-color: #000;
}
.orbit-slides-container {
  width: 100%;
  height: 100% !important;
}
.orbit-slides-container li {
  height: 100%;
  background-size: cover;
  display: inline-block;
  vertical-align: middle;
}
.orbit-slides-container li img {
  max-width: 100%;
  max-height: 100%;
  bottom: 0;
  left: 0;
  margin: auto;
  overflow: auto;
  position: fixed;
  right: 0;
  top: 0;
  vertical-align: middle;
}
.bottom-bar {
    position: fixed;
    bottom: 0;
    z-index: 100;
    width: 100%;
    _position:absolute;
    _top:expression(eval(document.documentElement.scrollTop+(document.documentElement.clientHeight-this.offsetHeight)));
    height: 2em;
    background-color: rgba(0,0,0,0.5);
    text-align: center;
}
.bottom-bar .left {
    margin-left: 1em;
}
.bottom-bar .right {
    margin-right: 1em;
}
.bottom-bar, .bottom-bar .left, .bottom-bar .right, .bottom-bar .center, .bottom-bar .left a, .bottom-bar .right a, .bottom-bar .center a, a#fullscreen_link {
    color: #fff;
}
#fullscreen_link {
    display: block;
    position: absolute;
    top: 0.5em;
    left: 1em;
    z-index: 100;
    background-color: rgba(0,0,0,0.5);
    padding: 0.5em;
}
</style>
<?php if (get_option('fshow_performance_mode') != "1"): ?>
    <?php wp_head(); ?>
<?php else: ?>
    <script src="<?php echo plugin_dir_url( __FILE__ ) . 'js/jquery.min.js'; ?>"></script>
<?php endif; ?>
<script src="<?php echo plugin_dir_url( __FILE__ ) . 'js/modernizr.min.js'; ?>"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ) . 'js/foundation.min.js'; ?>"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ) . 'js/foundation.orbit.min.js'; ?>"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ) . 'js/screenfull.min.js' ?>"></script>
</head>
<body>
<a id="fullscreen_link" style="display: none;">
    <small><i class="fi-arrows-out"></i> <?php _e('Fullscreen','flickr_slideshow'); ?></small>
</a>
<div class="orbit-container">
    <ul data-orbit>
      <?php foreach($this->get_photos() as $photo): ?>
        <li><img src="<?php get_site_url() . ''; ?>" data-src="<?php echo $photo['url']; ?>" data-page="<?php echo $photo['page_url']; ?>"></li>
      <?php endforeach; ?>
    </ul>
</div>
<div class="bottom-bar">
    <div class="left">
        <a id="gallery_link" target="_blank" style="display: none;">
            <small><?php _e('View Gallery','flickr_slideshow'); ?></small>
        </a>
    </div>
    <span class="center">
    </span>
    <div class="right">
        <a id="photo_link" target="_blank" style="display: none;">
            <small><?php _e('View Photo','flickr_slideshow'); ?></small>
        </a>
    </div>
</div>
</script>
<script>
jQuery( document ).ready( function() {
    var zindex = -1;
    lazyload = function(obj_li) {
        if (!jQuery(obj_li).find('img').first().attr('src')) {
            var url = jQuery(obj_li).find('img').first().attr('data-src');
            var img = jQuery(obj_li).find('img').first();
            img.css('z-index',zindex);
            img.attr('src', url );
            zindex--;
        }
        if (jQuery(obj_li).next()) {
            window.setTimeout( function() {
                lazyload( jQuery(obj_li).next() );
            }, 1000);
        }
    }
    function fshow_load_navigation( orbit ) {
        jQuery('#gallery_link').attr('href','<?php echo $this->get_gallery_url(); ?>').fadeIn();
        fshow_update_image_link( orbit );
        if (screenfull && screenfull.enabled) {
            jQuery('#fullscreen_link').on('click', function(e) {
                screenfull.request();
            }).fadeIn();
        }
    }
    function fshow_update_image_link( orbit ) {
        url = jQuery( orbit ).find('li.active img').attr('data-page');
        jQuery('#photo_link').attr('href',url).fadeIn();
    }
    var orbit = jQuery('.orbit-container').foundation('orbit', {
            animation: 'fade',
            timer_speed: 4000,
            animation_speed: 200,
            stack_on_small: false,
            navigation_arrows: true,
            slide_number: false,
            pause_on_hover: false,
            resume_on_mouseout: false,
            bullets: false,
            timer: true,
            variable_height: false
    });
    orbit.on("after-slide-change.fndtn.orbit", function(event) {
        fshow_update_image_link(this);
    });
    lazyload( orbit.find('li.active').first() );
    fshow_load_navigation( orbit );
});
</script>
<?php if(get_option('fshow_performance_mode') != "1"): ?>
    <?php wp_footer(); ?>
<?php endif; ?>
</body>
</html>
