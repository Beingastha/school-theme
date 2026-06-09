<?php
/**
 * Excellence School Bhopal — Theme Functions
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

define( 'ESB_VERSION', '1.5.0' );
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
	wp_enqueue_style(
		'esb-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Hind:wght@400;500;600&display=swap',
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

	/* Inject Customizer colour tokens as CSS custom property overrides */
	$accent_palettes = [
		'gold'   => [ '#dcc068', '#c9a23a', '#b8901f' ],
		'bright' => [ '#e6cf8a', '#d4af37', '#a9821a' ],
		'copper' => [ '#d8b48a', '#c08a3e', '#9a6a28' ],
	];
	$surface_tones = [
		'ivory'      => '#f8f5ec',
		'warm_cream' => '#f5efe2',
		'soft_sand'  => '#f1ead9',
	];

	$accent_key  = get_theme_mod( 'esb_gold_accent', 'gold' );
	$surface_key = get_theme_mod( 'esb_surface_tone', 'ivory' );
	$accent      = $accent_palettes[ $accent_key ] ?? $accent_palettes['gold'];
	$ivory       = $surface_tones[ $surface_key ] ?? '#f8f5ec';

	wp_add_inline_style(
		'esb-design-system',
		sprintf(
			':root{--gold-400:%s;--gold-500:%s;--gold-600:%s;--gold-700:%s;--ivory:%s}',
			esc_attr( $accent[0] ),
			esc_attr( $accent[1] ),
			esc_attr( $accent[2] ),
			esc_attr( $accent[2] ),
			esc_attr( $ivory )
		)
	);

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

