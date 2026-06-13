<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" data-lang="en">
<head>
<script>document.documentElement.className = document.documentElement.className.replace('no-js', 'js');</script>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-hero="<?php echo esc_attr( esb_opt( 'esb_hero_variant', '1' ) ); ?>">
<?php wp_body_open(); ?>

<!-- ===================== TOP BAR ===================== -->
<div class="topbar">
	<div class="container">
		<div class="tb-left">
			<span class="tb-item">
				<?php esb_dot(); ?>
				<span data-en="UDISE Code: <?php echo esc_attr( esb_opt( 'esb_udise', '23320301711' ) ); ?>"
				      data-hi="यूडाइस कोड: <?php echo esc_attr( esb_opt( 'esb_udise', '23320301711' ) ); ?>">
					<?php echo esc_html( 'UDISE Code: ' . esb_opt( 'esb_udise', '23320301711' ) ); ?>
				</span>
			</span>
			<span class="tb-item">
				<?php esb_dot(); ?>
				<span data-en="<?php echo esc_attr( esb_opt( 'esb_affiliation', 'MP Board Affiliated' ) ); ?>"
				      data-hi="एमपी बोर्ड संबद्ध">
					<?php echo esc_html( esb_opt( 'esb_affiliation', 'MP Board Affiliated' ) ); ?>
				</span>
			</span>
			<span class="tb-item">
				<?php esb_dot(); ?>
				<span data-en="Estd. <?php echo esc_attr( esb_opt( 'esb_estd', '1965' ) ); ?>"
				      data-hi="स्थापना <?php echo esc_attr( esb_opt( 'esb_estd', '1965' ) ); ?>">
					<?php echo esc_html( 'Estd. ' . esb_opt( 'esb_estd', '1965' ) ); ?>
				</span>
			</span>
		</div>
		<div class="tb-right">
			<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', esb_opt( 'esb_phone', '+917552552490' ) ) ); ?>">
				<?php echo esc_html( esb_opt( 'esb_phone', '+91 755-255-2490' ) ); ?>
			</a>
			<?php esb_dot(); ?>
			<a href="mailto:<?php echo esc_attr( esb_opt( 'esb_email', 'govt.hss.excellence.subhash@gmail.com' ) ); ?>"
			   data-en="Mon–Sat · 8 AM – 4 PM" data-hi="सोम–शनि · प्रातः 8 – सायं 4">
				Mon–Sat · 8 AM – 4 PM
			</a>
		</div>
	</div>
</div>

<!-- ===================== SITE HEADER ===================== -->
<header class="siteheader">
	<div class="container">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esb_logo(); ?>
			<span class="brand-text">
				<span class="bn1"
				      data-en="<?php echo esc_attr( esb_opt( 'esb_school_short_name', 'Subhash Excellence School' ) ); ?>"
				      data-hi="सुभाष उत्कृष्ट विद्यालय">
					<?php echo esc_html( esb_opt( 'esb_school_short_name', 'Subhash Excellence School' ) ); ?>
				</span>
				<?php if ( esb_opt( 'esb_header_show_tagline', '1' ) ) : ?>
				<span class="bn2"
				      data-en="<?php echo esc_attr( esb_opt( 'esb_school_subtitle', 'Govt. Higher Secondary · Bhopal' ) ); ?>"
				      data-hi="शासकीय उच्चतर माध्यमिक · भोपाल">
					<?php echo esc_html( esb_opt( 'esb_school_subtitle', 'Govt. Higher Secondary · Bhopal' ) ); ?>
				</span>
				<?php endif; ?>
			</span>
		</a>

		<nav class="nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'excellence-school' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new ESB_Nav_Walker(),
				'fallback_cb'    => 'esb_default_nav',
			] );
			?>
		</nav>

		<div class="header-actions">
			<div class="lang-toggle" role="group" aria-label="<?php esc_attr_e( 'Language', 'excellence-school' ); ?>">
				<button data-lang="en" class="active">EN</button>
				<button data-lang="hi">हिं</button>
			</div>
			<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
			   class="btn btn-gold"
			   data-en="<?php esc_attr_e( 'Apply Now', 'excellence-school' ); ?>"
			   data-hi="आवेदन करें">
				<?php esc_html_e( 'Apply Now', 'excellence-school' ); ?>
			</a>
			<button class="hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'excellence-school' ); ?>">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>

<!-- ===================== MOBILE DRAWER ===================== -->
<div class="drawer">
	<div class="drawer-scrim"></div>
	<div class="drawer-panel">

		<!-- Drawer header: brand + close -->
		<div class="dh">
			<a class="drawer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esb_logo(); ?>
				<span class="drawer-name"
				      data-en="<?php echo esc_attr( esb_opt( 'esb_school_short_name', 'Subhash Excellence School' ) ); ?>"
				      data-hi="सुभाष उत्कृष्ट विद्यालय">
					<?php echo esc_html( esb_opt( 'esb_school_short_name', 'Subhash Excellence School' ) ); ?>
				</span>
			</a>
			<button class="drawer-close" aria-label="<?php esc_attr_e( 'Close menu', 'excellence-school' ); ?>">×</button>
		</div>

		<!-- Nav links (scrollable middle area) -->
		<nav class="drawer-nav">
			<?php
			wp_nav_menu( [
				'theme_location' => 'drawer',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new ESB_Nav_Walker(),
				'fallback_cb'    => 'esb_default_drawer_nav',
			] );
			?>
		</nav>

		<!-- Drawer footer: lang + CTA -->
		<div class="drawer-footer">
			<div class="drawer-lang-wrap">
				<div class="lang-toggle" role="group" aria-label="<?php esc_attr_e( 'Language', 'excellence-school' ); ?>">
					<button data-lang="en" class="active">EN</button>
					<button data-lang="hi">हिं</button>
				</div>
			</div>
			<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
			   class="btn btn-gold btn-arrow"
			   data-en="Apply for Admission" data-hi="आवेदन करें">
				<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
			</a>
		</div>

	</div>
</div>

<?php
/**
 * Default nav fallback — shown before menus are assigned.
 */
function esb_default_nav(): void {
	$links = [
		home_url( '/' )               => [ 'Home', 'होम' ],
		home_url( '/about/' )         => [ 'About', 'परिचय' ],
		home_url( '/academics/' )     => [ 'Academics', 'शिक्षा' ],
		home_url( '/student-corner/' ) => [ 'Student Corner', 'विद्यार्थी कोना' ],
		home_url( '/admissions/' )    => [ 'Admission', 'प्रवेश' ],
		home_url( '/#contact' )       => [ 'Contact', 'संपर्क' ],
	];
	foreach ( $links as $url => [ $en, $hi ] ) {
		printf(
			'<a href="%s" data-en="%s" data-hi="%s">%s</a>',
			esc_url( $url ),
			esc_attr( $en ),
			esc_attr( $hi ),
			esc_html( $en )
		);
	}
}

function esb_default_drawer_nav(): void {
	esb_default_nav();
}

/**
 * Nav walker that adds data-en/data-hi from nav item title / description,
 * and renders dropdown submenus for top-level items with children.
 */
class ESB_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ): void {
		$output .= '<div class="nav-dropdown">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ): void {
		$output .= '</div>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ): void {
		$classes      = empty( $item->classes ) ? [] : (array) $item->classes;
		$is_active    = array_intersect( [ 'current-menu-item', 'current_page_item', 'current-menu-parent', 'current-menu-ancestor', 'current_page_parent', 'current_page_ancestor' ], $classes );
		$has_children = in_array( 'menu-item-has-children', $classes, true ) || ! empty( $args->has_children );
		$hi           = trim( $item->description );

		if ( 0 === $depth && $has_children ) {
			$output .= '<div class="nav-item has-children">';
			$output .= '<a href="' . esc_url( $item->url ) . '" class="nav-link' . ( $is_active ? ' active' : '' ) . '">';
			if ( $hi ) {
				$output .= '<span data-en="' . esc_attr( $item->title ) . '" data-hi="' . esc_attr( $hi ) . '">' . esc_html( $item->title ) . '</span>';
			} else {
				$output .= esc_html( $item->title );
			}
			$output .= '<span class="nav-caret" aria-hidden="true"></span>';
			$output .= '</a>';
			return;
		}

		$attr  = 'href="' . esc_url( $item->url ) . '"';
		$attr .= 0 === $depth ? '' : ' class="nav-sublink' . ( $is_active ? ' active' : '' ) . '"';
		$attr .= ( 0 === $depth && $is_active ) ? ' class="active"' : '';

		if ( $hi ) {
			$attr .= ' data-en="' . esc_attr( $item->title ) . '" data-hi="' . esc_attr( $hi ) . '"';
		}

		$output .= '<a ' . $attr . '>' . esc_html( $item->title ) . '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ): void {
		$classes      = empty( $item->classes ) ? [] : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true ) || ! empty( $args->has_children );
		if ( 0 === $depth && $has_children ) {
			$output .= '</div>';
		}
	}
}
