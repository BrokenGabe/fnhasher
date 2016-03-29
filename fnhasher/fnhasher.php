<?php
/**
Plugin Name: Filename Hasher
Description: Prevents duplicate uploaded filenames by replacing it with a UUIDv4 filename.
Version: 0.1.7
Author: Taek
Author URI: https://taek.us/
Plugin URI: https://github.com/Taekus/fnhasher
License: GPLv2
**/

/**
 * Filter {@see sanitize_file_name()} and return a proper UUIDv4.
 *
 * @param string $filename
 * @return string
 */
function _combine($filename) {
	$info = pathinfo($filename);
	$ext = substr(strrchr($filename,'.'),0);
	$name = basename($filename, $ext);
	$hash = md5($name);
	$string = substr($hash, 0, 8 ) .'-'.
	substr($hash, 8, 4) .'-'.
	substr($hash, 12, 4) .'-'.
	substr($hash, 16, 4) .'-'.
	substr($hash, 20);
	return $string . $ext;
}
add_filter('sanitize_file_name', '_combine', 10);

?>