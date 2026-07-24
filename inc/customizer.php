<?php
/**
 * Customizer Settings — Excellence School Bhopal
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', 'esb_customizer_register' );
function esb_customizer_register( WP_Customize_Manager $wp_customize ): void {

	/* =========================================================
	   Panel: School Settings
	   ========================================================= */
	$wp_customize->add_panel(
		'esb_school_panel',
		[
			'title'    => esc_html__( 'School Settings', 'excellence-school' ),
			'priority' => 30,
		]
	);

	/* ----- Section: Identity ----- */
	$wp_customize->add_section(
		'esb_identity',
		[
			'title'    => esc_html__( 'School Identity', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 10,
		]
	);

	$identity_fields = [
		'esb_school_name'       => [ esc_html__( 'Full Legal School Name', 'excellence-school' ), 'Govt. Subhash Excellence Higher Secondary School, Bhopal' ],
		'esb_school_short_name' => [ esc_html__( 'Short Name (shown in header)', 'excellence-school' ), 'Subhash Excellence School' ],
		'esb_school_subtitle'   => [ esc_html__( 'Header Tagline / Location', 'excellence-school' ), 'Govt. Higher Secondary · Bhopal' ],
		'esb_udise'             => [ esc_html__( 'UDISE Code', 'excellence-school' ),       '23320301711' ],
		'esb_estd'              => [ esc_html__( 'Established Year', 'excellence-school' ), '1965' ],
		'esb_affiliation'       => [ esc_html__( 'Affiliation', 'excellence-school' ),      'MP Board of Secondary Education' ],
	];

	foreach ( $identity_fields as $key => [ $label, $default ] ) {
		$wp_customize->add_setting( $key, [ 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( $key, [ 'label' => $label, 'section' => 'esb_identity', 'type' => 'text' ] );
	}

	/* Toggle: show/hide the tagline under the school name in the header */
	$wp_customize->add_setting( 'esb_header_show_tagline', [
		'default'           => '1',
		'sanitize_callback' => 'esb_sanitize_checkbox',
	] );
	$wp_customize->add_control( 'esb_header_show_tagline', [
		'label'       => esc_html__( 'Show tagline under school name in header', 'excellence-school' ),
		'description' => esc_html__( 'Uncheck to hide "Govt. Higher Secondary · Bhopal" from the header.', 'excellence-school' ),
		'section'     => 'esb_identity',
		'type'        => 'checkbox',
	] );

	/* ----- Section: Contact Info ----- */
	$wp_customize->add_section(
		'esb_contact',
		[
			'title'    => esc_html__( 'Contact Information', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 20,
		]
	);

	$contact_fields = [
		'esb_phone'         => [ esc_html__( 'Phone Number', 'excellence-school' ),  '+91 755-255-2490' ],
		'esb_email'         => [ esc_html__( 'Email Address', 'excellence-school' ), 'govt.hss.excellence.subhash@gmail.com' ],
		'esb_address'       => [ esc_html__( 'Street Address', 'excellence-school' ), 'Subhash Shivaji Nagar, Bhopal, Madhya Pradesh – 462016' ],
		'esb_address_hi'    => [ esc_html__( 'Street Address (Hindi)', 'excellence-school' ), 'सुभाष शिवाजी नगर, भोपाल, मध्य प्रदेश – 462016' ],
		'esb_hours'         => [ esc_html__( 'Office Hours (full — contact section)', 'excellence-school' ),  'Monday – Saturday · 8:00 AM – 4:00 PM' ],
		'esb_hours_hi'      => [ esc_html__( 'Office Hours — full (Hindi)', 'excellence-school' ), 'सोमवार – शनिवार · प्रातः 8 – सायं 4' ],
		'esb_hours_short'   => [ esc_html__( 'Office Hours — short, top bar (English)', 'excellence-school' ), 'Mon–Sat · 8 AM – 4 PM' ],
		'esb_hours_short_hi'=> [ esc_html__( 'Office Hours — short, top bar (Hindi)', 'excellence-school' ), 'सोम–शनि · प्रातः 8 – सायं 4' ],
	];

	foreach ( $contact_fields as $key => [ $label, $default ] ) {
		$wp_customize->add_setting( $key, [ 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ] );
		$wp_customize->add_control( $key, [ 'label' => $label, 'section' => 'esb_contact', 'type' => 'text' ] );
	}

	/* Google Maps embed URL */
	$wp_customize->add_setting( 'esb_maps_embed', [
		'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3666.22!2d77.4!3d23.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDE1JzAwLjAiTiA3N8KwMjQnMDAuMCJF!5e0!3m2!1sen!2sin!4v1',
		'sanitize_callback' => 'esc_url_raw',
	] );
	$wp_customize->add_control( 'esb_maps_embed', [
		'label'   => esc_html__( 'Google Maps Embed URL', 'excellence-school' ),
		'section' => 'esb_contact',
		'type'    => 'url',
	] );

	/* ----- Section: Social Media ----- */
	$wp_customize->add_section(
		'esb_social',
		[
			'title'    => esc_html__( 'Social Media Links', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 30,
		]
	);

	$social_fields = [
		'esb_facebook'  => [ esc_html__( 'Facebook URL', 'excellence-school' ),  'https://www.facebook.com/100064206661897' ],
		'esb_instagram' => [ esc_html__( 'Instagram URL', 'excellence-school' ), 'https://www.instagram.com/_subhashians_' ],
		'esb_linkedin'  => [ esc_html__( 'LinkedIn URL', 'excellence-school' ),  'https://in.linkedin.com/company/school-for-excellence-shivaji-nagar-bhopal' ],
		'esb_youtube'   => [ esc_html__( 'YouTube URL', 'excellence-school' ),   'https://www.youtube.com/watch?v=aMfvYKTnO50' ],
	];

	foreach ( $social_fields as $key => [ $label, $default ] ) {
		$wp_customize->add_setting( $key, [ 'default' => $default, 'sanitize_callback' => 'esc_url_raw' ] );
		$wp_customize->add_control( $key, [ 'label' => $label, 'section' => 'esb_social', 'type' => 'url' ] );
	}

	/* ----- Section: Stats ----- */
	$wp_customize->add_section(
		'esb_stats',
		[
			'title'    => esc_html__( 'Key Statistics', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 40,
		]
	);

	$stats = [
		'esb_stat_pass_rate' => [ esc_html__( 'Board Pass Rate (%)', 'excellence-school' ),  '98' ],
		'esb_stat_students'  => [ esc_html__( 'Students Enrolled', 'excellence-school' ),    '2000' ],
		'esb_stat_faculty'   => [ esc_html__( 'Expert Faculty', 'excellence-school' ),       '70' ],
		'esb_stat_awards'    => [ esc_html__( 'State & District Awards', 'excellence-school' ), '150' ],
	];

	foreach ( $stats as $key => [ $label, $default ] ) {
		$wp_customize->add_setting( $key, [ 'default' => $default, 'sanitize_callback' => 'absint' ] );
		$wp_customize->add_control( $key, [ 'label' => $label, 'section' => 'esb_stats', 'type' => 'number' ] );
	}

	/* ----- Section: Principal ----- */
	$wp_customize->add_section(
		'esb_principal',
		[
			'title'    => esc_html__( "Principal's Message", 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 50,
		]
	);

	$wp_customize->add_setting( 'esb_principal_name', [ 'default' => 'Mr. Sudhakar Parashar', 'sanitize_callback' => 'sanitize_text_field' ] );
	$wp_customize->add_control( 'esb_principal_name', [ 'label' => esc_html__( 'Principal Name', 'excellence-school' ), 'section' => 'esb_principal', 'type' => 'text' ] );

	$wp_customize->add_setting( 'esb_principal_name_hi', [ 'default' => 'श्री सुधाकर पाराशर', 'sanitize_callback' => 'sanitize_text_field' ] );
	$wp_customize->add_control( 'esb_principal_name_hi', [ 'label' => esc_html__( 'Principal Name (Hindi)', 'excellence-school' ), 'section' => 'esb_principal', 'type' => 'text' ] );

	$wp_customize->add_setting( 'esb_principal_role', [ 'default' => 'Principal, Govt. Subhash Excellence H.S. School, Bhopal', 'sanitize_callback' => 'sanitize_text_field' ] );
	$wp_customize->add_control( 'esb_principal_role', [ 'label' => esc_html__( 'Principal Role/Title', 'excellence-school' ), 'section' => 'esb_principal', 'type' => 'text' ] );

	$wp_customize->add_setting( 'esb_principal_role_hi', [ 'default' => 'प्राचार्य, शासकीय सुभाष उत्कृष्ट उ.मा. विद्यालय, भोपाल', 'sanitize_callback' => 'sanitize_text_field' ] );
	$wp_customize->add_control( 'esb_principal_role_hi', [ 'label' => esc_html__( 'Principal Role/Title (Hindi)', 'excellence-school' ), 'section' => 'esb_principal', 'type' => 'text' ] );

	$wp_customize->add_setting( 'esb_principal_quote', [
		'default'           => 'Our mission is simple — to ensure that every child who walks through our gates leaves with the knowledge, character and confidence to lead. Excellence here is not a privilege; it is a promise we keep to every family.',
		'sanitize_callback' => 'sanitize_textarea_field',
	] );
	$wp_customize->add_control( 'esb_principal_quote', [
		'label'   => esc_html__( "Principal's Quote", 'excellence-school' ),
		'section' => 'esb_principal',
		'type'    => 'textarea',
	] );

	$wp_customize->add_setting( 'esb_principal_quote_hi', [
		'default'           => 'हमारा उद्देश्य सरल है — हमारे द्वार से गुजरने वाला प्रत्येक बच्चा ज्ञान, चरित्र और नेतृत्व का आत्मविश्वास लेकर जाए। यहाँ उत्कृष्टता कोई विशेषाधिकार नहीं, बल्कि हर परिवार से किया गया वादा है।',
		'sanitize_callback' => 'sanitize_textarea_field',
	] );
	$wp_customize->add_control( 'esb_principal_quote_hi', [
		'label'   => esc_html__( "Principal's Quote (Hindi)", 'excellence-school' ),
		'section' => 'esb_principal',
		'type'    => 'textarea',
	] );

	/* Image upload for principal portrait */
	$wp_customize->add_setting( 'esb_principal_image', [ 'default' => '', 'sanitize_callback' => 'absint' ] );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'esb_principal_image',
			[
				'label'     => esc_html__( 'Principal Portrait Image', 'excellence-school' ),
				'section'   => 'esb_principal',
				'mime_type' => 'image',
			]
		)
	);

	/* ----- Section: Appearance / Tweaks ----- */
	$wp_customize->add_section(
		'esb_hero',
		[
			'title'    => esc_html__( 'Appearance & Hero', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 5,
		]
	);

	/* Hero layout */
	$wp_customize->add_setting( 'esb_hero_variant', [ 'default' => '1', 'sanitize_callback' => 'esb_sanitize_hero_variant' ] );
	$wp_customize->add_control( 'esb_hero_variant', [
		'label'   => esc_html__( 'Hero Layout', 'excellence-school' ),
		'section' => 'esb_hero',
		'type'    => 'radio',
		'choices' => [
			'1' => esc_html__( 'Stately — full-bleed photo', 'excellence-school' ),
			'2' => esc_html__( 'Split — text left, image right', 'excellence-school' ),
			'3' => esc_html__( 'Crest — centred crest & stats', 'excellence-school' ),
		],
	] );

	/* Hero eyebrow text (above the main headline) */
	$wp_customize->add_setting( 'esb_hero_eyebrow', [
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	] );
	$wp_customize->add_control( 'esb_hero_eyebrow', [
		'label'       => esc_html__( 'Hero Eyebrow Text', 'excellence-school' ),
		'description' => esc_html__( 'Small label above the hero headline. Leave blank to auto-generate from "Estd. [year] · [Short Name]".', 'excellence-school' ),
		'section'     => 'esb_hero',
		'type'        => 'text',
	] );

	/* Hero background image */
	$wp_customize->add_setting( 'esb_hero_image', [ 'default' => '', 'sanitize_callback' => 'absint' ] );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'esb_hero_image',
			[
				'label'       => esc_html__( 'Hero Background / Campus Image', 'excellence-school' ),
				'description' => esc_html__( 'Used in Stately as full-bleed background, and Split as the side image.', 'excellence-school' ),
				'section'     => 'esb_hero',
				'mime_type'   => 'image',
			]
		)
	);

	/* About Page Heritage Image */
	$wp_customize->add_setting( 'esb_about_heritage_image', [ 'default' => '', 'sanitize_callback' => 'absint' ] );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'esb_about_heritage_image',
			[
				'label'       => esc_html__( 'About Page Heritage Image', 'excellence-school' ),
				'description' => esc_html__( 'Image shown in the Our Story section of the About page.', 'excellence-school' ),
				'section'     => 'esb_hero',
				'mime_type'   => 'image',
			]
		)
	);

	/* Admissions Page Desk Image */
	$wp_customize->add_setting( 'esb_admissions_desk_image', [ 'default' => '', 'sanitize_callback' => 'absint' ] );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'esb_admissions_desk_image',
			[
				'label'       => esc_html__( 'Admissions Desk Image', 'excellence-school' ),
				'description' => esc_html__( 'Image shown in the sidebar of the Admissions page.', 'excellence-school' ),
				'section'     => 'esb_hero',
				'mime_type'   => 'image',
			]
		)
	);

	/* ---- Theme Colour Palette ---- */
	$wp_customize->add_setting( 'esb_theme_palette', [
		'default'           => 'forest_gold',
		'sanitize_callback' => 'esb_sanitize_theme_palette',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control(
		new ESB_Palette_Control(
			$wp_customize,
			'esb_theme_palette',
			[
				'label'       => esc_html__( 'Colour Palette', 'excellence-school' ),
				'description' => esc_html__( 'Pick a colour palette — applies across the entire site (header, buttons, headings, footer).', 'excellence-school' ),
				'section'     => 'esb_hero',
				'choices'     => [
					'forest_gold'     => [
						'label'    => esc_html__( 'Forest & Gold', 'excellence-school' ),
						'desc'     => esc_html__( 'Deep green + warm gold (default)', 'excellence-school' ),
						'swatches' => [ '#07321f', '#11603c', '#c9a23a', '#dcc068', '#f8f5ec' ],
					],
					'royal_navy'      => [
						'label'    => esc_html__( 'Royal Navy & Gold', 'excellence-school' ),
						'desc'     => esc_html__( 'Dark navy + classic gold', 'excellence-school' ),
						'swatches' => [ '#0d1b2a', '#1e3a58', '#c9a23a', '#dcc068', '#f3f6fb' ],
					],
					'maroon_copper'   => [
						'label'    => esc_html__( 'Maroon & Copper', 'excellence-school' ),
						'desc'     => esc_html__( 'Deep burgundy + warm bronze', 'excellence-school' ),
						'swatches' => [ '#2e0a0a', '#7c2020', '#bf8a50', '#d4a870', '#fdf6f0' ],
					],
					'midnight_indigo' => [
						'label'    => esc_html__( 'Midnight Indigo & Gold', 'excellence-school' ),
						'desc'     => esc_html__( 'Deep indigo + classic gold', 'excellence-school' ),
						'swatches' => [ '#16103c', '#2e2480', '#c9a23a', '#dcc068', '#f5f4ff' ],
					],
					'slate_teal'      => [
						'label'    => esc_html__( 'Slate & Teal', 'excellence-school' ),
						'desc'     => esc_html__( 'Dark slate + fresh teal accent', 'excellence-school' ),
						'swatches' => [ '#1a2330', '#2d3d52', '#12a0a0', '#2ebcbc', '#f0f8f8' ],
					],
				],
			]
		)
	);

	/* ---- Font Pairing ---- */
	$wp_customize->add_setting( 'esb_font_pairing', [
		'default'           => 'classic',
		'sanitize_callback' => 'esb_sanitize_font_pairing',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control(
		new ESB_Font_Control(
			$wp_customize,
			'esb_font_pairing',
			[
				'label'       => esc_html__( 'Font Pairing', 'excellence-school' ),
				'description' => esc_html__( 'Heading + body typeface combination, applied site-wide. Changes take effect on save.', 'excellence-school' ),
				'section'     => 'esb_hero',
				'choices'     => [
					'classic'      => [
						'label'       => esc_html__( 'Classic Prestige (default)', 'excellence-school' ),
						'display'     => '"Playfair Display", Georgia, serif',
						'body'        => '"Plus Jakarta Sans", system-ui, sans-serif',
						'sample'      => esc_html__( 'Excellence Awaits', 'excellence-school' ),
						'body_sample' => esc_html__( 'Playfair Display + Plus Jakarta Sans', 'excellence-school' ),
					],
					'modern'       => [
						'label'       => esc_html__( 'Modern Serif', 'excellence-school' ),
						'display'     => '"DM Serif Display", Georgia, serif',
						'body'        => '"DM Sans", system-ui, sans-serif',
						'sample'      => esc_html__( 'Excellence Awaits', 'excellence-school' ),
						'body_sample' => esc_html__( 'DM Serif Display + DM Sans', 'excellence-school' ),
					],
					'elegant'      => [
						'label'       => esc_html__( 'Elegant Scholar', 'excellence-school' ),
						'display'     => '"Cormorant Garamond", Georgia, serif',
						'body'        => '"Lato", system-ui, sans-serif',
						'sample'      => esc_html__( 'Excellence Awaits', 'excellence-school' ),
						'body_sample' => esc_html__( 'Cormorant Garamond + Lato', 'excellence-school' ),
					],
					'academic'     => [
						'label'       => esc_html__( 'Academic', 'excellence-school' ),
						'display'     => '"EB Garamond", Georgia, serif',
						'body'        => '"Source Sans 3", system-ui, sans-serif',
						'sample'      => esc_html__( 'Excellence Awaits', 'excellence-school' ),
						'body_sample' => esc_html__( 'EB Garamond + Source Sans 3', 'excellence-school' ),
					],
					'contemporary' => [
						'label'       => esc_html__( 'Contemporary', 'excellence-school' ),
						'display'     => '"Fraunces", Georgia, serif',
						'body'        => '"Nunito", system-ui, sans-serif',
						'sample'      => esc_html__( 'Excellence Awaits', 'excellence-school' ),
						'body_sample' => esc_html__( 'Fraunces + Nunito', 'excellence-school' ),
					],
				],
			]
		)
	);

	/* ----- Section: Board Results ----- */
	$wp_customize->add_section(
		'esb_results_section',
		[
			'title'    => esc_html__( 'Board Results', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 45,
		]
	);

	// Description Text (EN and HI)
	$wp_customize->add_setting( 'esb_results_desc_en', [
		'default'           => 'Our Class XII Science cohort recorded a 99% pass rate in 2025, with multiple students placing in the district merit list. Dedicated remedial sessions and competitive-exam coaching ensure no learner is left behind.',
		'sanitize_callback' => 'sanitize_textarea_field',
	] );
	$wp_customize->add_control( 'esb_results_desc_en', [
		'label'   => esc_html__( 'Results Paragraph (English)', 'excellence-school' ),
		'section' => 'esb_results_section',
		'type'    => 'textarea',
	] );

	$wp_customize->add_setting( 'esb_results_desc_hi', [
		'default'           => 'हमारे कक्षा 12 विज्ञान समूह ने 2025 में 99% उत्तीर्ण दर दर्ज की, जिसमें कई विद्यार्थी जिला मेरिट सूची में रहे। समर्पित उपचारात्मक सत्र और प्रतियोगी कोचिंग सुनिश्चित करती है कि कोई पीछे न छूटे।',
		'sanitize_callback' => 'sanitize_textarea_field',
	] );
	$wp_customize->add_control( 'esb_results_desc_hi', [
		'label'   => esc_html__( 'Results Paragraph (Hindi)', 'excellence-school' ),
		'section' => 'esb_results_section',
		'type'    => 'textarea',
	] );

	// Results Bars (4 items)
	$results_defaults = [
		1 => [ 'name_en' => 'Class XII · Science',    'name_hi' => 'कक्षा 12 · विज्ञान',  'pct' => 99 ],
		2 => [ 'name_en' => 'Class XII · Commerce',   'name_hi' => 'कक्षा 12 · वाणिज्य', 'pct' => 98 ],
		3 => [ 'name_en' => 'Class XII · Humanities', 'name_hi' => 'कक्षा 12 · मानविकी', 'pct' => 97 ],
		4 => [ 'name_en' => 'Class X · All Streams',  'name_hi' => 'कक्षा 10 · सभी',      'pct' => 96 ],
	];

	foreach ( $results_defaults as $i => $defaults ) {
		// Bar Name EN
		$wp_customize->add_setting( "esb_result_{$i}_name_en", [ 'default' => $defaults['name_en'], 'sanitize_callback' => 'sanitize_text_field' ] );
		$wp_customize->add_control( "esb_result_{$i}_name_en", [ 'label' => sprintf( esc_html__( 'Bar %d Name (English)', 'excellence-school' ), $i ), 'section' => 'esb_results_section', 'type' => 'text' ] );

		// Bar Name HI
		$wp_customize->add_setting( "esb_result_{$i}_name_hi", [ 'default' => $defaults['name_hi'], 'sanitize_callback' => 'sanitize_text_field' ] );
		$wp_customize->add_control( "esb_result_{$i}_name_hi", [ 'label' => sprintf( esc_html__( 'Bar %d Name (Hindi)', 'excellence-school' ), $i ), 'section' => 'esb_results_section', 'type' => 'text' ] );

		// Bar Percentage
		$wp_customize->add_setting( "esb_result_{$i}_pct", [ 'default' => $defaults['pct'], 'sanitize_callback' => 'absint' ] );
		$wp_customize->add_control( "esb_result_{$i}_pct", [ 'label' => sprintf( esc_html__( 'Bar %d Percentage (0-100)', 'excellence-school' ), $i ), 'section' => 'esb_results_section', 'type' => 'number', 'input_attrs' => [ 'min' => 0, 'max' => 100 ] ] );
	}

	/* ----- Section: Student Life Mosaic ----- */
	$wp_customize->add_section(
		'esb_student_life_section',
		[
			'title'    => esc_html__( 'Student Life Mosaic', 'excellence-school' ),
			'panel'    => 'esb_school_panel',
			'priority' => 48,
		]
	);

	// Student Life default captions
	$life_defaults = [
		1 => [ 'en' => 'Annual Day',   'hi' => 'वार्षिकोत्सव' ],
		2 => [ 'en' => 'NCC',          'hi' => 'एनसीसी' ],
		3 => [ 'en' => 'Debate',       'hi' => 'वाद-विवाद' ],
		4 => [ 'en' => 'Science Fair', 'hi' => 'विज्ञान मेला' ],
		5 => [ 'en' => 'Cultural',     'hi' => 'सांस्कृतिक' ],
		6 => [ 'en' => 'Sports Meet',  'hi' => 'खेलकूद' ],
	];

	foreach ( $life_defaults as $i => $defaults ) {
		// Image Upload
		$wp_customize->add_setting( "esb_student_life_img_{$i}", [ 'default' => '', 'sanitize_callback' => 'absint' ] );
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				"esb_student_life_img_{$i}",
				[
					'label'     => sprintf( esc_html__( 'Tile %d Image', 'excellence-school' ), $i ),
					'section'   => 'esb_student_life_section',
					'mime_type' => 'image',
				]
			)
		);

		// English Caption
		$wp_customize->add_setting( "esb_student_life_lbl_{$i}_en", [ 'default' => $defaults['en'], 'sanitize_callback' => 'sanitize_text_field' ] );
		$wp_customize->add_control( "esb_student_life_lbl_{$i}_en", [ 'label' => sprintf( esc_html__( 'Tile %d Caption (English)', 'excellence-school' ), $i ), 'section' => 'esb_student_life_section', 'type' => 'text' ] );

		// Hindi Caption
		$wp_customize->add_setting( "esb_student_life_lbl_{$i}_hi", [ 'default' => $defaults['hi'], 'sanitize_callback' => 'sanitize_text_field' ] );
		$wp_customize->add_control( "esb_student_life_lbl_{$i}_hi", [ 'label' => sprintf( esc_html__( 'Tile %d Caption (Hindi)', 'excellence-school' ), $i ), 'section' => 'esb_student_life_section', 'type' => 'text' ] );
	}
}

function esb_sanitize_hero_variant( string $input ): string {
	return in_array( $input, [ '1', '2', '3' ], true ) ? $input : '1';
}

function esb_sanitize_checkbox( $input ): string {
	return $input ? '1' : '';
}

function esb_sanitize_theme_palette( string $input ): string {
	$valid = [ 'forest_gold', 'royal_navy', 'maroon_copper', 'midnight_indigo', 'slate_teal' ];
	return in_array( $input, $valid, true ) ? $input : 'forest_gold';
}

function esb_sanitize_font_pairing( string $input ): string {
	$valid = [ 'classic', 'modern', 'elegant', 'academic', 'contemporary' ];
	return in_array( $input, $valid, true ) ? $input : 'classic';
}
