<?php
/**
 * Excellence School Bhopal — Theme Functions
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

define( 'ESB_VERSION', '2.4.19' );
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
   Widget Areas
   ========================================================================= */
add_action( 'widgets_init', 'esb_register_sidebars' );
function esb_register_sidebars(): void {
	$column_widget_args = [
		'before_widget' => '<div class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	];

	$columns = [
		'footer-col-1' => esc_html__( 'Footer Column 1', 'excellence-school' ),
		'footer-col-2' => esc_html__( 'Footer Column 2', 'excellence-school' ),
		'footer-col-3' => esc_html__( 'Footer Column 3', 'excellence-school' ),
		'footer-col-4' => esc_html__( 'Footer Column 4', 'excellence-school' ),
	];
	foreach ( $columns as $id => $name ) {
		register_sidebar(
			array_merge(
				$column_widget_args,
				[
					'name'        => $name,
					'id'          => $id,
					'description' => esc_html__( 'One of the four footer columns. Add, remove or reorder widgets here — Appearance → Widgets. Each column falls back to its original default content until you add a widget.', 'excellence-school' ),
				]
			)
		);
	}

	register_sidebar(
		array_merge(
			$column_widget_args,
			[
				'name'        => esc_html__( 'Footer Widgets', 'excellence-school' ),
				'id'          => 'footer-widgets',
				'description' => esc_html__( 'Shown as a full-width row in the site footer, above the copyright line. Add a Calendar, Text, or any plugin widget (e.g. an events calendar) here — Appearance → Widgets.', 'excellence-school' ),
			]
		)
	);
}

/* =========================================================================
   Footer Widgets — Brand & Contact
   ========================================================================= */
add_action( 'widgets_init', 'esb_register_footer_widgets' );
function esb_register_footer_widgets(): void {
	register_widget( 'ESB_Footer_Brand_Widget' );
	register_widget( 'ESB_Footer_Contact_Widget' );
	register_widget( 'ESB_Events_Calendar_Widget' );
}

/**
 * Renders the school logo, name, description and social links using the
 * live Customizer values, so this stays in sync with School Settings even
 * though it's placed as a movable/removable widget.
 */
class ESB_Footer_Brand_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'esb_footer_brand',
			esc_html__( 'ESB: School Brand', 'excellence-school' ),
			[ 'description' => esc_html__( 'Logo, school name, description and social links — pulled from Appearance → Customize → School Settings.', 'excellence-school' ) ]
		);
	}

	public function widget( $args, $instance ): void {
		$school_name = esb_opt( 'esb_school_name', 'School for Excellence' );
		$subtitle    = esb_opt( 'esb_school_subtitle', 'Subhash Nagar · Bhopal' );
		$facebook    = esb_opt( 'esb_facebook', '' );
		$instagram   = esb_opt( 'esb_instagram', '' );
		$linkedin    = esb_opt( 'esb_linkedin', '' );
		$youtube     = esb_opt( 'esb_youtube', '' );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<div class="fbrand">
			<?php esb_logo(); ?>
			<div>
				<div class="n1" data-en="<?php echo esc_attr( $school_name ); ?>" data-hi="उत्कृष्टता विद्यालय">
					<?php echo esc_html( $school_name ); ?>
				</div>
				<div class="n2" data-en="<?php echo esc_attr( $subtitle ); ?>" data-hi="सुभाष नगर · भोपाल">
					<?php echo esc_html( $subtitle ); ?>
				</div>
			</div>
		</div>
		<p class="fdesc" data-en="A Government School of Excellence under the Department of School Education, Government of Madhya Pradesh — committed to nurturing tomorrow's leaders through quality education and holistic development."
		   data-hi="स्कूल शिक्षा विभाग, मध्य प्रदेश शासन के अंतर्गत एक शासकीय उत्कृष्टता विद्यालय — गुणवत्तापूर्ण शिक्षा व समग्र विकास के माध्यम से कल के नेताओं को तैयार करने हेतु प्रतिबद्ध।">
			<?php esc_html_e( 'A Government School of Excellence under the Department of School Education, Government of Madhya Pradesh — committed to nurturing tomorrow\'s leaders through quality education and holistic development.', 'excellence-school' ); ?>
		</p>
		<div class="socials">
			<?php if ( $facebook ) : ?>
			<a class="social" href="<?php echo esc_url( $facebook ); ?>" aria-label="Facebook" rel="noopener noreferrer" target="_blank">f</a>
			<?php endif; ?>
			<?php if ( $instagram ) : ?>
			<a class="social" href="<?php echo esc_url( $instagram ); ?>" aria-label="Instagram" rel="noopener noreferrer" target="_blank">ig</a>
			<?php endif; ?>
			<?php if ( $linkedin ) : ?>
			<a class="social" href="<?php echo esc_url( $linkedin ); ?>" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">in</a>
			<?php endif; ?>
			<?php if ( $youtube ) : ?>
			<a class="social" href="<?php echo esc_url( $youtube ); ?>" aria-label="YouTube" rel="noopener noreferrer" target="_blank">yt</a>
			<?php endif; ?>
		</div>
		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ): void {
		echo '<p>' . esc_html__( 'No settings here — content is pulled live from Appearance → Customize → School Settings.', 'excellence-school' ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Renders address, phone, email and UDISE code using the live Customizer
 * values, so this stays in sync with School Settings even though it's
 * placed as a movable/removable widget.
 */
class ESB_Footer_Contact_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'esb_footer_contact',
			esc_html__( 'ESB: School Contact', 'excellence-school' ),
			[ 'description' => esc_html__( 'Address, phone, email and UDISE code — pulled from Appearance → Customize → School Settings.', 'excellence-school' ) ]
		);
	}

	public function widget( $args, $instance ): void {
		$address = esb_opt( 'esb_address', 'Subhash Shivaji Nagar, Bhopal, MP – 462016' );
		$phone   = esb_opt( 'esb_phone', '+91 755-255-2490' );
		$email   = esb_opt( 'esb_email', 'govt.hss.excellence.subhash@gmail.com' );
		$udise   = esb_opt( 'esb_udise', '23320301711' );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['before_title'] . esc_html__( 'Contact', 'excellence-school' ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<ul>
			<li data-en="<?php echo esc_attr( $address ); ?>">
				<?php echo esc_html( $address ); ?>
			</li>
			<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
			<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
			<li data-en="UDISE Code: <?php echo esc_attr( $udise ); ?>" data-hi="यूडाइस कोड: <?php echo esc_attr( $udise ); ?>">
				<?php echo esc_html( 'UDISE Code: ' . $udise ); ?>
			</li>
		</ul>
		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ): void {
		echo '<p>' . esc_html__( 'No settings here — content is pulled live from Appearance → Customize → School Settings.', 'excellence-school' ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Compact month-grid calendar of upcoming events for the footer.
 *
 * Renders a mini month grid (Mon-first) from The Events Calendar's events.
 * Days that have events are highlighted and link to that day's event list.
 * Prev/Next navigate months in place via the `esb_cal` query var (no JS),
 * jumping back to the calendar via the #esb-events-cal anchor. A
 * "View full calendar" link points to the main /events/ page.
 */
class ESB_Events_Calendar_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'esb_events_calendar',
			esc_html__( 'ESB: Events Mini Calendar', 'excellence-school' ),
			[ 'description' => esc_html__( 'Month-grid calendar of upcoming events (from The Events Calendar), with prev/next month navigation.', 'excellence-school' ) ]
		);
	}

	public function widget( $args, $instance ): void {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( ! function_exists( 'tribe_get_events' ) ) {
			echo '<p>' . esc_html__( 'Events calendar is unavailable.', 'excellence-school' ) . '</p>';
			echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}

		// Target month: ?esb_cal=YYYY-MM, else current month. Clamp to a real date.
		$req   = isset( $_GET['esb_cal'] ) ? sanitize_text_field( wp_unslash( $_GET['esb_cal'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$month = preg_match( '/^\d{4}-\d{2}$/', $req ) ? $req : current_time( 'Y-m' );
		$first = DateTime::createFromFormat( 'Y-m-d', $month . '-01' );
		if ( ! $first ) {
			$first = new DateTime( current_time( 'Y-m' ) . '-01' );
		}
		$first->setTime( 0, 0, 0 );

		$year        = (int) $first->format( 'Y' );
		$month_num   = (int) $first->format( 'm' );
		$days_in_mon = (int) $first->format( 't' );
		$lead_blanks = ( (int) $first->format( 'N' ) ) - 1; // Mon-first: Mon=0 … Sun=6.
		$month_start = $first->format( 'Y-m-d 00:00:00' );
		$month_end   = $first->format( 'Y-m-t 23:59:59' );

		// Bucket events by day-of-month (by start date).
		$events   = tribe_get_events( [
			'start_date'     => $month_start,
			'end_date'       => $month_end,
			'posts_per_page' => -1,
		] );
		$by_day = [];
		foreach ( $events as $ev ) {
			$d = (int) tribe_get_start_date( $ev, false, 'j' );
			$by_day[ $d ] = ( $by_day[ $d ] ?? 0 ) + 1;
		}

		$prev = ( clone $first )->modify( '-1 month' )->format( 'Y-m' );
		$next = ( clone $first )->modify( '+1 month' )->format( 'Y-m' );
		$base = home_url( '/' );
		$nav  = static function ( $ym ) use ( $base ) {
			return esc_url( add_query_arg( 'esb_cal', $ym, $base ) . '#esb-events-cal' );
		};
		$weekdays = [ 'M', 'T', 'W', 'T', 'F', 'S', 'S' ];
		?>
		<div class="esb-cal" id="esb-events-cal">
			<div class="esb-cal-head">
				<a class="esb-cal-nav" href="<?php echo $nav( $prev ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" aria-label="<?php esc_attr_e( 'Previous month', 'excellence-school' ); ?>">&lsaquo;</a>
				<span class="esb-cal-title"><?php echo esc_html( $first->format( 'F Y' ) ); ?></span>
				<a class="esb-cal-nav" href="<?php echo $nav( $next ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" aria-label="<?php esc_attr_e( 'Next month', 'excellence-school' ); ?>">&rsaquo;</a>
			</div>
			<div class="esb-cal-grid">
				<?php foreach ( $weekdays as $wd ) : ?>
					<span class="esb-cal-wd"><?php echo esc_html( $wd ); ?></span>
				<?php endforeach; ?>
				<?php for ( $b = 0; $b < $lead_blanks; $b++ ) : ?>
					<span class="esb-cal-day esb-cal-empty"></span>
				<?php endfor; ?>
				<?php for ( $d = 1; $d <= $days_in_mon; $d++ ) : ?>
					<?php if ( ! empty( $by_day[ $d ] ) ) : ?>
						<?php $day_link = tribe_get_day_link( sprintf( '%04d-%02d-%02d', $year, $month_num, $d ) ); ?>
						<a class="esb-cal-day esb-cal-has" href="<?php echo esc_url( $day_link ); ?>"
						   title="<?php echo esc_attr( sprintf( _n( '%d event', '%d events', $by_day[ $d ], 'excellence-school' ), $by_day[ $d ] ) ); ?>">
							<?php echo esc_html( $d ); ?>
						</a>
					<?php else : ?>
						<span class="esb-cal-day"><?php echo esc_html( $d ); ?></span>
					<?php endif; ?>
				<?php endfor; ?>
			</div>
			<a class="esb-cal-more" href="<?php echo esc_url( home_url( '/events/' ) ); ?>">
				<?php esc_html_e( 'View full calendar', 'excellence-school' ); ?> &rarr;
			</a>
		</div>
		<?php
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ): void {
		$title = $instance['title'] ?? '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'excellence-school' ); ?></label>
			<input class="widefat" type="text"
			       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ): array {
		return [ 'title' => sanitize_text_field( $new_instance['title'] ?? '' ) ];
	}
}

/**
 * Register the `esb_cal` query var so the footer mini-calendar's prev/next
 * month links don't 404 or get stripped.
 */
add_filter( 'query_vars', 'esb_register_cal_query_var' );
function esb_register_cal_query_var( array $vars ): array {
	$vars[] = 'esb_cal';
	return $vars;
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
   Hindi Translation meta box (generic pages)
   ========================================================================= */
require_once ESB_DIR . '/inc/page-translations.php';

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

