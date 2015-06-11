<?php
if (!is_admin()) {
    die();
}
?><div class="wrap">
<h2><?php _e('Flickr Slideshow','flickr_slideshow'); ?></h2>
<?php if (strlen(get_option('fshow_flickr_api_key')) == 0): ?>
<div class="notice">
<?php sprintf(_e('You must obtain a <a href="%s" target="_blank">Flickr API Key</a> to use the new version of Flickr Slideshow correctly.','flickr_slideshow'),'https://www.flickr.com/services/apps/create/apply'); ?>
</div>
<?php endif; ?>
<form method="post" action="options.php">
<?php
echo settings_fields( 'flickr_slideshow' );
?>
<table class="form-table">
	<tr valign="top">
            <th scope="row"><label for="id_fshow_flickr_api_key"><?php _e('Flickr API Key','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_flickr_api_key" name="fshow_flickr_api_key" value="<?php echo get_option('fshow_flickr_api_key'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_username"><?php _e('Default Flickr Username','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_username" name="fshow_default_username" value="<?php echo get_option('fshow_default_username'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_user_id"><?php _e('Default Flickr User ID','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_user_id" name="fshow_default_user_id" value="<?php echo get_option('fshow_default_user_id'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_photosetid"><?php _e('Default Flickr Photosetid','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_photosetid" name="fshow_default_photosetid" value="<?php echo get_option('fshow_default_photosetid'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_thumburl"><?php _e('Default Flickr Thumbnail URL','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_thumburl" name="fshow_default_thumburl" value="<?php echo get_option('fshow_default_thumburl'); ?>" /></td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_width"><?php _e('Default Slideshow Width','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_width" name="fshow_default_width" value="<?php echo get_option('fshow_default_width'); ?>" />px</td>
	</tr>
	<tr valign="top">
            <th scope="row"><label for="id_fshow_default_height"><?php _e('Default Slideshow Height','flickr_slideshow'); ?>:</label></th>
	    <td><input type="text" id="id_fshow_default_height" name="fshow_default_height" value="<?php echo get_option('fshow_default_height'); ?>" />px</td>
	</tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
