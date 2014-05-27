<?php
if (!is_admin()) {
    die();
}
?><div class="wrap">
<h2><?php _e('Flickr Slideshow','flickr_slideshow'); ?></h2>
<p><?php _e('The following values will be used by default whenever they are not set explicitly using a shortcode parameter.','flickr_slideshow') ?></p>
<p><?php echo __('Currently','flickr_slideshow').' '.'<code>[fshow]</code> '.__('equals','flickr_slideshow').' <code>[fshow username="'.get_option('fshow_default_username').'" photosetid="'.get_option('fshow_default_photosetid').'" thumburl="'.get_option('fshow_default_thumburl').'"]</code>'; ?></p>
<form method="post" action="options.php">
<?php
echo settings_fields( 'flickr_slideshow' );
?>
<table class="form-table">
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_username"><?php _e('Default Flickr Username','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_username" name="fshow_default_username" value="<?php echo get_option('fshow_default_username'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_photosetid"><?php _e('Default Flickr Photosetid','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_photosetid" name="fshow_default_photosetid" value="<?php echo get_option('fshow_default_photosetid'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_thumburl"><?php _e('Default Flickr Thumbnail URL','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_thumburl" name="fshow_default_thumburl" value="<?php echo get_option('fshow_default_thumburl'); ?>" /></td>
	</tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
