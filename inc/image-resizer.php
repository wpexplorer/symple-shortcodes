<?php
/**
* Title : Aqua Resizer
* Description : Resizes WordPress images on the fly
* Version : 1.1.6
* Author : Syamil MJ
* Author URI : http://aquagraphite.com
* License : WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param	string $url - (required) must be uploaded using wp media uploader
* @param	int $width - (required)
* @param	int $height - (optional)
* @param	bool $crop - (optional) default to soft crop
* @param	bool $single - (optional) returns an array if false
* @uses		wp_upload_dir()
* @uses		image_resize_dimensions() | image_resize()
* @uses		wp_get_image_editor()
*
* @return str|array
*/

if ( ! function_exists( 'symple_shortcodes_img_resize' ) ) {
	function symple_shortcodes_img_resize( $url, $width, $height = null, $crop = null, $single = true ) {
		
		//validate inputs
		if(!$url OR !$width ) return false;
		
		//screen is 2x so double the size of images
		$aq_width = has_filter('aq_resize_width') ? apply_filters( 'aq_resize_width', $width) : $width;
		$aq_height = has_filter('aq_resize_height') ? apply_filters( 'aq_resize_height', $height) : $height;
		
		//define upload path & dir
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];
		
		//check if $img_url is local
		if(strpos( $url, $upload_url ) === false) return false;
		
		//define path of image
		$rel_path = str_replace( $upload_url, '', $url);
		$img_path = $upload_dir . $rel_path;
		
		//check if img path exists, and is an image indeed
		if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
		
		//get image info
		$info = pathinfo($img_path);
		$ext = $info['extension'];
		list($orig_w,$orig_h) = getimagesize($img_path);
		
		
		
		//get image size after cropping
		$dims = image_resize_dimensions($orig_w, $orig_h, $aq_width, $aq_height, $crop);
		$dst_w = $dims[4];
		$dst_h = $dims[5];
		
		//use this to check if cropped image already exists, so we can return that instead
		$suffix = "{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
		
		if(!$dst_h) {
			//can't resize, so return original url
			$img_url = $url;
			$dst_w = $orig_w;
			$dst_h = $orig_h;
		}
		//else check if cache exists
		elseif(file_exists($destfilename) && getimagesize($destfilename)) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		} 
		//else, we resize the image and return the new resized image url
		else {
			
			$editor = wp_get_image_editor($img_path);
			
			if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $aq_width, $aq_height, $crop ) ) )
				return false;
			
			$resized_file = $editor->save();
			
			if(!is_wp_error($resized_file)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path']);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
			
		}
		
		//return the output
		if($single) {
			//str return
			$image = $img_url;
		} else {
			//array return
			$image = array (
				0 => $img_url,
				1 => $dst_w,
				2 => $dst_h
			);
		}
		
		
	// RETINA Support --------------------------------------------------------------->
	$supports_retina = apply_filters( 'symple_shortcodes_image_retina', false );
	if ( function_exists( 'wpex_get_data' ) &&  wpex_get_data( 'retina', '1' ) ) {
		$supports_retina = true;
	}
	if ( $supports_retina == '1' ) {
		$retina_w = $dst_w*2;
		$retina_h = $dst_h*2;
		
		//get image size after cropping
		$dims_x2 = image_resize_dimensions($orig_w, $orig_h, $retina_w, $retina_h, $crop);
		$dst_x2_w = $dims_x2[4];
		$dst_x2_h = $dims_x2[5];
		
		// If possible lets make the @2x image
		if($dst_x2_h) {
		
			//@2x image url
			$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}@2x.{$ext}";
			
			//check if retina image exists
			if(file_exists($destfilename) && getimagesize($destfilename)) {	
				// already exists, do nothing
			} else {
				// doesnt exist, lets create it
				$editor = wp_get_image_editor($img_path);
				if ( ! is_wp_error( $editor ) ) {
					$editor->resize( $retina_w, $retina_h, $crop );
					$editor->set_quality( 100 );
					$filename = $editor->generate_filename( $dst_w . 'x' . $dst_h . '@2x'  );
					$editor = $editor->save($filename);	
				}
			}
			}
		
		}
		
		// Return image --------------------------------------------------------------->
		return $image;
	}
}