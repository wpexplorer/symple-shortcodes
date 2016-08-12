<?php
/**
 * Register all shortcodes
 *
 * @package   Symple Shortcodes
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

// Widget Support -------------------------------------------------------------------------- >
add_filter( 'widget_text', 'do_shortcode' );


// "Fix" Shortcodes -------------------------------------------------------------------------- >
function symple_fix_shortcodes($content){   
	$array = array (
		'<p>['    => '[', 
		']</p>'   => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter( 'the_content', 'symple_fix_shortcodes' );


// Clear Floats -------------------------------------------------------------------------- >	
function symple_clear_floats_shortcode() {
   return '<div class="symple-clear-floats"></div>';
}
add_shortcode( 'symple_clear_floats', 'symple_clear_floats_shortcode' );


// Callout -------------------------------------------------------------------------- >	
function symple_callout_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'caption'				=> '',
		'button_text'			=> '',
		'fade_in'				=> '',
		'button_color'			=> 'black',
		'button_size'			=> 'normal',
		'button_url'			=> 'http://www.wpexplorer.com',
		'button_rel'			=> 'nofollow',
		'button_target'			=> 'blank',
		'button_border_radius'	=> '',
		'button_title'			=> __( 'Visit Site', 'symple' ),
		'class'					=> '',
		'button_icon_left'		=> '',
		'button_icon_right'		=> '',
	), $atts ) );

	// Sanitize
	$button_icon_left  = symple_shortcodes_font_icon_class( $button_icon_left );
	$button_icon_right = symple_shortcodes_font_icon_class( $button_icon_right );
	$button_url        = esc_url( $button_url );
	$button_title      = esc_attr( $button_title );
	
	// Load required scripts
	if ( $button_icon_left || $button_icon_right ) {
		wp_enqueue_style( 'font-awesome' );
	}
	
	// Fade in
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}
	
	// Display Callout
	$output = '<div class="symple-callout symple-clearfix '. esc_attr( $class ) .' '. $fade_in_class .'">';

		$output .= '<div class="symple-callout-caption">';
			$output .= do_shortcode( wp_kses_post( $content ) );
		$output .= '</div>';

		if ( $button_text && $button_url ) {

			$border_radius = $button_border_radius ? 'style="border-radius:'. esc_attr( $button_border_radius ) .'"' : null;
			$button_rel    = 'nofollow' == $button_rel ? ' rel="nofollow"' : null;
			$button_target = ( strpos( $button_target, 'blank' ) !== false ) ? ' target="_blank"' : null;
			$output .= '<div class="symple-callout-button">';
				$output .= '<a href="'. $button_url .'" class="symple-button '. $button_size .' '. $button_color .'" title="'. esc_attr( $button_title ) .'" '. $border_radius . $button_rel . $button_target .'>';
					$output .= '<span class="symple-button-inner" '. $border_radius .'>';
						if ( $button_icon_left ) {
							$output .= '<span class="symple-button-icon-left '. esc_attr( $button_icon_left ) .'"></span>';
						}
						$output .= $button_text;
						if ( $button_icon_right ) {
							$output .= '<span class="symple-button-icon-right '. esc_attr( $button_icon_right ) .'"></span>';
						}
					$output .= '</span>';
				$output .= '</a>';
			$output .= '</div>';

		}

	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'symple_callout', 'symple_callout_shortcode' );


// Skillbars -------------------------------------------------------------------------- >	
function symple_skillbar_shortcode( $atts ) {

	// Parse and extract shortcode attributes
	extract( shortcode_atts( array(
		'title'        => '',
		'percentage'   => '100',
		'color'        => '#6adcfa',
		'class'        => '',
		'show_percent' => 'true'
	), $atts ) );

	// Define output var
	$output = '';
	
	// Enque scripts
	wp_enqueue_script( 'symple_skillbar' );

	// Inline js
	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {

		$output .= '<script>
			jQuery(function($){
				$(document).ready(function(){
					$( ".symple-skillbar" ).each(function(){
						$(this).find( ".symple-skillbar-bar" ).animate({ width: $(this).attr( "data-percent" ) }, 800 );
					} );
				} );
			} );</script>';

	}
	
	// Open skillbar main wrapper
	$output .= '<div class="symple-skillbar symple-clearfix '. esc_attr( $class ) .'" data-percent="'. floatval( $percentage ) .'%">';

		// Display title
		if ( $title ) {
			$output .= '<div class="symple-skillbar-title" style="background: '. esc_attr( $color ) .';"><span>'. esc_html( $title ) .'</span></div>';
		}

		// Display bar
		$output .= '<div class="symple-skillbar-bar" style="background: '. esc_attr( $color ) .';"></div>';

		// Display percentage
		if ( $show_percent == 'true' ) {
			$output .= '<div class="symple-skill-bar-percent">'. floatval( $percentage ) .'%</div>';
		}

	// Close main wrapper
	$output .= '</div>';
	
	// Return output
	return $output;
}

add_shortcode( 'symple_skillbar', 'symple_skillbar_shortcode' );


// Spacing -------------------------------------------------------------------------- >	
function symple_spacing_shortcode( $atts ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'size'	=> '20px',
		'class'	=> '',
	  ),
	  $atts ) );

	// Sanitize data
	$size = intval( $size ) .'px';

	// Return output
	return '<hr class="symple-spacing '. esc_attr( $class ) .'" style="height: '. esc_attr( $size ) .'" />';

}
add_shortcode( 'symple_spacing', 'symple_spacing_shortcode' );


// Bullets -------------------------------------------------------------------------- >
function symple_bullets_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'style'	=> 'check'
	),
	$atts ) );

	// Return output
	return '<div class="symple-bullets symple-bullets-'. esc_attr( $style ) .'">'. do_shortcode( wp_kses_post( $content ) ) .'</div>';

}
add_shortcode( 'symple_bullets', 'symple_bullets_shortcode' );


// Centered Container -------------------------------------------------------------------------- >	
function symple_container_shortcode( $atts, $content=null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'margin_top'    => '0',
		'margin_bottom' => '',
		'class'         => '',
	  ),
	  $atts ) );

	// Return output
	return '<div class="symple-container container clr '. esc_attr( $class ) .'" style="margin-top: '. intval( $margin_top ) .'px;"margin-bottom:'. intval( $margin_bottom ) .'px;" />
			'. do_shortcode( wp_kses_post( $content ) ) .'
		</div>';
}
add_shortcode( 'symple_container', 'symple_container_shortcode' );


// Background Container (deprecated) -------------------------------------------------------------------------- >	
function symple_background_shortcode( $atts, $content=null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'background_color'	=> '#000',
		'background_image'	=> '',
		'background_style'	=> 'fixed', //fixed, repeat, parallax
		'center_content'	=> 'true',
		'padding_top'		=> '40px',
		'padding_bottom'	=> '40px',
		'padding_left'		=> '0',
		'padding_right'		=> '0',
		'margin_top'		=> '0',
		'margin_bottom'		=> '0',
		'text_color'		=> '#fff',
		'class'				=> '',
	),
	$atts ) );
	$bg_img=null;
	
	if ( wp_get_attachment_url( $background_image ) ) {
		$vc_bg_img = wp_get_attachment_url( $background_image );
		$bg_img = 'background-image: url( '. esc_url( $vc_bg_img ) .' );';
	} else {
		if ( $background_image !== '' ) {
		  $bg_img = 'background-image: url( '. esc_url( $background_image ) .' );';
		}		
	}
	
	if ( $background_style == 'parallax' ) {
	  wp_enqueue_script( 'symple_parallax' );
	}
	$container_class = null;
	if ( $center_content == 'true' ) {
		$container_class = 'container';
	}
	return '<div class="symple-background clr style-'. $background_style .' '. $class .'" style="'. $bg_img .';background-color: '. esc_attr( $background_color ) .';padding-top:'. intval( $padding_top ) .'px;padding-bottom: '. intval( $padding_bottom ) .'px;padding-left: '. intval( $padding_left ) .'px;padding-right: '. intval( $padding_right ) .'px;margin-top: '. intval( $margin_top ) .'px;margin-bottom: '. intval( $margin_bottom ) .'px;color:'. $text_color .';" />
			<div class="'. $container_class .' symple-background-content clr">'. do_shortcode( wp_kses_post( $content )  ).'</div>
		</div>';
}
add_shortcode( 'symple_background', 'symple_background_shortcode' );


// Social Icons -------------------------------------------------------------------------- >	
function symple_social_shortcode( $atts ){

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'icon'   => 'twitter',
		'url'    => 'http://www.twitter.com/',
		'title'  => 'Follow Us',
		'target' => 'self',
		'rel'    => '',
		'class'  => '',
	), $atts ) );

	// Sanitize data
	$icons_url  = plugin_dir_url( __FILE__ ) .'images/social/';
	$icon_path  = plugin_dir_path( __FILE__ ) .'images/social/'. $icon .'.png';
	$url        = esc_url( $url );
	$rel        = 'nofollow' == $rel ? ' rel="nofollow"' : null;
	$target     = ( strpos( $target, 'blank' ) !== false ) ? '  target="_blank"' : null;

	// Return output
	if ( $url && file_exists( $icon_path ) ) {
		return '<a href="'. $url .'" class="symple-social-icon '. esc_attr( $class ) .'" title="'. esc_attr( $title ) .'"'. $target . $rel .'><img src="'. esc_url( $icons_url ) . esc_attr( $icon ) .'.png" alt="'. esc_attr( $icon ) .'" /></a>';
	}

}
add_shortcode( 'symple_social', 'symple_social_shortcode' );


// Highlights -------------------------------------------------------------------------- >	
function symple_highlight_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'color'	=> 'yellow',
		'class'	=> '',
	  ),
	  $atts ) );

	// Return output
	return '<span class="symple-highlight symple-highlight-'. esc_attr( $color ) .' '. esc_attr( $class ) .'">'. do_shortcode( wp_kses_post( $content ) ) .'</span>';

}
add_shortcode( 'symple_highlight', 'symple_highlight_shortcode' );

// Buttons -------------------------------------------------------------------------- >
function symple_button_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'color'         => 'blue',
		'url'           => '',
		'title'         => __( 'Visit Site', 'symple' ),
		'target'        => 'self',
		'size'          => 'normal',
		'rel'           => '',
		'border_radius' => '',
		'class'         => '',
		'icon_left'     => '',
		'icon_right'    => '',
		'fade_in'       => '',
		'align'         => '',
	), $atts ) );
	
	// Display Button
	if ( $url && $content ) {

		// Define output
		$output = '';

		// Target
		$target = ( 'blank' == $target || '_blank' == $target ) ? ' target="_blank"' : '';

		// Rel attribute
		$rel = ( $rel !== 'none' ) ? 'rel="'.$rel.'"' : null;

		// Icon Classes
		$icon_left  = symple_shortcodes_font_icon_class( $icon_left );
		$icon_right = symple_shortcodes_font_icon_class( $icon_right );

		// Load required scripts
		if ( $icon_left || $icon_right ) {
			wp_enqueue_style( 'font-awesome' );
		}

		// Inline style
		$border_radius_style = $border_radius ? 'style="border-radius:'. esc_attr( $border_radius ) .'"' : null;

		// Fade In Class
		$fade_in_class = null;
		if ( $fade_in == 'true' ) {
			wp_enqueue_script( 'symple_scroll_fade' );
			$fade_in_class = 'symple-fadein';
		}

		// Ouput
		$output .= '<a href="'. esc_url( $url ) .'" class="symple-button '. esc_attr( $size ) .' '. esc_attr( $color ) .' '. esc_attr( $class ) .' '. $fade_in_class .' '. esc_attr( $align ) .'"'. $target .'" title="'. esc_attr( $title ) .'" '. $border_radius_style .' '. $rel .'>';
			$output .= '<span class="symple-button-inner" '. $border_radius_style .'>';
				if ( $icon_left ) {
					$output .= '<span class="symple-button-icon-left '. esc_attr( $icon_left ) .'"></span>';
				}
				$output .= $content;
				if ( $icon_right ) {
					$output .= '<span class="symple-button-icon-right '. esc_attr( $icon_right ) .'"></span>';
				}
			$output .= '</span>';
		$output .= '</a>';

		return $output;

	} else {

		return '<p>'. __( 'Please enter a valid URL and content for your button.', 'symple' ) .'</p>';

	}

}
add_shortcode( 'symple_button', 'symple_button_shortcode' );


// Boxes -------------------------------------------------------------------------- >
function symple_box_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'color'			=> 'gray',
		'float'			=> 'center',
		'text_align'	=> 'left',
		'width'			=> '100%',
		'margin_top'	=> '',
		'margin_bottom'	=> '',
		'class'			=> '',
		'fade_in'		=> 'false',
	), $atts ) );

	// Fade In
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}

	// Inline style
	$style_attr = '';
	if ( $text_align ) {
		$style_attr .= 'text-align:'. $text_align .';';
	}
	if ( $margin_bottom ) {
		$style_attr .= 'margin-bottom: '. $margin_bottom .';';
	}
	if ( $margin_top ) {
		$style_attr .= 'margin-top: '. $margin_top .';';
	}
	if ( $width ) {
		$style_attr .= 'width: '. $width .';';
	}
	if ( $style_attr ) {
		$style_attr = 'style="'. esc_attr( $style_attr ) .'"';
	}

	// Classes
	$classes = 'symple-box';
	if ( $fade_in_class ) {
		$classes .= ' '. $fade_in_class;
	}
	if ( $color ) {
		$classes .= ' '. $color;
	}
	if ( $float ) {
		$classes .= ' '. $float;
	}
	if ( $class ) {
		$classes .= ' '. $class;
	}

	// Output
	$output  = '';
	$output .= '<div class="'. esc_attr( $classes ) .'" '. $style_attr .'>';
		$output .= do_shortcode( wp_kses_post( $content ) );
	$output .= '</div>';
	return $output;

}
add_shortcode( 'symple_box', 'symple_box_shortcode' );


// Testimonial -------------------------------------------------------------------------- >
function symple_testimonial_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'by'      => '',
		'class'   => '',
		'fade_in' => 'false',
	), $atts ) );

	// Fade In
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}

	// Output
	$output = '';
	$output .= '<div class="symple-testimonial '. esc_attr( $class ) .' '. $fade_in_class .'">';
		$output .= '<div class="symple-testimonial-content symple-clearfix">'. wpautop( do_shortcode( wp_kses_post( $content ) ) ) .'</div>';
		if ( $by ) {
			$output .= '<div class="symple-testimonial-author">'. esc_html( $by ) .'</div>';
		}
	$output .= '</div>';

	// Return output
	return $output;

}
add_shortcode( 'symple_testimonial', 'symple_testimonial_shortcode' );


// Columns -------------------------------------------------------------------------- >
function symple_column_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'size'     => 'one-third',
		'position' =>'first',
		'fade_in'  => 'false',
		'class'    => '',
	), $atts ) );

	// Fade-IN
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}

	// Output
	$output = '<div class="symple-column symple-'. esc_attr( $size ) .' symple-column-'. esc_attr( $position ).' '. esc_attr( $class ) .' '. $fade_in_class .'">'. do_shortcode( wp_kses_post( $content ) ) .'</div>';
	if ( $position == 'last' ) {
	  $output .= '<div class="symple-clear-floats"></div>';
	}

	// Return output
	return $output;

}
add_shortcode( 'symple_column', 'symple_column_shortcode' );


// Toggle -------------------------------------------------------------------------- >
function symple_toggle_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Toggle Title',
		'class'	=> '',
		'state'	=> 'closed',
	), $atts ) );
	 
	// Enque scripts
	wp_enqueue_script( 'symple_toggle' );
	
	// Active Class
	$active_class = ( $state == 'open' ) ? 'active' : null;
	
	// Return output
	return '<div class="symple-toggle state-'. esc_attr( $state ) .' '. esc_attr( $class ) .'"><h3 class="symple-toggle-trigger '. $active_class .'">'. esc_html( $title ) .'</h3><div class="symple-toggle-container symple-clearfix">'. do_shortcode( wp_kses_post( $content ) ) .'</div></div>';

}
add_shortcode( 'symple_toggle', 'symple_toggle_shortcode' );


// Accordion -------------------------------------------------------------------------- >

// Main
function symple_accordion_main_shortcode( $atts, $content = null  ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'class'	=> ''
	), $atts ) );
	
	// Enque scripts
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'symple_accordion' );
	
	// Return output
	return '<div class="symple-accordion '. esc_attr( $class ) .'">'. do_shortcode( wp_kses_post( $content ) ) .'</div>';

}
add_shortcode( 'symple_accordion', 'symple_accordion_main_shortcode' );


// Section
function symple_accordion_section_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Title',
		'class'	=> '',
	), $atts ) );
	
	// Return output
	return '<h3 class="symple-accordion-trigger '. esc_attr( $class ) .'"><a href="#">'. esc_html( $title ) .'</a></h3><div class="symple-clearfix">'. do_shortcode( wp_kses_post( $content ) ) .'</div>';

}

add_shortcode( 'symple_accordion_section', 'symple_accordion_section_shortcode' );


// Tabs -------------------------------------------------------------------------- >
function symple_tabgroup_shortcode( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(), $atts ) );

	//Enque scripts
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'symple_tabs' );

	preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	$tab_titles = array();
	if ( isset( $matches[1] ) ) {
		$tab_titles = $matches[1];
	}
	$output = '';
	if ( count( $tab_titles ) ) {
		$output .= '<div id="symple-tab-'. rand( 1, 10000 ) .'" class="symple-tabs">';
		$output .= '<ul class="ui-tabs-nav symple-clearfix">';
		foreach( $tab_titles as $tab ){
			$output .= '<li><a href="#symple-tab-'. sanitize_title( $tab[0] ) .'">'. $tab[0] .'</a></li>';
		}
		$output .= '</ul>';
		$output .= do_shortcode( wp_kses_post( $content ) );
		$output .= '</div>';
	} else {
		$output .= do_shortcode( wp_kses_post( $content ) );
	}
	// Return output
	return $output;

}
add_shortcode( 'symple_tabgroup', 'symple_tabgroup_shortcode' );

function symple_tab_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'	=> 'Tab',
		'class'	=> ''
	), $atts ) );

	// Return output
	return '<div id="symple-tab-'. sanitize_title( $title ) .'" class="tab-content symple-clearfix '. esc_attr( $class ) .'">'. do_shortcode( wp_kses_post( $content ) ) .'</div>';

}
add_shortcode( 'symple_tab', 'symple_tab_shortcode' );


// WPML -------------------------------------------------------------------------- >
function symple_wpml_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'lang'	=> '',
	), $atts ) );

	// Translate
	if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
		return __( 'WPML ICL_LANGUAGE_CODE constant does not exist. If you want to translate something please first install the WPML plugin.', 'symple' );
	}

	// Return string
	if ( $lang == ICL_LANGUAGE_CODE ) {
		return do_shortcode( wp_kses_post( $content ) );
	}

}
add_shortcode( 'symple_wpml', 'symple_wpml_shortcode' );


// Pricing Table -------------------------------------------------------------------------- >
 
/*main*/
function symple_pricing_table_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'class'	=> ''
	), $atts ) );

	// Return output
	return '<div class="symple-pricing-table '. esc_attr( $class ) .'">'. do_shortcode( wp_kses_post( $content ) ) .'</div><div class="symple-clear-floats"></div>';

}
add_shortcode( 'symple_pricing_table', 'symple_pricing_table_shortcode' );

/*section*/
function symple_pricing_shortcode( $atts, $content = null  ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'size'					=> 'one-half',
		'position'				=> 'default',
		'featured'				=> 'no',
		'plan'					=> 'Basic',
		'cost'					=> '$20',
		'per'					=> 'month',
		'button_url'			=> '',
		'button_text'			=> '',
		'button_color'			=> 'blue',
		'button_target'			=> 'self',
		'button_rel'			=> 'nofollow',
		'button_border_radius'	=> '',
		'class'					=> '',
		'button_icon_left'		=> '',
		'button_icon_right'		=> '',
	), $atts ) );
	
	// Sanitize data
	$featured_pricing    = $featured == 'yes' ? ' featured' : null;
	$border_radius_style = $button_border_radius ? 'style="border-radius:'. esc_attr( $button_border_radius ) .'"' : null;
	
	// Output
	$output ='';
	$output .= '<div class="symple-pricing symple-'. esc_attr( $size ) . $featured_pricing .' symple-column-'. esc_attr( $position ).' '. esc_attr( $class ) .'">';

		// Heading
		if ( $plan || $cost || $per ) {

			$output .= '<div class="symple-pricing-header">';

			// Plan
			if ( $plan ) {
				$output .= '<h5>'. esc_html( $plan ) .'</h5>';
			}

			// Cost
			if ( $cost ) {
				$output .= '<div class="symple-pricing-cost">'. esc_html( $cost ) .'</div>';
			}

			// Per
			if ( $per ) {
				$output .= '<div class="symple-pricing-per">'. esc_html( $per ) .'</div>';
			}

			$output .= '</div>';

		}

		// Features/Content
		if ( $content ) {
			$output .= '<div class="symple-pricing-content">';

				$output .= wp_kses_post( $content );

			$output .= '</div>';
		}

		// Button
		if ( $button_url && $button_text ) {

			$button_target     = ( strpos( $button_target, 'blank' !== false ) ) ? ' target="_blank"' : null;
			$button_rel        = 'nofollow' == $button_rel ? ' rel="nofollow"' : null;
			$button_icon_left  = symple_shortcodes_font_icon_class( $button_icon_left );
			$button_icon_right = symple_shortcodes_font_icon_class( $button_icon_right );

			// Load required scripts
			if ( $button_icon_left || $button_icon_right ) {
				wp_enqueue_style( 'font-awesome' );
			}

			$output .= '<div class="symple-pricing-button"><a href="'. esc_url( $button_url ) .'" class="symple-button '. esc_attr( $button_color ) .'" '. $button_target . $button_rel . $border_radius_style .'><span class="symple-button-inner" '. $border_radius_style .'>';
				if ( $button_icon_left ) {
					$output .= '<span class="symple-button-icon-left '. esc_attr( $button_icon_left ) .'"></span>';
				}
				$output .= $button_text;
				if ( $button_icon_right ) {
					$output .= '<span class="symple-button-icon-right '. esc_attr( $button_icon_right ) .'"></span>';
				}
			$output .= '</span></a></div>';

		}

	$output .= '</div>';

	// Return output
	return $output;

}
add_shortcode( 'symple_pricing', 'symple_pricing_shortcode' );


// Heading -------------------------------------------------------------------------- >
function symple_heading_shortcode( $atts ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'title'			=> __( 'Sample Heading', 'symple' ),
		'type'			=> 'h2',
		'style'			=> 'double-line',
		'margin_top'	=> '',
		'margin_bottom'	=> '',
		'text_align'	=> '',
		'font_size'		=> '',
		'color'			=> '',
		'class'			=> '',
		'span_bg'       => '',
		'icon_left'		=> '',
		'icon_right'	=> ''
	  ),
	  $atts ) );

	// Sanitize icons
	$icon_right = symple_shortcodes_font_icon_class( $icon_right );
	$icon_left  = symple_shortcodes_font_icon_class( $icon_left );
	  
	// Load required scripts
	if ( $icon_left || $icon_right) {
		wp_enqueue_style( 'font-awesome' );
	}
	
	// Inline styles
	$style_attr = '';
	if ( $font_size ) {
		$style_attr .= 'font-size: '. $font_size .';';
	}
	if ( $color ) {
		$style_attr .= 'color: '. $color .';';
	}
	if ( $margin_bottom ) {
		$style_attr .= 'margin-bottom: '. intval( $margin_bottom ) .'px;';
	}
	if ( $margin_top ) {
		$style_attr .= 'margin-top: '. intval( $margin_top ) .'px;';
	}
	if ( $style_attr ) {
		$style_attr = 'style="'. esc_attr( $style_attr ) .'"';
	}
	if ( $span_bg ) {
		$span_bg = ' style="background-color:'. esc_attr( $span_bg ) .';"';
	}

	// Text aligns
	if ( $text_align ) {
		$text_align = 'text-align-'. $text_align;
	} else {
		$text_align = 'text-align-left';
	}
	
	// Output
	$output = '<'.$type.' class="symple-heading symple-heading-'. esc_attr( $style ) .' '. esc_attr( $text_align ) .' '. esc_attr( $class ) .'"'. $style_attr .'>';

		$output .= '<span'. $span_bg .'>';

			if ( $icon_left ) {

				$output .= '<i class="symple-heading-icon-left '. esc_attr( $icon_left ) .'"></i>';

			}
				$output .= esc_html( $title );

			if ( $icon_right ) {

				$output .= '<i class="symple-heading-icon-right '. esc_attr( $icon_right ) .'"></i>';

			}

		$output .= '</span>';

	$output .= '</'.$type.'>';
	
	// Return output
	return $output;

}
add_shortcode( 'symple_heading', 'symple_heading_shortcode' );


// Google Maps -------------------------------------------------------------------------- >
function symple_shortcode_googlemaps( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'title'    => '',
			'location' => '',
			'width'    => '',
			'height'   => '300',
			'zoom'     => 8,
			'align'    => '',
			'class'    => '',
	), $atts ) );

	// Check for API key
	$options = get_option( 'symple_shortcodes' );
	$api_key = isset( $options['google_maps_api'] ) ? $options['google_maps_api'] : '';
	$api_key = apply_filters( 'symple_shortcodes_google_map_api_key', $api_key );
	if ( ! $api_key ) {
		return '<p>'. __( 'Google map can not be displayed. An API key is required. Please see Settings > Symple Shortcodes for more info.', 'symple' ) .'</p>';
	}

	// Breaks customizer
	if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) {
		return '<p>'. __( 'Google map disabled in the customizer.', 'symple' ) .'</p>';
	}
	
	// load scripts
	wp_enqueue_script( 'symple_googlemap' );
	wp_enqueue_script( 'symple_googlemap_api' );
	
	
	$output = '<div id="map_canvas_'.rand( 1, 10000 ).'" class="googlemap '. esc_attr( $class ) .'" style="height:'. intval( $height ) .'px;width:100%">';
		if ( ! empty( $title ) ) {
			$output .= '<input class="title" type="hidden" value="'. esc_attr( $title ) .'" />';
		}
		$output .= '<input class="location" type="hidden" value="'. esc_attr( $location ) .'" />';
		$output .= '<input class="zoom" type="hidden" value="'. intval( $zoom ) .'" />';
		$output .= '<div class="map_canvas"></div>';
	$output .= '</div>';
	
	// Return output
	return $output;
   
}
add_shortcode( "symple_googlemap", "symple_shortcode_googlemaps" );


// Divider -------------------------------------------------------------------------- >
function symple_divider_shortcode( $atts ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'style'			=> 'solid',
		'margin_top'	=> '',
		'margin_bottom'	=> '',
		'class'			=> '',
	  ),
	$atts ) );

	// Inline Styles
	$style_attr = '';
	if ( $margin_top && $margin_bottom ) {  
		$style_attr = 'style="margin-top: '. intval( $margin_bottom ) .'px;margin-bottom: '. intval( $margin_top ) .'px;"';
	} elseif ( $margin_bottom ) {
		$style_attr = 'style="margin-bottom: '. intval( $margin_bottom ) .'px;"';
	} elseif ( $margin_top ) {
		$style_attr = 'style="margin-top: '. intval( $margin_top ) .'px;"';
	} else {
		$style_attr = null;
	}

	// Return output
	return '<hr class="symple-divider '. esc_attr( $style ) .' '. esc_attr( $class ) .'" '. $style_attr .' />';

}
add_shortcode( 'symple_divider', 'symple_divider_shortcode' );


// Recent News -------------------------------------------------------------------------- >
function symple_news_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'      => '',
			'post_type'      => 'post',
			'taxonomy'       => '',
			'term_slug'      => '',
			'count'          => '12',
			'columns'        => '3',
			'order'          => 'DESC',
			'orderby'        => 'date',
			'header'         => '',
			'heading'        => 'h3',
			'date'           => 'true',
			'excerpt_length' => '15',
			'read_more'		 => 'false',
			'read_more_text' => __( 'read more', 'symple' ),
			'filter_content' => 'false',
			'offset'         => 0,
			'taxonomy'       => '',
			'terms'          =>'',
		), $atts ) );
		
	// Post Type doesn't exist, get me out of here!
	if ( ! post_type_exists( $post_type ) ) {
		return __( 'Sorry the post type you have selected does not exist', 'symple' );
	}
	
	// Start Tax Query
	$tax_query = '';
	if ( $taxonomy && $term_slug ) {

		if ( ! taxonomy_exists( $taxonomy ) ) {
			return __( 'Your selected taxonomy does not exist', 'symple' );
		}

		if ( ! term_exists( $term_slug, $taxonomy ) ) {
			return __( 'Your selected term does not exist', 'symple' );
		}

		$tax_query = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_slug,
			),
		);

	}
	
	// The Query
	$symple_news_query = new WP_Query( array(
		'post_type'      => $post_type,
		'posts_per_page' => $count,
		'offset'         => $offset,
		'order'          => $order,
		'orderby'        => $orderby,
		'tax_query'		 => $tax_query,
		'filter_content' => $filter_content,
		'no_found_rows'  => true,
	) );

	$output = '';

	//Output posts
	if ( $symple_news_query->posts ) :
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-recent-news symple-clearfix"'. $unique_id .'>';
		
		// Header
		if ( $header ) {
			$output .= '<h2 class="symple-recent-news-header">'. esc_html( $header ) .'</h2>';
		}
	
		// Loop through posts
		foreach ( $symple_news_query->posts as $post ) :
		
			// Post VARS
			$post_id        = $post->ID;
			$url            = get_permalink( $post_id );
			$post_title     = get_the_title( $post_id );
			$post_excerpt   = $post->post_excerpt;
			$custom_excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), $excerpt_length );

			// News article start
			if ( $post_title || $post_excerpt || $custom_excerpt ) {
				
				$output .= '<article id="post-'. intval( $post_id ) .'" class="symple-recent-news-entry fitvids symple-clearfix">';
				
					// Date
					if ( $date ) {

						$output .= '<div class="symple-recent-news-date"><span class="day">'. get_the_time( 'd', $post_id ) .'</span><span class="month">'. get_the_time( 'M', $post_id ) .'</span></div>';

					}
				
					// Open recent news entry
					$output .= '<div class="symple-news-entry-details symple-clearfix">';

						// Title
						$output .= '<header class="symple-recent-news-entry-title">';
							$output .= '<'. esc_attr( $heading ) .' class="symple-recent-news-entry-title-heading"><a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'">'. esc_html( $post_title ) .'</a></'. esc_attr( $heading ) .'>';
						$output .= '</header><!-- .symple-recent-news-entry-title -->';
						
						// Excerpt
						$output .= '<div class="symple-recent-news-entry-excerpt symple-clearfix">';

							if ( $post_excerpt ) {

								$output .= wp_kses_post( $post_excerpt .'&hellip;' );

							} else {

								$output .= $custom_excerpt; // Sanitized by wp_trim_words already

							}

							if ( $read_more == 'true' && ( $post_excerpt || $custom_excerpt ) ) {

								$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-recent-news-entry-readmore">'. esc_html( $read_more_text ) .' &rarr;</a>';

							}

						$output .= '</div>';
					
					// Close details div
					$output .= '</div>';
					
				// Close main wrap
				$output .= '</article>';
			
			}
		
		// End foreach loop
		endforeach;
		
		// Close main wrap
		$output .= '</div>';
	
	endif; // End has posts check
			
	// Set things back to normal
	$symple_news_query = null;
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( 'symple_news', 'symple_news_shortcode' );

// Recent Posts -------------------------------------------------------------------------- >
function symple_posts_grid_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'post_type'			=> 'post',
			'taxonomy'			=> '',
			'term_slug'			=> '',
			'count'				=> '12',
			'style'				=> 'default', // Maybe add more styles in the future?
			'fade_in'			=> 'false',
			'columns'			=> '3',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'thumbnail_link'	=> 'post',
			'img_crop'			=> 'true',
			'img_width'			=> '9999',
			'img_height'		=> '9999',
			'title'				=> 'true',
			'meta'				=> 'true',
			'excerpt'			=> 'true',
			'excerpt_length'	=> '15',
			'read_more'			=> 'false',
			'read_more_text'	=> __( 'read more', 'symple' ),
			'pagination'		=> 'false',
			'filter_content'	=> 'false',
			'offset'			=> 0,
			'taxonomy'			=> '',
			'terms'				=> '',
		), $atts ) );
	
	// Post Type doesn't exist, get me out of here!
	if ( ! post_type_exists( $post_type ) ) {
		return __( 'Sorry the post type you have selected does not exist', 'symple' );
	}
	
	// FadeIn Class
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}
	
	// Start Tax Query
	$tax_query = '';

	if ( $taxonomy && $term_slug ) {

		if ( $taxonomy && ! taxonomy_exists( $taxonomy ) ) {
			return esc_html__( 'Your selected taxonomy does not exist', 'symple' );
		}

		if ( $term_slug && ! term_exists( $term_slug, $taxonomy ) ) {
			return esc_html__( 'Your selected term does not exist', 'symple' );
		}

		$tax_query = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_slug,
			),
		);

	}
	
	// Pagination var
	if ( $pagination == 'true' ) {
		global $paged;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	} else {
		$paged = null;
	}
	
	// The Query
	$symple_query = new WP_Query( array(
		'post_type'			=> $post_type,
		'posts_per_page'	=> $count,
		'offset'			=> $offset,
		'order'				=> $order,
		'orderby'			=> $orderby,
		'tax_query'			=> $tax_query,
		'filter_content'	=> $filter_content,
		'paged'				=> $paged
	) );

	$output = '';

	//Output posts
	if ( $symple_query->posts ) :
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-recent-posts symple-clearfix"'. $unique_id .'>';

			$output .= '<div class="symple-grid symple-clearfix">';
		
			// Loop through posts
			$count=0;
			foreach ( $symple_query->posts as $post ) :
			$count++;
			
				// Post VARS
				$post_id          = $post->ID;
				$thumb_url        = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$featured_img     = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$url              = get_permalink( $post_id );
				$post_title       = get_the_title( $post_id );
				$post_excerpt     = $post->post_excerpt;
				$custom_excerpt   = wp_trim_words( strip_shortcodes( $post->post_content ), $excerpt_length);
				
				// Load scripts
				if ( $thumbnail_link == 'lightbox' ) {
					wp_enqueue_script( 'magnific-popup' );
					wp_enqueue_script( 'symple_lightbox' );
				}
				
				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$cropped_img = symple_shortcodes_img_resize( $thumb_url, $img_width, $img_height, $thumbnail_hard_crop );
				}

				// Recent post article start
				$output .= '<article id="post-'. intval( $post_id ) .'" class="symple-recent-posts-entry symple-col symple-count-'. $count .' symple-col-'. esc_attr( $columns ) .' fitvids '. $fade_in_class .' symple-grid-'. esc_attr( $post_type ) .'">';
				
					// Media Wrap
					if ( has_post_thumbnail( $post_id ) ) {

						$output .= '<div class="symple-recent-posts-entry-media">';
						
							if ( $thumbnail_link == 'none' ) {

								$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';

							} elseif ( $thumbnail_link == 'lightbox' ) {

								$output .= '<a href="'. esc_url( $thumb_url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-recent-posts-entry-img symple-shortcodes-lightbox">';
									
									$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';
								
								$output .= '</a>';
							
							} else {
								
								$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-recent-posts-entry-img">';
									
									$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';
								
								$output .= '</a>';
							
							}
							
						$output .= '</div>';
					}
				
					// Open details div
					if ( $title == 'true' || $excerpt == 'true' ) {

						$output .= '<div class="symple-recent-posts-entry-details">';

							// Title
							if ( $title == 'true' ) {

								$output .= '<header class="symple-recent-posts-entry-heading">';

									$output .= '<h3 class="symple-recent-posts-entry-title"><a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'">'. esc_html( $post_title ) .'</a></h3>';

								$output .= '</header>';

							}
							
							// Excerpt
							if ( $excerpt == 'true' ) {

								$output .= '<div class="symple-recent-posts-entry-excerpt">';

									if ( $post_excerpt ) {
										$output .= $post_excerpt;
									} else {
										$output .= $custom_excerpt;
									}

									if ( $read_more == 'true' && ( $post_excerpt || $custom_excerpt ) ) { 
										
										$output .= '<span class="symple-recent-posts-entry-readmore-wrap"><a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-recent-posts-entry-readmore">'. esc_html( $read_more_text ) .' &rarr;</a></span>';
									
									}

								$output .= ' </div>';

							}
					
						// Close details div
						$output .= '</div>';
					}
					
				// Close main wrap	
				$output .= '</article>';

				// Reset counter
				if ( $count == $columns ) {
					$count = '0';
				}
			
			// End foreach loop
			endforeach;
			
			// Close main wrap
			$output .= '</div>';

		$output .= '</div>';
		
		// Paginate Posts
		if ( $pagination == 'true' ) {

			$output .= '<div class="symple-grid-pagination symple-clearfix">';

				$total = $symple_query->max_num_pages;

				$big = 999999999; // need an unlikely integer

				if ( $total > 1 )  {
					 if ( ! $current_page = get_query_var( 'paged' ) )
						 $current_page = 1;
					 if ( get_option( 'permalink_structure' ) ) {
						 $format = 'page/%#%/';
					 } else {
						 $format = '&paged=%#%';
					 }
					 $output .= paginate_links(array(
						'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'	=> $format,
						'current'	=> max( 1, get_query_var( 'paged' ) ),
						'total'		=> $total,
						'mid_size'	=> 2,
						'type'		=> 'list',
						'prev_text'	=> '&laquo;',
						'next_text'	=> '&raquo;',
					 ));
				}

			$output .= '</div>';
		}
	
	endif; // End has posts check
			
	// Set things back to normal
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( "symple_posts_grid", "symple_posts_grid_shortcode" );

// Carousel -------------------------------------------------------------------------- >
function symple_carousel_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'post_type'			=> 'post',
			'taxonomy'			=> '',
			'term_slug'			=> '',
			'count'				=> '8',
			'item_width'		=> '400',
			'min_slides'		=> '1',
			'max_slides'		=> '3',
			'animation'			=> 'CSS',
			'auto_play'			=> 'false',
			'timeout_duration'	=> '5000',
			'pager'				=> 'true',
			'arrows'			=> 'true',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'thumbnail_link'	=> 'post',
			'img_crop'			=> 'true',
			'img_width'			=> '400',
			'img_height'		=> '300',
			'title'				=> 'true',
			'filter_content'	=> 'false',
			'offset'			=> 0,
			'taxonomy'			=> '',
			'terms'				=>'',
		), $atts ) );
		
	$output = '';

	// Sanitize data
	$post_type = esc_html( $post_type );
	
	// Too many!!
	if ( strpos( $post_type, ',' ) !== false ) {
		return __( 'Please select only 1 post type.', 'symple' );
	}
	
	// Post Type doesn't exist, get me out of here!
	if ( ! post_type_exists( $post_type ) ) {
		return __( 'Sorry the post type you have selected does not exist', 'symple' );
	}
	
	// Required Scripts
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'imagesLoaded' );
	
	// Give caroufredsel a unique name
	$rand_num 			= rand( 1, 10000 );
	$unique_carousel_id = 'caroufredsel-'. $rand_num;

	// Min & Max fallbacks
	$min_slides = $min_slides ? $min_slides : '1';
	$max_slides = $max_slides ? $max_slides : '3';
	
	// Output filter JS into the footer like a WP Jedi Master
	$output .= '
		<script type="text/javascript">
			jQuery(function($){
				if ( $.fn.carouFredSel!=undefined ){
					$( "#'. $unique_carousel_id .'" ).carouFredSel({
						responsive : true,
						height     : "variable",
						width      : "100%",
						auto       : {
							play            : '. esc_attr( $auto_play ) .',
							timeoutDuration : '. intval( $timeout_duration ) .'
						},
						swipe      : {
							onTouch : true,
							onMouse : true
						},';
						if ( $arrows == 'true' ) {
							$output .= 'prev : "#prev-'. $rand_num .'",';
							$output .= 'next : "#next-'. $rand_num .'",';
						}
						if ( $pager == 'true' ) {
							$output .= 'pagination : "#pager-'. $rand_num .'",';
						}
						$output .= 'items : {
							width : '. intval( $item_width ) .',
							height: "variable",
							visible : {
								min : '. $min_slides .',
								max : '. $max_slides .'
							}
						}
					} );
				}
				$( "#'. $unique_carousel_id .'" ).imagesLoaded( function() {
					$( ".'. $unique_carousel_id .'-wrap" ).css( {
						height   : "auto",
						overflow : "visible",
						opacity  : "1"
					} );
					$( "#'. $unique_carousel_id .'" ).trigger( "updateSizes" );
				} );
			} );
		</script>';
	
	// Start Tax Query
	$tax_query = '';

	if ( $taxonomy && $term_slug ) {

		if ( ! taxonomy_exists( $taxonomy ) ) {
			return __( 'Your selected taxonomy does not exist', 'symple' );
		}

		if ( ! term_exists( $term_slug, $taxonomy ) ) {
			return __( 'Your selected term does not exist', 'symple' );
		}

		$tax_query = array(
			array (
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_slug,
			)
		);

	}
	
	// The Query
	$symple_query = new WP_Query( array(
		'post_type'      => $post_type,
		'posts_per_page' => $count,
		'offset'         => $offset,
		'order'          => $order,
		'orderby'        => $orderby,
		'filter_content' => $filter_content,
		'no_found_rows'  => true,
		'tax_query'      => $tax_query,
		'meta_query'     => array( array(
			'key' => '_thumbnail_id'
		) )
	) );

	//Output posts
	if ( $symple_query->posts ) :
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : '';
	
		// Main wrapper div
		$output .= '<div class="symple-caroufredsel-wrap symple-clearfix post-type-'. $post_type .' '. $unique_carousel_id .'-wrap"'. $unique_id  .'>';
		
			// Pagination
			if ( $pager == 'true' ) {
				$output .= '<div class="symple-caroufredsel-pag-wrap"><div id="pager-'. $rand_num .'" class="symple-caroufredsel-pag"></div></div>';
			}
			
			$output .= '<div class="symple-caroufredsel"><ul id="'. $unique_carousel_id .'">';
		
			// Loop through posts
			foreach ( $symple_query->posts as $post ) :
			
				// Post VARS
				$post_id       = $post->ID;
				$thumb_url     = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$featured_img  = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$url           = get_permalink( $post_id) ;
				$url           = esc_url( $url );
				$post_title    = get_the_title( $post_id );
				
				// Load scripts
				if ( $thumbnail_link == 'lightbox' ) {
					wp_enqueue_script( 'magnific-popup' );
					wp_enqueue_script( 'symple_lightbox' );
				}
				
				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$featured_img        = symple_shortcodes_img_resize( $thumb_url, $img_width, $img_height, $thumbnail_hard_crop );
					$featured_img        = esc_url( $featured_img );
				}
	
				// Carousel item start
				$output .= '<li class="symple-caroufredsel-slide">';
				
					// Media Wrap
					if ( has_post_thumbnail($post_id) ) {
						$output .= '<div class="symple-caroufredsel-entry-media">';
						
							if ( $thumbnail_link == 'none' ) {

								$output .= '<img src="'. $featured_img .'" alt="'. esc_attr( $post_title ) .'" />';

							} elseif ( $thumbnail_link == 'lightbox' ) {

								$output .= '<a href="'. esc_url( $thumb_url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-caroufredsel-entry-img symple-shortcodes-lightbox">';
									
									$output .= '<img src="'. $featured_img .'" alt="'. esc_attr( $post_title ) .'" />';
								
								$output .= '</a>';
							
							} else {

								$output .= '<a href="'. $url .'" title="'. esc_attr( $post_title ) .'" class="symple-caroufredsel-entry-img">';
									
									$output .= '<img src="'. $featured_img .'" alt="'. esc_attr( $post_title ) .'" />';
								$output .= '</a>';

							
							}
							
							if ( $title == 'true' && $post_title ) {
								
								$output .= '<div class="symple-caroufredsel-entry-title"><a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'">'. esc_html( $post_title ) .'</a></div>';

							}
							
						$output .= '</div>';
					}
					
				// Close main wrap	
				$output .= '</li>';
			
			// End foreach loop
			endforeach;
			
			// End UL
			$output .= '</ul>';
			
			// Next/Prev arrows	
			if ( $arrows == 'true' ) {
				$output .= '<div id="prev-'. $rand_num .'" class="symple-caroufredsel-prev">Prev</div><div id="next-'. $rand_num .'" class="symple-caroufredsel-next">Next</div>';
			}
		
		// Close main wrap
		$output .= '</div></div>';
	
	endif; // End has posts check
	
	
	// Set things back to normal
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( "symple_carousel", "symple_carousel_shortcode" );
	
// FlexSlider -------------------------------------------------------------------------- >
function symple_flexslider_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'style'				=> 'images',
			'post_type'			=> 'post',
			'taxonomy'			=> '',
			'term_slug'			=> '',
			'count'				=> '4',
			'animation'			=> 'slide',
			'slideshow'			=> 'true',
			'randomize'			=> 'false',
			'direction'			=> 'horizontal',
			'slideshow_speed'	=> '7000',
			'animation_speed'	=> '600',			
			'control_nav'		=> 'true',
			'direction_nav'		=> 'true',
			'pause_on_hover'	=> 'true',
			'smooth_height'		=> 'true',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'thumbnail_link'	=> 'post',
			'img_crop'			=> 'false',
			'img_width'			=> '980',
			'img_height'		=> '400',
			'title'				=> 'true',
			'filter_content'	=> 'false',
			'offset'			=> 0,
			'taxonomy'			=> '',
			'terms'				=>'',
		), $atts ) );
		
	$output = '';
	
	// Post Type doesn't exist, get me out of here!
	if ( ! post_type_exists( $post_type ) ) {
		return __( 'Sorry the post type you have selected does not exist', 'symple' );
	}
	
	// Required Scripts
	wp_enqueue_script( 'imagesLoaded' );
	wp_enqueue_script( 'flexslider' );
	
	// Give flexslider a unique name
	$rand_num 			  = rand( 1, 100000 );
	$unique_flexslider_id = 'flexslider-'. $rand_num;
	
	// JS output
	$output .= '<script type="text/javascript">
		jQuery( function($) {
			$( "#'. $unique_flexslider_id .'" ).imagesLoaded( function() {
				$( ".symple-flexslider-wrap" ).removeClass( "flexslider-loader" );
				$( "#'. $unique_flexslider_id .'" ).flexslider({
					animation      : "'. esc_attr( $animation ) .'",
					slideshow      : '. esc_attr( $slideshow ) .',
					randomize      : '. esc_attr( $randomize ) .',
					direction      : "'. esc_attr( $direction ) .'",
					slideshowSpeed : '. intval( $slideshow_speed ) .',
					animationSpeed : '. intval( $animation_speed ) .',
					controlNav     : '. esc_attr( $control_nav ) .',
					directionNav   : '. esc_attr( $direction_nav ) .',
					pauseOnHover   : '. esc_attr( $pause_on_hover ) .',
					smoothHeight   : '. esc_attr( $smooth_height ) .',
					prevText       : \'<i class=fa fa-angle-left"></i>\',
					nextText       : \'<i class="fa fa-angle-right"></i>\'
				} );
			} );
		} );
	</script>';

	// Start Tax Query
	$tax_query = '';

	if ( $taxonomy && $term_slug ) {

		if ( ! taxonomy_exists( $taxonomy ) ) {
			return __( 'Your selected taxonomy does not exist', 'symple' );
		}

		if ( ! term_exists( $term_slug, $taxonomy ) ) {
			return __( 'Your selected term does not exist', 'symple' );
		}

		$tax_query = array(
			array (
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_slug,
			)
		);

	}
	
	// The Query
	$symple_query = new WP_Query(
		array(
			'post_type'			=> $post_type,
			'posts_per_page'	=> $count,
			'offset'			=> $offset,
			'order'				=> $order,
			'orderby'			=> $orderby,
			'filter_content'	=> $filter_content,
			'no_found_rows'		=> true,
			'tax_query'			=> $tax_query,
			'meta_query' 		=> array( array( 'key' => '_thumbnail_id' ) ),
		)
	);

	//Output posts
	if ( $symple_query->posts ) :
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-flexslider-wrap clr symple-flexslider-'. esc_attr( $post_type ) .' flexslider-loader flexslider-style-'. esc_attr( $style ) .'"'. $unique_id  .'>';

			$output .= '<div id="'. $unique_flexslider_id .'" class="symple-flexslider flexslider"><ul class="slides">';
		
			// Loop through posts
			foreach ( $symple_query->posts as $post ) :
			
				// Post VARS
				$post_id      = $post->ID;
				$thumb_url    = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$featured_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
				$url          = get_permalink( $post_id );
				$post_title   = get_the_title( $post_id );
				
				// Load scripts
				if ( $thumbnail_link == 'lightbox' ) {
					wp_enqueue_script( 'magnific-popup' );
					wp_enqueue_script( 'symple_lightbox' );
				}
				
				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$cropped_img         = symple_shortcodes_img_resize( $thumb_url, $img_width, $img_height, $thumbnail_hard_crop );
				}
				
				// Media Wrap
				if ( $cropped_img ) {
	
					// Slide item start
					$output .= '<li class="symple-flexslider-slide slide">';
							$output .= '<div class="symple-flexslider-entry-media">';
							
								if ( $thumbnail_link == 'none' ) {

									$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';
								
								} elseif ( $thumbnail_link == 'lightbox' ) {
									
									$output .= '<a href="'. esc_url( $thumb_url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-flexslider-entry-img symple-shortcodes-lightbox">';
										
										$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';
									
									$output .= '</a>';
								
								} else {
									
									$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'" class="symple-flexslider-entry-img">';
										
										$output .= '<img src="'. esc_url( $cropped_img ) .'" alt="'. esc_attr( $post_title ) .'" />';
									
									$output .= '</a>';
								
								}
								
								if ( $title == 'true' && $post_title ) {
									
									$output .= '<div class="symple-flexslider-entry-title"><a href="'. esc_url( $url ) .'" title="'. esc_attr( $post_title ) .'">'. esc_html( $post_title ) .'</a></div>';
								
								}
								
							$output .= '</div>';
						
					// Close main wrap	
					$output .= '</li>';
				
				}
			
			// End foreach loop
			endforeach;
			
			// End UL
			$output .= '</ul>';
		
		// Close main wrap
		$output .= '</div></div>';
	
	endif; // End has posts check
	
	
	// Set things back to normal
	$symple_query = null;
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( 'symple_flexslider', 'symple_flexslider_shortcode' );

// Custom FlexSlider -------------------------------------------------------------------------- >
function symple_flexslider_custom_shortcode( $atts, $content=null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'style'				=> 'content',
			'animation'			=> 'slide',
			'slideshow'			=> 'true',
			'randomize'			=> 'false',
			'direction'			=> 'horizontal',
			'slideshow_speed'	=> '7000',
			'animation_speed'	=> '600',			
			'control_nav'		=> 'true',
			'direction_nav'		=> 'true',
			'pause_on_hover'	=> 'true',
			'smooth_height'		=> 'true',
		), $atts ) );
		
	$output = '';
	
	// Required Scripts
	wp_enqueue_script( 'imagesLoaded' );
	wp_enqueue_script( 'flexslider' );
	
	// Give flexslider a unique name
	$rand_num 			  = rand( 1, 10000 );
	$unique_flexslider_id = 'flexslider-'. $rand_num;
	
	// Output filter JS into the footer like a WP Jedi Master
	$output .= '
	<script type="text/javascript">
		jQuery(function($){
			$( "#'. $unique_flexslider_id .'" ).imagesLoaded( function() {
				$( ".symple-flexslider-wrap" ).removeClass( "flexslider-loader" );
				$( "#'. $unique_flexslider_id .'" ).flexslider({
					animation      : "'. esc_attr( $animation ) .'",
					slideshow      : '. esc_attr( $slideshow ) .',
					randomize      : '. esc_attr( $randomize ) .',
					direction      : "'. esc_attr( $direction ) .'",
					slideshowSpeed : '. intval( $slideshow_speed ) .',
					animationSpeed : '. intval( $animation_speed ) .',
					controlNav     : '. esc_attr( $control_nav ) .',
					directionNav   : '. esc_attr( $direction_nav ) .',
					pauseOnHover   : '. esc_attr( $pause_on_hover ) .',
					smoothHeight   : '. esc_attr( $smooth_height ) .',
					prevText       : \'<i class=fa fa-angle-left"></i>\',
					nextText       : \'<i class="fa fa-angle-right"></i>\'
				} );
			} );
		} );
	</script>';

	$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;

	// Main wrapper div
	$output .= '<div class="symple-flexslider-wrap clr flexslider-loader flexslider-style-'. esc_attr( $style ) .'"'. $unique_id  .'>';

		// Flex slider start
		$output .= '<div id="'. $unique_flexslider_id .'" class="symple-flexslider flexslider"><ul class="slides">';					
			
			// Slides will display here
			$output .= do_shortcode ( wp_kses_post( $content ) ); 
		
		// End UL
		$output .= '</ul>';
	
	// Close main wrap
	$output .= '</div></div><div class="symple-clear-floats"></div>';

	// Return output
	return $output;
	
}
add_shortcode( 'symple_flexslider_custom', 'symple_flexslider_custom_shortcode' );

function symple_slide_shortcode( $atts, $content = null ) {

	// Define output
	$output = '<li class="symple-flexslider-slide slide">'. do_shortcode( wp_kses_post( $content ) ) .'</li>';

	// Return output
	return $output;

}
add_shortcode( 'symple_flex_slide', 'symple_slide_shortcode' );

// Carousel Custom -------------------------------------------------------------------------- >
function symple_carousel_custom_shortcode( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'unique_id'  => '',
		'item_width' => '400',
		'min_slides' => '1',
		'max_slides' => '3',
		'animation'  => 'CSS',
		'auto_play'  => 'false',
		'pager'      => 'true',
		'arrows'     => 'true',
	), $atts ) );
		
	$output = '';
	
	// Required Scripts
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'imagesLoaded' );
	
	// Give caroufredsel a unique name
	$rand_num 			= rand( 1, 10000 );
	$unique_carousel_id = 'caroufredsel-'. $rand_num;
	
	// Output filter JS into the footer like a WP Jedi Master
	$output .= '
		<script type="text/javascript">
			jQuery(function($){
				$(document).ready(function(){
					$( "#'. $unique_carousel_id .'" ).carouFredSel({
						responsive : true,
						height     : "variable",
						width      : "100%",
						auto       : '. esc_attr( $auto_play ) .',
						swipe      : {
							onTouch : true,
							onMouse : true
						},';
						if ( $arrows == 'true' ) {
							$output .= 'prev : "#prev-'. $rand_num .'",';
							$output .= 'next : "#next-'. $rand_num .'",';
						}
						if ( $pager == 'true' ) {
							$output .= 'pagination : "#pager-'. $rand_num .'",';
						}
						$output .= 'items : {
							width   : '. intval( $item_width ) .',
							height  : "variable",
							visible : {
								min : '. intval( $min_slides ) .',
								max : '. intval( $max_slides ) .'
							}
						}
					} );
				} );
				$( "#'. $unique_carousel_id .'" ).imagesLoaded( function() {
					$( ".'. $unique_carousel_id .'-wrap" ).css( {
						height   : "auto",
						overflow : "visible",
						opacity  : "1"
					} );
					$( "#'. $unique_carousel_id .'" ).trigger( "updateSizes" );
				} );
			} );
		</script>';
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-caroufredsel-wrap symple-clearfix"'. $unique_id  .'>';
		
			// Pagination
			if ( $pager == 'true' ) {

				$output .= '<div class="symple-caroufredsel-pag-wrap"><div id="pager-'. $rand_num .'" class="symple-caroufredsel-pag"></div></div>';

			}
			
			$output .= '<div class="symple-caroufredsel symple-clearfix"><ul id="'. $unique_carousel_id .'">';
				
					// Output slides here
					$output .= do_shortcode( wp_kses_post( $content ) );
			
			// End UL
			$output .= '</ul>';
			
			// Next/Prev arrows	
			if ( $arrows == 'true' ) {

				$output .= '<div id="prev-'. $rand_num .'" class="symple-caroufredsel-prev">Prev</div><div id="next-'. $rand_num .'" class="symple-caroufredsel-next">Next</div>';

			}
		
		// Close main wrap
		$output .= '</div></div>';

	// Return output
	return $output;
	
}
add_shortcode( "symple_carousel_custom", "symple_carousel_custom_shortcode" );

function symple_slide_carousel_shortcode( $atts, $content = null ) {
	$output = '';
	$output .= '<li class="symple-caroufredsel-slide">';
		$output .= '<div class="symple-caroufredsel-entry-media">';
			$output .= do_shortcode( wp_kses_post( $content ) );
		$output .= '</div>';
	$output .= '</li>';
	return $output;
}
add_shortcode( 'symple_carousel_slide', 'symple_slide_carousel_shortcode' );


// Attachments Carousel -------------------------------------------------------------------------- >
function symple_attachments_carousel_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'image_ids'			=> '',
			'item_width'		=> '400',
			'min_slides'		=> '1',
			'max_slides'		=> '3',
			'animation'			=> 'CSS',
			'auto_play'			=> 'false',
			'pager'				=> 'true',
			'arrows'			=> 'true',
			'order'				=> 'DESC',
			'orderby'			=> 'menu_order',
			'thumbnail_link'	=> 'lightbox',
			'img_crop'			=> 'true',
			'img_width'			=> '400',
			'img_height'		=> '300',
			'title'				=> 'true',
		), $atts ) );
		
	$output = '';

	// Return if there aren't any images defined
	if ( empty( $image_ids ) ) {
		return '<p>'. __( 'Please select some images for your image carousel.', 'symple' ) .'</p>';
	}
	
	// Required Scripts
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'imagesLoaded' );
	
	// Give caroufredsel a unique name
	$rand_num 			= rand( 1, 10000 );
	$unique_carousel_id = 'caroufredsel-'. $rand_num;
	
	// Output filter JS into the footer like a WP Jedi Master
	$output .= '
		<script type="text/javascript">
			jQuery(function($){
				$(document).ready(function(){
					$( "#'. $unique_carousel_id .'" ).carouFredSel({
						responsive : true,
						height     : "variable",
						width      : "100%",
						auto       : '. esc_attr( $auto_play ) .',
						swipe      : {
							onTouch : true,
							onMouse : true
						},';
						if ( $arrows == 'true' ) {
							$output .= 'prev : "#prev-'. $rand_num .'",';
							$output .= 'next : "#next-'. $rand_num .'",';
						}
						if ( $pager == 'true' ) {
							$output .= 'pagination : "#pager-'. $rand_num .'",';
						}
						$output .= 'items : {
							width   : '. intval( $item_width ) .',
							height  : "variable",
							visible : {
								min : '. intval( $min_slides ) .',
								max : '. intval( $max_slides ) .'
							}
						}
					} );
				} );
				$( "#'. $unique_carousel_id .'" ).imagesLoaded( function() {
					$( ".'. $unique_carousel_id .'-wrap" ).css( {
						height   : "auto",
						overflow : "visible",
						opacity  : "1"
					} );
					$( "#'. $unique_carousel_id .'" ).trigger( "updateSizes" );
				} );
			} );
		</script>';
	
	// Get specific ID's
	$include = $post_in = null;
	$post_parent = get_the_ID();
	if ( $image_ids ) {
		$post_parent = null;
		$post_in = explode( ",",$image_ids );
		$post_in = array_combine($post_in,$post_in);
	}
	
	// The Query
	$attachments = new WP_Query( array(
		'orderby'        => $order,
		'order'          => $orderby,
		'post_type'      => 'attachment',
		'post_parent'    => $post_parent,
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => -1,
		'post__in'       => $post_in,
	) );

	//Output posts
	if ( $attachments->have_posts() ) :
	
		$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-caroufredsel-wrap symple-clearfix post-type-attachments '. $unique_carousel_id .'-wrap"'. $unique_id  .'>';
		
			// Pager
			if ( $pager == 'true' ) {
				$output .= '<div class="symple-caroufredsel-pag-wrap"><div id="pager-'. $rand_num .'" class="symple-caroufredsel-pag"></div></div>';
			}
			
			$output .= '<div class="symple-caroufredsel symple-clearfix"><ul id="'. $unique_carousel_id .'">';
		
			// Loop through attachments
			while ( $attachments->have_posts() ) : $attachments->the_post();
			
				// Attachment VARS
				$attachment_id		= get_the_ID();
				$attachment_link	= get_post_meta( $attachment_id, '_wp_attachment_url', true );
				$attachment_img_url	= wp_get_attachment_url( $attachment_id );
				$attachment_img		= wp_get_attachment_url( $attachment_id );
				$attachment_alt		= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
				$attachment_title	= get_the_title( $attachment_id );
				
				// Load scripts
				if ( $thumbnail_link == 'lightbox' ) {
					wp_enqueue_script( 'magnific-popup' );
					wp_enqueue_script( 'symple_lightbox' );
				}
				
				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$attachment_img      = symple_shortcodes_img_resize( $attachment_img, $img_width, $img_height, $thumbnail_hard_crop );
					$attachment_img      = $attachment_img;
				}
	
				// Carousel item start
				$output .= '<li class="symple-caroufredsel-slide">';
				
					// Media Wrap
					$output .= '<div class="symple-caroufredsel-entry-media">';
					
						if ( $thumbnail_link == 'lightbox' ) {

							$output .= '<a href="'. esc_url( $attachment_img_url ) .'" title="'. esc_attr( $attachment_title ) .'" class="symple-caroufredsel-entry-img symple-shortcodes-lightbox">';
								
								$output .= '<img src="'. esc_url( $attachment_img ) .'" alt="'. esc_attr( $attachment_alt  ) .'" />';
							
							$output .= '</a>';
						
						} else {
							
							$output .= '<img src="'. esc_url( $attachment_img ) .'" alt="'. esc_attr( $attachment_alt ) .'" />';
						
						}
						
						if ( $title == 'true' && $attachment_title ) {
							
							if ( $attachment_link ) {
							
							$output .= '<div class="symple-caroufredsel-entry-title"><a href="'. esc_url( $attachment_link ) .'" title="'. esc_attr( $attachment_title ) .'">'. esc_html( $attachment_title ) .'</a></div>';
							
							} else {
								
								$output .= '<div class="symple-caroufredsel-entry-title">'. esc_html( $attachment_title ) .'</div>';
							
							}
						}
						
					$output .= '</div>';
					
				// Close main wrap	
				$output .= '</li>';
			
			// End foreach loop
			endwhile;
			
			// End UL
			$output .= '</ul>';
			
			// Next/Prev arrows	
			if ( $arrows == 'true' ) {
				$output .= '<div id="prev-'. $rand_num .'" class="symple-caroufredsel-prev">Prev</div><div id="next-'. $rand_num .'" class="symple-caroufredsel-next">Next</div>';
			}
		
		// Close main wrap
		$output .= '</div></div>';
	
	endif; // End has attachments check
	
	// Reset query
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( "symple_attachments_carousel", "symple_attachments_carousel_shortcode" );

// Attachments / FlexSlider -------------------------------------------------------------------------- >
function symple_attachments_flexslider_shortcode( $atts ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'style'				=> 'images',
			'image_ids'			=> '',
			'animation'			=> 'slide',
			'slideshow'			=> 'true',
			'randomize'			=> 'false',
			'direction'			=> 'horizontal',
			'slideshow_speed'	=> '7000',
			'animation_speed'	=> '600',			
			'control_nav'		=> 'true',
			'direction_nav'		=> 'true',
			'pause_on_hover'	=> 'true',
			'smooth_height'		=> 'true',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'thumbnail_link'	=> 'lightbox',
			'img_crop'			=> 'false',
			'img_width'			=> '980',
			'img_height'		=> '400',
			'title'				=> 'true',
			'filter_content'	=> 'false',
			'offset'			=> 0,
		), $atts ) );
		
	$output = '';
	
	// Required Scripts
	wp_enqueue_script( 'imagesLoaded' );
	wp_enqueue_script( 'flexslider' );
	
	// Give flexslider a unique name
	$rand_num             = rand( 1, 10000 );
	$unique_flexslider_id = 'flexslider-'. $rand_num;
	
	// Output filter JS into the footer like a WP Jedi Master
	$output .= '
		<script type="text/javascript">
			jQuery(function($){
				$( "#'. $unique_flexslider_id .'" ).imagesLoaded( function() {
					$( ".symple-flexslider-wrap" ).removeClass( "flexslider-loader" );
					$( "#'. $unique_flexslider_id .'" ).flexslider({
						animation      : "'. esc_attr( $animation ) .'",
						slideshow      : '. esc_attr( $slideshow ) .',
						randomize      : '. esc_attr( $randomize ) .',
						direction      : "'. esc_attr( $direction ) .'",
						slideshowSpeed : '. intval( $slideshow_speed ) .',
						animationSpeed : '. intval( $animation_speed ) .',
						controlNav     : '. esc_attr( $control_nav ) .',
						directionNav   : '. esc_attr( $direction_nav ) .',
						pauseOnHover   : '. esc_attr( $pause_on_hover ) .',
						smoothHeight   : '. esc_attr( $smooth_height ) .',
						prevText       : \'<i class=icon-angle-left"></i>\',
						nextText       : \'<i class="icon-angle-right"></i>\'
					} );
				} );
			} );
		</script>';
	
	// Get specific ID's
	$include = null;
	$post_parent = get_the_ID(); // Fallback
	if ( $image_ids ) {
		$post_parent = null;
		$post_in = explode( ",",$image_ids );
		$post_in = array_combine( $post_in, $post_in );
	}
	
	// The Query
	$symple_query = new WP_Query( array(
		'orderby'        => $order,
		'order'          => $orderby,
		'post_type'      => 'attachment',
		'post_parent'    => $post_parent, // Fallback
		'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png',
		'posts_per_page' => -1,
		'post__in'       => $post_in,
		'post_status'    => 'any',
	) );

	//Output posts
	if ( $symple_query->have_posts() ) :
	
		$unique_id = $unique_id ? ' id="'. $unique_id .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="symple-flexslider-wrap symple-clearfix symple-flexslider-attachments flexslider-loader flexslider-style-'. esc_attr( $style ) .'"'. $unique_id  .'>';

			$output .= '<div id="'. $unique_flexslider_id .'" class="symple-flexslider flexslider"><ul class="slides">';
		
			// Loop through attachments
			while ( $symple_query->have_posts() ) : $symple_query->the_post();
			
				// Attachment VARS
				$attachment_id		= get_the_ID();
				$attachment_link	= esc_url( get_post_meta( $attachment_id, '_wp_attachment_url', true ) );
				$attachment_img_url	= esc_url( wp_get_attachment_url( $attachment_id ) );
				$attachment_img		= wp_get_attachment_url( $attachment_id );
				$attachment_alt		= get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
				$attachment_title	= get_the_title( $attachment_id );
				
				// Load scripts
				if ( $thumbnail_link == 'lightbox' ) {
					wp_enqueue_script( 'magnific-popup' );
					wp_enqueue_script( 'symple_lightbox' );
				}
				
				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$attachment_img      = symple_shortcodes_img_resize( $attachment_img, $img_width, $img_height, $thumbnail_hard_crop );
					$attachment_img      = $attachment_img;
				}
	
				// Slide item start
				$output .= '<li class="symple-flexslider-slide slide">';
				
						$output .= '<div class="symple-flexslider-entry-media">';
						
							if ( $thumbnail_link == 'lightbox' ) {
								
								$output .= '<a href="'. esc_url( $attachment_img_url ) .'" title="'. esc_attr( $attachment_title ) .'" class="symple-flexslider-entry-img symple-shortcodes-lightbox">';
									
									$output .= '<img src="'. esc_url( $attachment_img ) .'" alt="'. esc_attr( $attachment_alt ) .'" />';
								
								$output .= '</a>';
							
							} else {
								
								$output .= '<img src="'. esc_url( $attachment_img ) .'" alt="'. esc_attr( $attachment_alt ) .'" />';
							
							}
							
							if ( $title == 'true' && $attachment_title ) {
								
								$output .= '<div class="symple-flexslider-entry-title">'. esc_html( $attachment_title ) .'</div>';
							
							}
							
						$output .= '</div>';
					
				// Close main wrap
				$output .= '</li>';
			
			// End foreach loop
			endwhile;
			
			// End UL
			$output .= '</ul>';
		
		// Close main wrap
		$output .= '</div></div>';
	
	endif; // End has posts check
	
	// Reset query
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode( "symple_attachments_flexslider", "symple_attachments_flexslider_shortcode" );

// Font Awesome Icons -------------------------------------------------------------------------- >
function symple_icon_shortcode( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'unique_id'     => '',
		'icon'          => 'cloud',
		'style'         => 'circle',
		'float'         => 'left',
		'size'          => 'normal',
		'color'         => '',
		'background'    => '',
		'border_radius' => '',
		'fade_in'       => 'false',
		'url'           => '',
		'url_title'     => '',
	), $atts ) );
	
	// Load font awesome
	wp_enqueue_style( 'font-awesome' );
	
	$output = '';
	
	// FadeOut
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'symple_scroll_fade' );
		$fade_in_class = 'symple-fadein';
	}
	
	// Sanitize icon
	$icon = $icon == 'none' ? 'remove' : $icon;
	
	// Inline style
	$style_attr = '';

	if ( $color ) {
		$style_attr .= 'color:'. $color .';';
	}
	if ( $background ) {
		$style_attr .= 'background-color:'. $background .';';
	}
	if ( $border_radius ) {
		$style_attr .= 'border-radius:'. $border_radius .';';
	}
	if ( $style_attr ) {
		$style_attr = ' style="'. esc_attr( $style_attr ) .'"';
	}
	
	// Unique ID
	$unique_id = $unique_id ? ' id="'. esc_attr( $unique_id ) .'"' : null;
	
	if ( $url ) {
		
		$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $url_title ) .'" class="symple-icon symple-icon-'. esc_attr( $style ).' symple-icon-'. esc_attr( $size ) .' symple-icon-float-'. esc_attr( $float ) .' '. $fade_in_class .'" '. $unique_id . $style_attr .' >';
		
		$output .= '<span class="'. esc_attr( symple_shortcodes_font_icon_class( $icon ) ) .'"></span>';
		
		$output .= '</a>';
	} else {
		
		$output .= '<span class="symple-icon symple-icon-'. esc_attr( $style ) .' symple-icon-'. esc_attr( $size ) .' symple-icon-float-'. esc_attr( $float ) .' '. esc_attr( symple_shortcodes_font_icon_class( $icon ) ) .' '. $fade_in_class .'"'. $unique_id . $style_attr .'"></span>';
	
	}
	
	// Return output
	return $output;

}
add_shortcode( 'symple_icon', 'symple_icon_shortcode' );