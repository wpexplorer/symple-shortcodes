<?php
/**
 * Map all shortcodes to the Visual Composer
 *
 * @package   Symple Shortcodes
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.wpexplorer.com
 * @since     1.0.0
 */

function symple_shortcodes_vc_map() {

	// Store data -------------------------------------------------------------------------- >
	$order_by = array(
		 __( 'Date', 'symple' )           => 'date',
		 __( 'Name', 'symple' )          => 'name',
		 __( 'Modified', 'symple' )       => 'modified',
		 __( 'Author', 'symple' )        => 'author',
		 __( 'Random', 'symple' )         => 'random',
		 __( 'Comment Count', 'symple' ) => 'comment_count',
	);
	$button_sizes = array(
		__( 'Default', 'symple' )  => '',
		__( 'Small', 'symple' )    => 'small',
		__( 'Medium', 'symple' )   => 'medium',
		__( 'Large', 'symple' )    => 'large',
	);

	// Spacing -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Spacing', 'symple' ),
		'base'        => 'symple_spacing',
		'description' => __( 'Adds spacing anywhere you need it', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-v',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'admin_label' => true,
				'heading'     => __( 'Spacing', 'symple' ),
				'param_name'  => 'size',
				'value'       => '30px',
				'description' => __( 'Enter a height in pixels for your spacing.', 'symple' )
			),
		)
	) );


	// Bullets -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Bullets', 'symple' ),
		'base'        => 'symple_bullets',
		'description' => __( 'Styled bulleted lists', 'symple' ),
		'category'    => __( 'Symple Shortcodes' , 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-dot-circle-o',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'class'       => '',
				'heading'     => __( 'Style', 'symple' ),
				'param_name'  => 'style',
				'value'       => array(
					__( 'Check', 'symple' )	 => 'check',
					__( 'Blue', 'symple' )	 => 'blue',
					__( 'Gray', 'symple' )	 => 'gray',
					__( 'Purple', 'symple' ) => 'purple',
					__( 'Red', 'symple' )    => 'red',
				),
				'description'	=> __( 'Select your bullet style.', 'symple' )
			),
			array(
				'type'			=> 'textarea_html',
				'heading'		=> __( 'List', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> '<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>',
				'description'	=> __( 'Insert your unordered list here.', 'symple' )
			),
		)
	) );


	/* Background Area -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Background Area', 'symple' ),
		'base'        => 'symple_background',
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-picture-o',
		'description' => __( 'Create a colored background area', 'symple' ),
		'params'      => array(
			array(
				'type'			=> 'colorpicker',
				'admin_label'	=> true,
				'heading'		=> __( 'Background Color', 'symple' ),
				'param_name'	=> 'background_color',
				'value'			=> '#fff',
				'description'	=> __( 'Background Color (Hex)', 'symple' ),
			),
			array(
				'type'			=> 'colorpicker',
				'heading'		=> __( 'Text Color', 'symple' ),
				'param_name'	=> 'text_color',
				'value'			=> '#000',
				'description'	=> __( 'Text Color (Hex)', 'symple' ),
			),
			array(
				'type'			=> 'attach_image',
				'admin_label'	=> true,
				'heading'		=> __( 'Background Image', 'symple' ),
				'param_name'	=> 'background_image',
				'description'	=> __( 'Upload a custom background image.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Background Style', 'symple' ),
				'param_name'	=> 'background_style',
				'description'	=> __( 'Select a background style.', 'symple' ),
				'value'			=> array(
					 __( 'Parallax', 'symple' )	=> 'parallax',
					 __( 'Fixed', 'symple' )	=> 'fixed',
					 __( 'Repeat', 'symple' )	=> 'repeat',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Center Content', 'symple' ),
				'param_name'	=> 'center_content',
				'description'	=> __( 'Center inner content?', 'symple' ),
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Padding Top', 'symple' ),
				'param_name'	=> 'padding_top',
				'value'			=> '40px',
				'description'	=> __( 'Increase the bacground padding above your content.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Padding Bottom', 'symple' ),
				'param_name'	=> 'padding_bottom',
				'value'			=> '40px',
				'description'	=> __( 'Increase the bacground padding below your content.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Margin Top', 'symple' ),
				'param_name'	=> 'margin_top',
				'value'			=> '0px',
				'description'	=> __( 'Add space above your content with a top margin.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Margin Bottom', 'symple' ),
				'param_name'	=> 'margin_bottom',
				'value'			=> '0px',
				'description'	=> __( 'Add space below your content with a top margin.', 'symple' ),
			),
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> __( 'Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> __( 'Enter your content here.', 'symple' ),
				'description'	=> __( 'Add your content here.', 'symple' )
			),
		)
	) ); */


	// Buttons -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Button', 'symple' ),
		'base'        => 'symple_button',
		'description' => __( 'Symple Shortcode Button', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-external-link',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'URL', 'symple' ),
				'param_name'	=> 'url',
				'value'			=> 'http://www.google.com/',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> 'Button Text',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Link Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> 'Visit Site',
			),
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Button Color', 'symple' ),
				'param_name'	=> 'color',
				'value'			=> array(
					__( 'Black', 'symple' )  => 'black',
					__( 'Blue', 'symple' )   => 'blue',
					__( 'Brown', 'symple' )  => 'brown',
					__( 'Grey', 'symple' )   => 'grey',
					__( 'Green', 'symple' )  => 'green',
					__( 'Gold', 'symple' )   => 'gold',
					__( 'Orange', 'symple' ) => 'orange',
					__( 'Pink', 'symple' )   => 'pink',
					__( 'Red', 'symple' )    => 'red',
					__( 'Rosy', 'symple' )   => 'rosy',
					__( 'Teal', 'symple' )   => 'teal',
					__( 'Navy', 'symple' )   => 'navy',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Button Size', 'symple' ),
				'param_name' => 'size',
				'value'      => $button_sizes,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Align', 'symple' ),
				'param_name' => 'align',
				'value'      => array(
					__( 'Default', 'symple' ) => '',
					__( 'Inline', 'symple' )  => 'aligninline',
					__( 'Left', 'symple' )    => 'alignleft',
					__( 'Right', 'symple' )   => 'alignright',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Border Radius', 'symple' ),
				'param_name' => 'border_radius',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Target', 'symple' ),
				'param_name' => 'target',
				'value'      => array(
					 __( 'Self', 'symple' )   => 'self',
					 __( 'Blank', 'symple' ) => 'blank',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Link Rel', 'symple' ),
				'param_name' => 'rel',
				'value'      => array(
					 __( 'None', 'symple' )      => 'none',
					 __( 'Nofollow', 'symple' ) => 'nofollow',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Left', 'symple' ),
				'param_name' => 'icon_left',
				'value'      => symple_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Right', 'symple' ),
				'param_name' => 'icon_right',
				'value'      => symple_shortcodes_font_icons_array(),
			),
		)
	) );


	// Boxes -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Box', 'symple' ),
		'base'        => 'symple_box',
		'description' => __( 'Boxed content area', 'symple' ),
		'category'    => __( 'Symple Shortcodes' , 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-square-o',
		'params'      => array(
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Color', 'symple' ),
				'param_name'	=> 'color',
				'value'			=> array(
					__( 'Black', 'symple' )   => 'black',
					__( 'Blue', 'symple' )   => 'blue',
					__( 'Gray', 'symple' )   => 'gray',
					__( 'Green', 'symple' )  => 'green',
					__( 'Red', 'symple' )    => 'red',
					__( 'Yellow', 'symple' ) => 'yellow',
					__( 'White', 'symple' )  => 'white',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Fade In', 'symple' ),
				'param_name'	=> 'fade_in',
				'description'	=> __( 'Fade In Animation', 'symple' ),
				'value'			=> array(
					 __( 'False', 'symple' ) => 'false',
					 __( 'True', 'symple' )   => 'true',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Float', 'symple' ),
				'param_name'	=> 'float',
				'description'	=> __( 'Select a box float.', 'symple' ),
				'value'			=> array(
					 __( 'Default', 'symple' )	=> '',
					 __( 'Center', 'symple' )	=> 'center',
					 __( 'Left', 'symple' )		=> 'left',
					 __( 'Right', 'symple' )	=> 'right',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Text Alignment', 'symple' ),
				'param_name'	=> 'text_align',
				'description'	=> __( 'Select a text alignment', 'symple' ),
				'value'			=> array(
					 __( 'Default', 'symple' )	=> '',
					 __( 'Left', 'symple' )		=> 'left',
					 __( 'Center', 'symple' )	=> 'center',
					 __( 'Right', 'symple' )	=> 'right',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Box Width', 'symple' ),
				'param_name'  => 'width',
				'description' => __( 'Enter your custom width. Please define a px or % value.', 'symple' ),
			),
			array(
				'type'			=> 'textarea_html',
				'heading'		=> __( 'Box Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> 'This is your box content.',
			),
		)
	) );


	// Callouts -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Callout', 'symple' ),
		'base'        => 'symple_callout',
		'description' => __( 'Call to action area', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-v',
		'params'      => array(
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> __( 'Callout Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> __( 'Enter your content here.', 'symple' ),
				'description'	=> __( 'Callout Content', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Fade In', 'symple' ),
				'param_name'	=> 'fade_in',
				'description'	=> __( 'Fade In Animation', 'symple' ),
				'value'			=> array(
				 	__( 'False', 'symple' )	=> 'false',
					__( 'True', 'symple' )	=> 'true',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button: URL', 'symple' ),
				'param_name'	=> 'button_url',
				'value'			=> 'http://www.google.com/',
				'description'	=> __( 'Button: URL', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button: Text', 'symple' ),
				'param_name'	=> 'button_text',
				'value'			=> 'Button Text',
				'description'	=> __( 'Button: Text', 'symple' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Color', 'symple' ),
				'param_name'	=> 'button_color',
				'description'	=> __( 'Select a button color.', 'symple' ),
				'value'			=> array(
					 __( 'Black', 'symple' )  => 'black',
					 __( 'Blue', 'symple' )	  => 'blue',
					 __( 'Brown', 'symple' )  => 'brown',
					 __( 'Grey', 'symple' )   => 'grey',
					 __( 'Green', 'symple' )  => 'green',
					 __( 'Gold', 'symple' )   => 'gold',
					 __( 'Orange', 'symple' ) => 'orange',
					 __( 'Pink', 'symple' )   => 'pink',
					 __( 'Red', 'symple' )    => 'red',
					 __( 'Rosy', 'symple' )   => 'rosy',
					 __( 'Teal', 'symple' )   => 'teal',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Button: Size', 'symple' ),
				'param_name'  => 'button_size',
				'description' => __( 'Select a button size.', 'symple' ),
				'value'       => $button_sizes,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Button: Border Radius', 'symple' ),
				'param_name'  => 'button_border_radius',
				'description' => __( 'Button: Border Radius', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Link Target', 'symple' ),
				'param_name'	=> 'button_target',
				'value'			=> array(
					 __( 'Self', 'symple' )		=> 'self',
					 __( 'Blank', 'symple' )	=> 'blank',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Rel', 'symple' ),
				'param_name'	=> 'button_rel',
				'value'			=> array(
					 __( 'None', 'symple' )			=> 'none',
					 __( 'Nofollow', 'symple' )	=> 'nofollow',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Icon Left', 'symple' ),
				'param_name'	=> 'button_icon_left',
				'description'	=> sprintf( __( 'Icon to the left of your button text. See all the icons at %s', 'symple' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
				'value'			=> symple_shortcodes_font_icons_array(),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Button: Icon Right', 'symple' ),
				'param_name'	=> 'button_icon_right',
				'description'	=> sprintf( __( 'Icon to the left of your button text. See all the icons at %s', 'symple' ), '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome</a>' ),
				'value'			=> symple_shortcodes_font_icons_array(),
			),
		)
	) );


	// Dividers -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Divider', 'symple' ),
		'base'				=> 'symple_divider',
		'description'		=> __( 'Line Seperator', 'symple' ),
		'category'			=> __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-ellipsis-h',
		'params'			=> array(
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Style', 'symple' ),
				'param_name'	=> 'style',
				'value'			=> array(
					__( 'Solid', 'symple' )	=> 'solid',
					__( 'Dashed', 'symple' )	=> 'dashed',
					__( 'Dotted', 'symple' )	=> 'dotted',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Margin Top', 'symple' ),
				'param_name' => 'margin_top',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Margin Bottom', 'symple' ),
				'param_name' => 'margin_bottom',
			),
		)
	) );


	// Headings -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Symple Heading', 'symple' ),
		'base'        => 'symple_heading',
		'description' => __( 'Styled heading', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-font',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> 'This is a Heading',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Type', 'symple' ),
				'param_name' => 'type',
				'std'        => 'h2',
				'default'    => 'h2',
				'value'      => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'div'  => 'div',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Margin Top', 'symple' ),
				'param_name' => 'margin_top',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Margin Bottom', 'symple' ),
				'param_name' => 'margin_bottom',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Font Size', 'symple' ),
				'param_name' => 'font_size',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Heading Color', 'symple' ),
				'param_name' => 'color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Span Background', 'symple' ),
				'param_name' => 'span_bg',
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Heading Style', 'symple' ),
				'param_name'	=> 'style',
				'value'			=> array(
					 __( 'Double Line', 'symple' )	=> 'double-line',
					 __( 'Dashed Line', 'symple' )	=> 'dashed-line',
					 __( 'Dotted Line', 'symple' )	=> 'dotted-line',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Text Alignment', 'symple' ),
				'param_name'	=> 'text_align',
				'value'			=> array(
					 __( 'Left', 'symple' )		=> 'left',
					 __( 'Center', 'symple' )	=> 'center',
					 __( 'Right', 'symple' )	=> 'right',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Left', 'symple' ),
				'param_name' => 'icon_left',
				'value'      => symple_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Right', 'symple' ),
				'param_name' => 'icon_right',
				'value'      => symple_shortcodes_font_icons_array(),
			),
		)
	) );


	// Highlights -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Highlight', 'symple' ),
		'base'        => 'symple_highlight',
		'description' => __( 'Text highlighter', 'symple' ),
		'category'    => __( 'Symple Shortcodes' , 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-v',
		'params'      => array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Color', 'symple' ),
				'param_name'	=> 'color',
				'value'			=> array(
					__( 'Blue', 'symple' )   => 'blue',
					__( 'Green', 'symple' )  => 'green',
					__( 'Gray', 'symple' )   => 'gray',
					__( 'Red', 'symple' )    => 'red',
					__( 'Yellow', 'symple' ) => 'yellow',
				),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Highlighted Text', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> 'highlight me please',
				'description'	=> __( 'Add the text to be highlighted.', 'symple' )
			),
		)
	) );


	// Skillbars -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Skillbar', 'symple' ),
		'base'				=> 'symple_skillbar',
		'description'		=> __( 'Animated percentage bar', 'symple' ),
		'category'			=> __( 'Symple Shortcodes' , 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-bars',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> 'Web Design',
				'description'	=> __( 'Add your skillbar title.', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Percentage', 'symple' ),
				'param_name'	=> 'percentage',
				'value'			=> '70',
				'description'	=> __( 'Add a percentage value.', 'symple' )
			),
			array(
				'type'			=> 'colorpicker',
				'heading'		=> __( 'Background', 'symple' ),
				'param_name'	=> 'color',
				'value'			=> '#65C25C',
				'description'	=> __( 'Choose your custom background color (Hex value).', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display % Number', 'symple' ),
				'param_name'	=> 'show_percent',
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
		)
	) );


	// Social -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Social', 'symple' ),
		'base'				=> 'symple_social',
		'description'		=> __( 'Social icon', 'symple' ),
		'category'			=> __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-twitter',
		'params'			=> array(
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Social Icon', 'symple' ),
				'param_name'	=> 'icon',
				'description'	=> __( 'Select your social icon.', 'symple' ),
				'value'			=> symple_shortcodes_social_icons_array(),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'URL', 'symple' ),
				'param_name'	=> 'url',
				'value'			=> 'http://dribbble.com',
				'description'	=> __( 'Social Profile URL', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Link Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> 'Visit Site',
				'description'	=> __( 'Add A Social Link Title', 'symple' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Link Target', 'symple' ),
				'param_name'	=> 'target',
				'value'			=> array(
					 __( 'Self', 'symple' )		=> 'self',
					 __( 'Blank', 'symple' )	=> 'blank',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Link Rel', 'symple' ),
				'param_name'	=> 'rel',
				'value'			=> array(
					 __( 'None', 'symple' )			=> 'none',
					 __( 'Nofollow', 'symple' )	=> 'nofollow',
				),
			),
		)
	) );


	// Testimonials -------------------------------------------------------------------------- >
	vc_map( array(
		'name'				=> __( 'Testimonial', 'symple' ),
		'base'				=> 'symple_testimonial',
		'description'		=> __( 'Single testimonial', 'symple' ),
		'category'			=> __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-wechat',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Author', 'symple' ),
				'param_name'	=> 'by',
				'value'			=> 'Unknown Person',
				'description'	=> __( 'Testimonial Author', 'symple' )
			),
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> __( 'Testimonial Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> __( 'This product is amazing!', 'symple' ),
				'description'	=> __( 'This is where your testimonial goes.', 'symple' )
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Fade In', 'symple' ),
				'param_name'	=> 'fade_in',
				'description'	=> __( 'Fade In Animation', 'symple' ),
				'value'			=> array(
				 	__( 'False', 'symple' )	=> 'false',
					__( 'True', 'symple' )	=> 'true',
				),
			),
		)
	) );


	// WPML -------------------------------------------------------------------------- >
	/*if ( function_exists( 'icl_get_languages' ) ) {
		$ssp_wpml_type = 'dropdown';
		$ssp_wpml_value = icl_get_languages();
	} else {
		$ssp_wpml_type = 'textfield';
		$ssp_wpml_value = 'es';
	}*/

	vc_map( array(
		'name'				=> __( 'WPML', 'symple' ),
		'base'				=> 'symple_wpml',
		'description'		=> __( 'WPML translatable text.', 'symple' ),
		'category'			=> __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-language',
		'params'			=> array(
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Language', 'symple' ),
				'param_name'	=> 'lang',
				'value'			=> 'es',
				'description'	=> __( 'Select a WPML language.', 'symple' ),
			),
			array(
				'type'			=> 'textarea_html',
				'admin_label'	=> true,
				'heading'		=> __( 'Content', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> 'Hola',
			),
		)
	) );


	// Pricing Tables -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Pricing Table', 'symple' ),
		'base'        => 'symple_pricing',
		'description' => __( 'Insert a pricing column', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-dollar',
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Featured', 'symple' ),
				'param_name' => 'featured',
				'value'      => array(
					__( 'Yes', 'symple' )	=> 'yes',
					__( 'No', 'symple' )	=> 'no',
				),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Plan', 'symple' ),
				'param_name'	=> 'plan',
				'value'			=> 'Basic',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Cost', 'symple' ),
				'param_name'	=> 'cost',
				'value'			=> '$20',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Per (optional)', 'symple' ),
				'param_name'	=> 'per',
				'value'			=> 'month',
			),
			array(
				'type'			=> 'textarea_html',
				'heading'		=> __( 'Features', 'symple' ),
				'param_name'	=> 'content',
				'value'			=> '<ul>
										<li>30GB Storage</li>
										<li>512MB Ram</li>
										<li>10 databases</li>
										<li>1,000 Emails</li>
										<li>25GB Bandwidth</li>
									</ul>',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button: Text', 'symple' ),
				'param_name'	=> 'button_text',
				'value'			=> 'Button Text',
				'description'	=> __( 'Button: Text', 'symple' )
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Button: URL', 'symple' ),
				'param_name'	=> 'button_url',
				'value'			=> 'http://www.google.com/',
				'description'	=> __( 'Button: URL', 'symple' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Button: Color', 'symple' ),
				'param_name'  => 'button_color',
				'description' => __( 'Select a button color.', 'symple' ),
				'value'       => array(
					 __( 'Black', 'symple' )  => 'black',
					 __( 'Blue', 'symple' )   => 'blue',
					 __( 'Brown', 'symple' )  => 'brown',
					 __( 'Grey', 'symple' )   => 'grey',
					 __( 'Green', 'symple' )  => 'green',
					 __( 'Gold', 'symple' )   => 'gold',
					 __( 'Orange', 'symple' ) => 'orange',
					 __( 'Pink', 'symple' )   => 'pink',
					 __( 'Red', 'symple' )    => 'red',
					 __( 'Rosy', 'symple' )   => 'rosy',
					 __( 'Teal', 'symple' )   => 'teal',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Button: Size', 'symple' ),
				'param_name'  => 'button_size',
				'description' => __( 'Select a button size.', 'symple' ),
				'value'       => $button_sizes,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Button: Border Radius', 'symple' ),
				'param_name'  => 'button_border_radius',
				'description' => __( 'Button: Border Radius', 'symple' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Button: Link Target', 'symple' ),
				'param_name' => 'button_target',
				'value'      => array(
					 __( 'Self', 'symple' )  => 'self',
					 __( 'Blank', 'symple' ) => 'blank',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Button: Rel', 'symple' ),
				'param_name' => 'button_rel',
				'value'      => array(
					 __( 'None', 'symple' )     => 'none',
					 __( 'Nofollow', 'symple' ) => 'nofollow',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Button: Icon Left', 'symple' ),
				'param_name' => 'button_icon_left',
				'value'      => symple_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Button: Icon Right', 'symple' ),
				'param_name' => 'button_icon_right',
				'value'      => symple_shortcodes_font_icons_array(),
			),
		)
	) );


	// Posts Grid -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Post Grid', 'symple' ),
		'base'        => 'symple_posts_grid',
		'description' => __( 'Custom post type grid', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-th',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Unique Id', 'symple' ),
				'param_name'	=> 'unique_id',
				'description'	=> __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Post Type', 'symple' ),
				'param_name'  => 'post_type',
				'value'       => symple_shortcodes_get_post_types(),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Taxonomy', 'symple' ),
				'param_name'  => 'taxonomy',
				'value'       => symple_shortcodes_get_taxonomies(),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Term Slug', 'symple' ),
				'param_name'	=> 'term_slug',
				'description'	=> __( 'Enter the Term slug to get your posts from. This term must be a part of the taxonomy above. You can find your slug on your taxonomy dashboard. For regular posts that would be the Categories page.', 'symple' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Post Count', 'symple' ),
				'param_name'  => 'count',
				'value'       => '10',
				'description' => __( 'How many items do you wish to show.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Pagination', 'symple' ),
				'param_name'	=> 'pagination',
				'description'	=> __( 'Note: Pagination will not work on your homepage.', 'symple' ),
				'value'			=> array(
					 __( 'False', 'symple' ) => 'false',
					 __( 'True', 'symple' )  => 'true',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Columns', 'symple' ),
				'param_name'	=> 'columns',
				'std'           => '3',
				'value'			=> array(
					 __( '1', 'symple' )	=> '1',
					 __( '2', 'symple' )	=> '2',
					 __( '3', 'symple' )	=> '3',
					 __( '4', 'symple' )	=> '4',
					 __( '5', 'symple' )	=> '5',
					 __( '6', 'symple' )	=> '6',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' )	=> 'DESC',
					 __( 'ASC', 'symple' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order By', 'symple' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> $order_by,
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Link', 'symple' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 __( 'Post', 'symple' )     => 'post',
					 __( 'None', 'symple' )		=> 'none',
					 __( 'Lightbox', 'symple' ) => 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Crop', 'symple' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Width', 'symple' ),
				'param_name'	=> 'img_width',
				'description'	=> __( 'Enter a width in pixels.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Height', 'symple' ),
				'param_name'	=> 'img_height',
				'description'	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Excerpt', 'symple' ),
				'param_name'	=> 'excerpt',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Excerpt Length', 'symple' ),
				'param_name'	=> 'excerpt_length',
				'value'			=> '30',
				'description'	=> __( 'How many words do you want to display for your excerpt?', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Read More Link?', 'symple' ),
				'param_name'	=> 'read_more',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),	
		)
	) );


	// Recent News -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Recent News', 'symple' ),
		'base'        => 'symple_news',
		'description' => __( 'Recent blog posts', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-newspaper-o',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Unique Id', 'symple' ),
				'param_name'	=> 'unique_id',
				'description'	=> __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'admin_label'	=> true,
				'heading'		=> __( 'Post Type', 'symple' ),
				'param_name'	=> 'post_type',
				'value'			=> symple_shortcodes_get_post_types(),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Header', 'symple' ),
				'param_name' => 'header',
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Taxonomy', 'symple' ),
				'param_name'  => 'taxonomy',
				'value'       => symple_shortcodes_get_taxonomies(),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Term Slug', 'symple' ),
				'param_name'  => 'term_slug',
				'description' => __( 'Enter the Term slug to get your posts from. This term must be a part of the taxonomy above. You can find your slug on your taxonomy dashboard. For regular posts that would be the Categories page.', 'symple' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Post Count', 'symple' ),
				'param_name'  => 'count',
				'value'       => '3',
				'description' => __( 'How many items do you wish to show.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' ) => 'DESC',
					 __( 'ASC', 'symple' )  => 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order By', 'symple' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> $order_by,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Excerpt Length', 'symple' ),
				'param_name'  => 'excerpt_length',
				'value'       => '30',
				'description' => __( 'How many words do you want to display for your excerpt?', 'symple' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Read More Link?', 'symple' ),
				'param_name' => 'read_more',
				'value'      => array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),	
		)
	) );


	// Post Carousel -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Post Carousel', 'symple' ),
		'base'        => 'symple_carousel',
		'description' => __( 'Custom post type carousel', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-h',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Unique Id', 'symple' ),
				'param_name'  => 'unique_id',
				'description' => __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Post Type', 'symple' ),
				'param_name'  => 'post_type',
				'value'       => symple_shortcodes_get_post_types(),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Taxonomy', 'symple' ),
				'param_name'  => 'taxonomy',
				'value'       => symple_shortcodes_get_taxonomies(),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Term Slug', 'symple' ),
				'param_name'	=> 'term_slug',
				'description'	=> __( 'Enter the Term slug to get your posts from. This term must be a part of the taxonomy above. You can find your slug on your taxonomy dashboard. For regular posts that would be the Categories page.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Post Count', 'symple' ),
				'param_name'	=> 'count',
				'value'			=> '8',
				'description'	=> __( 'How many items do you wish to show.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' )		=> 'DESC',
					 __( 'ASC', 'symple' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order By', 'symple' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> $order_by,
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Item Width', 'symple' ),
				'param_name'	=> 'item_width',
				'value'			=> '400',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Min Slides', 'symple' ),
				'param_name'	=> 'min_slides',
				'value'			=> '1',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Max Slides', 'symple' ),
				'param_name'	=> 'max_slides',
				'value'			=> '3',
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Auto Play', 'symple' ),
				'param_name'	=> 'auto_play',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __('Timeout Duration (in milliseconds)', 'symple' ),
				'param_name' => 'timeout_duration',
				'value'      => '5000',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Display Pager?', 'symple' ),
				'param_name' => 'pager',
				'value'      => array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Arrows?', 'symple' ),
				'param_name'	=> 'arrows',
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Link', 'symple' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 __( 'Post', 'symple' )			=> 'post',
					 __( 'None', 'symple' )		=> 'none',
					 __( 'Lightbox', 'symple' )	=> 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Crop', 'symple' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Width', 'symple' ),
				'param_name'	=> 'img_width',
				'description'	=> __( 'Enter a width in pixels.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Height', 'symple' ),
				'param_name'	=> 'img_height',
				'description'	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
		)
	) );


	// Post Slider -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Post Slider', 'symple' ),
		'base'        => 'symple_flexslider',
		'description' => __( 'Custom post type slider', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-h',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Unique Id', 'symple' ),
				'param_name'	=> 'unique_id',
				'description'	=> __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Post Type', 'symple' ),
				'param_name'  => 'post_type',
				'value'       => symple_shortcodes_get_post_types(),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => __( 'Taxonomy', 'symple' ),
				'param_name'  => 'taxonomy',
				'value'       => symple_shortcodes_get_taxonomies(),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> __( 'Term Slug', 'symple' ),
				'param_name'	=> 'term_slug',
				'description'	=> __( 'Enter the Term slug to get your posts from. This term must be a part of the taxonomy above. You can find your slug on your taxonomy dashboard. For regular posts that would be the Categories page.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Post Count', 'symple' ),
				'param_name'	=> 'count',
				'value'			=> '8',
				'description'	=> __( 'How many items do you wish to show.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' ) => 'DESC',
					 __( 'ASC', 'symple' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order By', 'symple' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> $order_by,
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Link', 'symple' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 __( 'Post', 'symple' )     => 'post',
					 __( 'None', 'symple' )		=> 'none',
					 __( 'Lightbox', 'symple' )	=> 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Crop', 'symple' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 __( 'True', 'symple' )  => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Thumbnail Width', 'symple' ),
				'param_name'  => 'img_width',
				'description' => __( 'Enter a width in pixels.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Height', 'symple' ),
				'param_name'	=> 'img_height',
				'description'	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Animation', 'symple' ),
				'param_name'	=> 'animation',
				'value'			=> array(
					 __( 'Slide', 'symple' )	=> 'slide',
					 __( 'Fade', 'symple' )	=> 'fade',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Slideshow', 'symple' ),
				'param_name'	=> 'slideshow',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Randomize', 'symple' ),
				'param_name'	=> 'randomize',
				'value'			=> array(
					 __( 'False', 'symple' )	=> 'false',
					 __( 'True', 'symple' )		=> 'true',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Control Nav', 'symple' ),
				'param_name'	=> 'control_nav',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Direction Nav', 'symple' ),
				'param_name'	=> 'direction_nav',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Slideshow Speed', 'symple' ),
				'param_name'	=> 'slideshow_speed',
				'value'			=> '7000',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Animation Speed', 'symple' ),
				'param_name'	=> 'animation_speed',
				'value'			=> '600',
			),
		)
	) );

		
	// Attachments Carousel -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Image Carousel', 'symple' ),
		'base'        => 'symple_attachments_carousel',
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'description' => __( 'Custom image carousel', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-h',
		'params'      => array(
			array(
				'type'			=> 'attach_images',
				'admin_label'	=> true,
				'heading'		=> __( 'Attach Images', 'symple' ),
				'param_name'	=> 'image_ids',
				'description'	=> __( 'Attach images to your post.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Unique Id', 'symple' ),
				'param_name'	=> 'unique_id',
				'description'	=> __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' ) => 'DESC',
					 __( 'ASC', 'symple' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Item Width', 'symple' ),
				'param_name'	=> 'item_width',
				'value'			=> '400',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Min Slides', 'symple' ),
				'param_name'	=> 'min_slides',
				'value'			=> '1',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Max Slides', 'symple' ),
				'param_name'	=> 'max_slides',
				'value'			=> '3',
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Auto Play', 'symple' ),
				'param_name'	=> 'auto_play',
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Pager?', 'symple' ),
				'param_name'	=> 'pager',
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Arrows?', 'symple' ),
				'param_name'	=> 'arrows',
				'value'			=> array(
					 __( 'True', 'symple' )	=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Link', 'symple' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 __( 'None', 'symple' )     => 'none',
					 __( 'Lightbox', 'symple' ) => 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Crop', 'symple' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Width', 'symple' ),
				'param_name'	=> 'img_width',
				'description'	=> __( 'Enter a width in pixels.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Height', 'symple' ),
				'param_name'	=> 'img_height',
				'description'	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 __( 'True', 'symple' )   => 'true',
					 __( 'False', 'symple' ) => 'false',
				),
			),
		)
	) );


	// Attachments FlexSlider -------------------------------------------------------------------------- >
	vc_map( array(
		'name'			=> __( 'Image FlexSlider', 'symple' ),
		'base'			=> 'symple_attachments_flexslider',
		'description'	=> __( 'Custom image slider', 'symple' ),
		'category'		=> __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-arrows-h',
		'params'		=> array(
			array(
				'type'			=> 'attach_images',
				'admin_label'	=> true,
				'heading'		=> __( 'Attach Images', 'symple' ),
				'param_name'	=> 'image_ids',
				'description'	=> __( 'Attach images to your post.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Unique Id', 'symple' ),
				'param_name'	=> 'unique_id',
				'description'	=> __( 'You can enter a unique ID here for styling purposes.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Order', 'symple' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'symple' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 __( 'DESC', 'symple' )	=> 'DESC',
					 __( 'ASC', 'symple' )		=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Link', 'symple' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 __( 'None', 'symple' )		=> 'none',
					 __( 'Lightbox', 'symple' )	=> 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Thumbnail Crop', 'symple' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Width', 'symple' ),
				'param_name'	=> 'img_width',
				'description'	=> __( 'Enter a width in pixels.', 'symple' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Thumbnail Height', 'symple' ),
				'param_name'	=> 'img_height',
				'description'	=> __( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'symple' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Display Title', 'symple' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Animation', 'symple' ),
				'param_name'	=> 'animation',
				'value'			=> array(
					 __( 'Slide', 'symple' )	=> 'slide',
					 __( 'Fade', 'symple' )	=> 'fade',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Slideshow', 'symple' ),
				'param_name'	=> 'slideshow',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Randomize', 'symple' ),
				'param_name'	=> 'randomize',
				'value'			=> array(
					 __( 'False', 'symple' )	=> 'false',
					 __( 'True', 'symple' )		=> 'true',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Control Nav', 'symple' ),
				'param_name'	=> 'control_nav',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> __( 'Direction Nav', 'symple' ),
				'param_name'	=> 'direction_nav',
				'value'			=> array(
					 __( 'True', 'symple' )		=> 'true',
					 __( 'False', 'symple' )	=> 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Slideshow Speed', 'symple' ),
				'param_name'	=> 'slideshow_speed',
				'value'			=> '7000',
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> __( 'Animation Speed', 'symple' ),
				'param_name'	=> 'animation_speed',
				'value'			=> '600',
			),
		)
	) );


	// Icons -------------------------------------------------------------------------- >
	vc_map( array(
		'name'        => __( 'Icon', 'symple' ),
		'base'        => 'symple_icon',
		'description' => __( 'Font Awesome Icon', 'symple' ),
		'category'    => __( 'Symple Shortcodes', 'symple' ),
		'icon'        => 'ss-vc-icon fa fa-star',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Icon', 'symple' ),
				'param_name'  => 'icon',
				'admin_label' => true,
				'value'       => symple_shortcodes_font_icons_array(),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Icon Size', 'symple' ),
				'param_name' => 'size',
				'std'        => 'normal',
				'value'      => array(
					 __( 'Extra Large', 'symple' ) => 'xlarge',
					 __( 'Large', 'symple' )       => 'large',
					 __( 'Normal', 'symple' )      => 'normal',
					 __( 'Small', 'symple' )       => 'small',
					 __( 'Tiny', 'symple' )        => 'tiny',
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Fade In', 'symple' ),
				'param_name'  => 'fade_in',
				'value'       => array(
					 __( 'False', 'symple' ) => 'false',
					 __( 'True', 'symple' )  => 'true',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Float', 'symple' ),
				'param_name' => 'float',
				'value'      => array(
					 __( 'Center', 'symple' ) => 'center',
					 __( 'Left', 'symple' )   => 'left',
					 __( 'Right', 'symple' )  => 'right',
				),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Icon Color', 'symple' ),
				'param_name' => 'color',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Background Color', 'symple' ),
				'param_name' => 'background',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Border Radius', 'symple' ),
				'param_name' => 'border_radius',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'URL', 'symple' ),
				'param_name' => 'url',
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'URL Title', 'symple' ),
				'param_name' => 'url_title',
			),
		)
	) );
}
add_action( 'vc_before_init', 'symple_shortcodes_vc_map' );

function symple_shortcodes_vc_admin_css() {
	if ( class_exists( 'Vc_Manager' ) ) {
		wp_enqueue_style( 'symple-shortcodes-vc', plugin_dir_url( __FILE__ ) . 'css/symple-shortcodes-vc.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'symple_shortcodes_vc_admin_css' );