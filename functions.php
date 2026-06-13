<?php
/**
 * Excellence School Bhopal — Theme Functions
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

define( 'ESB_VERSION', '2.4.11' );
define( 'ESB_DIR', get_template_directory() );
define( 'ESB_URI', get_template_directory_uri() );

/* =========================================================================
   Theme Setup
   ========================================================================= */
add_action( 'after_setup_theme', 'esb_setup' );
function esb_setup(): void {
	load_theme_textdomain( 'excellence-school', ESB_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );

	register_nav_menus( [
		'primary' => esc_html__( 'Primary Menu', 'excellence-school' ),
		'drawer'  => esc_html__( 'Mobile Drawer Menu', 'excellence-school' ),
		'footer'  => esc_html__( 'Footer Quick Links', 'excellence-school' ),
	] );
}

/* =========================================================================
   Enqueue Assets
   ========================================================================= */
add_action( 'wp_enqueue_scripts', 'esb_enqueue_assets' );
function esb_enqueue_assets(): void {
	/* ── Font pairings ──────────────────────────────────────────── */
	$esb_font_pairings = [
		'classic' => [
			'google'  => 'Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Hind:wght@400;500;600',
			'display' => '"Playfair Display", Georgia, serif',
			'body'    => '"Plus Jakarta Sans", "Hind", system-ui, -apple-system, sans-serif',
		],
		'modern' => [
			'google'  => 'DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700',
			'display' => '"DM Serif Display", Georgia, serif',
			'body'    => '"DM Sans", system-ui, -apple-system, sans-serif',
		],
		'elegant' => [
			'google'  => 'Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Lato:wght@400;700',
			'display' => '"Cormorant Garamond", Georgia, serif',
			'body'    => '"Lato", system-ui, -apple-system, sans-serif',
		],
		'academic' => [
			'google'  => 'EB+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Source+Sans+3:wght@400;600;700',
			'display' => '"EB Garamond", Georgia, serif',
			'body'    => '"Source Sans 3", system-ui, -apple-system, sans-serif',
		],
		'contemporary' => [
			'google'  => 'Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=Nunito:wght@400;500;600;700',
			'display' => '"Fraunces", Georgia, serif',
			'body'    => '"Nunito", system-ui, -apple-system, sans-serif',
		],
	];

	$font_key   = get_theme_mod( 'esb_font_pairing', 'classic' );
	$font_pair  = $esb_font_pairings[ $font_key ] ?? $esb_font_pairings['classic'];

	wp_enqueue_style(
		'esb-fonts',
		'https://fonts.googleapis.com/css2?family=' . $font_pair['google'] . '&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'esb-design-system',
		ESB_URI . '/assets/css/design-system.css',
		[ 'esb-fonts' ],
		ESB_VERSION
	);

	wp_enqueue_style(
		'esb-homepage',
		ESB_URI . '/assets/css/homepage.css',
		[ 'esb-design-system' ],
		ESB_VERSION
	);

	wp_enqueue_style(
		'esb-pages',
		ESB_URI . '/assets/css/pages.css',
		[ 'esb-design-system' ],
		ESB_VERSION
	);

	wp_enqueue_style(
		'esb-animations',
		ESB_URI . '/assets/css/animations.css',
		[ 'esb-design-system' ],
		ESB_VERSION
	);

	wp_enqueue_script(
		'esb-site',
		ESB_URI . '/assets/js/site.js',
		[],
		ESB_VERSION,
		true
	);

	/* ── Theme colour palettes ──────────────────────────────────── */
	$esb_theme_palettes = [
		'forest_gold' => [
			'--green-900' => '#07321f', '--green-800' => '#0b4429',
			'--green-700' => '#11603c', '--green-600' => '#19764c', '--green-500' => '#2a8a5e',
			'--gold-700'  => '#a37d1b', '--gold-600'  => '#b8901f',
			'--gold-500'  => '#c9a23a', '--gold-400'  => '#dcc068', '--gold-300'  => '#ecd9a0',
			'--ivory'     => '#f8f5ec', '--cream'     => '#fcfaf4',
			'--ink'       => '#16201a', '--muted'     => '#5c6b60',
		],
		'royal_navy' => [
			'--green-900' => '#0d1b2a', '--green-800' => '#152236',
			'--green-700' => '#1e3a58', '--green-600' => '#255070', '--green-500' => '#2e6892',
			'--gold-700'  => '#a37d1b', '--gold-600'  => '#b8901f',
			'--gold-500'  => '#c9a23a', '--gold-400'  => '#dcc068', '--gold-300'  => '#ecd9a0',
			'--ivory'     => '#f3f6fb', '--cream'     => '#e8eef7',
			'--ink'       => '#0d1b2a', '--muted'     => '#4a607a',
		],
		'maroon_copper' => [
			'--green-900' => '#2e0a0a', '--green-800' => '#4a1212',
			'--green-700' => '#7c2020', '--green-600' => '#9e2e2e', '--green-500' => '#b84040',
			'--gold-700'  => '#8b5e2a', '--gold-600'  => '#a47240',
			'--gold-500'  => '#bf8a50', '--gold-400'  => '#d4a870', '--gold-300'  => '#e8c99a',
			'--ivory'     => '#fdf6f0', '--cream'     => '#f9ece0',
			'--ink'       => '#2e0a0a', '--muted'     => '#7a5050',
		],
		'midnight_indigo' => [
			'--green-900' => '#16103c', '--green-800' => '#201858',
			'--green-700' => '#2e2480', '--green-600' => '#3c3098', '--green-500' => '#4c3eb0',
			'--gold-700'  => '#a37d1b', '--gold-600'  => '#b8901f',
			'--gold-500'  => '#c9a23a', '--gold-400'  => '#dcc068', '--gold-300'  => '#ecd9a0',
			'--ivory'     => '#f5f4ff', '--cream'     => '#eeebff',
			'--ink'       => '#16103c', '--muted'     => '#5e5680',
		],
		'slate_teal' => [
			'--green-900' => '#1a2330', '--green-800' => '#232f3e',
			'--green-700' => '#2d3d52', '--green-600' => '#384d66', '--green-500' => '#43627e',
			'--gold-700'  => '#0c7070', '--gold-600'  => '#0e8888',
			'--gold-500'  => '#12a0a0', '--gold-400'  => '#2ebcbc', '--gold-300'  => '#6ed6d6',
			'--ivory'     => '#f0f8f8', '--cream'     => '#e4f3f3',
			'--ink'       => '#1a2330', '--muted'     => '#4a5e70',
		],
	];

	$palette_key = get_theme_mod( 'esb_theme_palette', 'forest_gold' );
	$palette     = $esb_theme_palettes[ $palette_key ] ?? $esb_theme_palettes['forest_gold'];

	/* Build :root { } block — palette vars + font vars */
	$css_vars  = ':root{';
	foreach ( $palette as $var => $val ) {
		$css_vars .= $var . ':' . esc_attr( $val ) . ';';
	}
	$css_vars .= '--ff-display:' . esc_attr( $font_pair['display'] ) . ';';
	$css_vars .= '--ff-body:'    . esc_attr( $font_pair['body'] )    . ';';
	$css_vars .= '}';

	wp_add_inline_style( 'esb-design-system', $css_vars );

	$hero_variant = get_theme_mod( 'esb_hero_variant', '1' );
	wp_add_inline_script(
		'esb-site',
		'document.body.setAttribute("data-hero","' . esc_js( $hero_variant ) . '");',
		'before'
	);
}

/* =========================================================================
   Custom Post Types
   ========================================================================= */
require_once ESB_DIR . '/inc/custom-post-types.php';

/* =========================================================================
   Customizer
   ========================================================================= */
require_once ESB_DIR . '/inc/customizer-controls.php';
require_once ESB_DIR . '/inc/customizer.php';

/* =========================================================================
   Page Content Admin Options
   ========================================================================= */
require_once ESB_DIR . '/inc/page-content.php';

/* =========================================================================
   Template Tags / Helpers
   ========================================================================= */

/**
 * Output bilingual text span.
 *
 * @param string $en English text.
 * @param string $hi Hindi text.
 * @param string $tag HTML tag.
 * @param string $class Additional classes.
 */
function esb_bilingual( string $en, string $hi, string $tag = 'span', string $class = '' ): void {
	$class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	printf(
		'<%1$s%2$s data-en="%3$s" data-hi="%4$s">%3$s</%1$s>',
		tag_escape( $tag ),
		$class_attr, // already escaped above
		esc_html( $en ),
		esc_html( $hi )
	);
}

/**
 * Render the school logo img tag.
 */
function esb_logo(): void {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
	} else {
		$logo_url = ESB_URI . '/assets/images/logo.webp';
	}
	echo '<img class="crest" src="' . esc_url( $logo_url ) . '" alt="' . esc_attr__( 'School for Excellence Bhopal crest', 'excellence-school' ) . '" width="54" height="54" />';
}

/**
 * Get theme mod with a fallback.
 *
 * @param string $key     Customizer setting key.
 * @param string $default Fallback value.
 * @return string
 */
function esb_opt( string $key, string $default = '' ): string {
	return (string) get_theme_mod( $key, $default );
}

/**
 * Outputs the topbar dots separator.
 */
function esb_dot(): void {
	echo '<span class="dot"></span>';
}

/**
 * Get the WP home URL for a given slug (page permalink by slug).
 */
function esb_page_url( string $slug ): string {
	$page = get_page_by_path( $slug );
	return $page ? esc_url( get_permalink( $page->ID ) ) : esc_url( home_url( '/' ) );
}

/**
 * Render image or placeholder div for a post thumbnail.
 *
 * @param int    $post_id Post ID.
 * @param string $size    Image size.
 * @param string $label   Placeholder label.
 * @param string $class   Additional CSS class on the wrapper.
 * @param bool   $dark    Use dark placeholder.
 */
function esb_thumb( int $post_id, string $size = 'large', string $label = '', string $class = '', bool $dark = false ): void {
	if ( has_post_thumbnail( $post_id ) ) {
		echo '<div class="card-thumb' . ( $class ? ' ' . esc_attr( $class ) : '' ) . '">';
		echo get_the_post_thumbnail( $post_id, $size, [ 'alt' => esc_attr( get_the_title( $post_id ) ) ] );
		echo '</div>';
	} else {
		$ph_class = 'ph' . ( $dark ? ' dark' : '' ) . ( $class ? ' ' . $class : '' );
		echo '<div class="' . esc_attr( $ph_class ) . '" data-label="' . esc_attr( $label ) . '"></div>';
	}
}

/**
 * Admissions enquiry form nonce verification and email handler.
 */
add_action( 'init', 'esb_handle_enquiry_form' );
function esb_handle_enquiry_form(): void {
	if ( ! isset( $_POST['esb_enquiry_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_enquiry_nonce'] ) ), 'esb_enquiry_submit' ) ) {
		wp_die( esc_html__( 'Security check failed. Please go back and try again.', 'excellence-school' ) );
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['enquiry_name'] ?? '' ) );
	$student = sanitize_text_field( wp_unslash( $_POST['enquiry_student'] ?? '' ) );
	$class   = sanitize_text_field( wp_unslash( $_POST['enquiry_class'] ?? '' ) );
	$stream  = sanitize_text_field( wp_unslash( $_POST['enquiry_stream'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['enquiry_phone'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['enquiry_email'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['enquiry_message'] ?? '' ) );

	$to      = esb_opt( 'esb_email', 'govt.hss.excellence.subhash@gmail.com' );
	$subject = sprintf( 'Admission Enquiry from %s', $name );
	$body    = sprintf(
		"Name: %s\nStudent Name: %s\nApplying for Class: %s\nStream: %s\nPhone: %s\nEmail: %s\n\nMessage:\n%s",
		$name, $student, $class, $stream, $phone, $email, $message
	);

	wp_mail( $to, $subject, $body );

	wp_safe_redirect( add_query_arg( 'enquiry', 'sent', wp_get_referer() ) );
	exit;
}

/**
 * Retrieve image URL by filename search.
 */
function esb_get_image_url_by_filename( string $filename, string $size = 'large' ): string {
	global $wpdb;
	$name = pathinfo( $filename, PATHINFO_FILENAME );
	$query = $wpdb->prepare(
		"SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_name = %s LIMIT 1",
		$name
	);
	$id = $wpdb->get_var( $query );
	if ( $id ) {
		return wp_get_attachment_image_url( (int) $id, $size );
	}
	return '';
}

