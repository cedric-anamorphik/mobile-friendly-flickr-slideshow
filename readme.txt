=== Plugin Name ===
Contributors: robert@msia.org
Tags: flickr, slideshow, mobile
Requires at least: 3.0.0
Tested up to: 4.0
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embeds Flash object slideshow for browsers and creates display of thumbnail with play button and links to gallery for non-Flash (e.g. mobile) devices.

== Description ==

Embeds Flash object slideshow for browsers and creates display of thumbnail with play button and links to gallery for non-Flash (e.g. mobile) devices. Depends on Flickr for functionality, and embeds remote Flickr objects.

Shortcodes are of the format: `[fshow username=erl_bear photosetid=72157627847553181 thumburl=http://farm7.staticflickr.com/6179/6278299931_fccc887e96_z_d.jpg]`

The parameters username, photosetid, and thumburl can have values set using the plugin options page that will then be used by default whenever they are omitted from the shortcode.

== Installation ==

Install as normal for WordPress plugins.

Shortcodes are of the format: [fshow username=erl_bear photosetid=72157627847553181 thumburl=http://farm7.staticflickr.com/6179/6278299931_fccc887e96_z_d.jpg]

== Frequently Asked Questions ==

= How do I use the plugin? =

Shortcodes are of the format: <code>[fshow username=erl_bear photosetid=72157627847553181 thumburl=http://farm7.staticflickr.com/6179/6278299931_fccc887e96_z_d.jpg]</code>
= Where do I find these variables? =

As part of any gallery URL, you should see your username and photosetid. To get the thumburl, choose "View Sizes" and select the 640x480 image. Right-click and choose "Copy Image Location" (or similar) to get the URL.

== Screenshots ==

1. Default Flash object embed slideshow, displayed to all Flash-enabled devices (e.g. browsers)
2. HTML5 display for non-Flash (e.g. mobile) devices, featuring play button superimposed on thumbnail, play button on bottom navigation, and gallery/share button on bottom navigation. Designed large for tapping.

== Changelog ==

= 0.1 =

* Initial release
