<?php
/**
 * Page Content Settings — admin options page for editing all on-page text.
 *
 * Registers a top-level "Page Content" menu item in wp-admin.
 * All content is stored as a single serialised option: esb_page_content.
 *
 * Helper: esb_pg( $key, $default ) reads a value from that option.
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

/* =========================================================================
   Helper
   ========================================================================= */

/**
 * Retrieve a page-content value.
 *
 * @param string $key     Dot-free key, e.g. 'wcu_card_1_title'.
 * @param string $default Fallback if key is not set.
 * @return string
 */
function esb_pg( string $key, string $default = '' ): string {
	static $data = null;
	if ( null === $data ) {
		$data = (array) get_option( 'esb_page_content', [] );
	}
	return isset( $data[ $key ] ) && '' !== $data[ $key ] ? (string) $data[ $key ] : $default;
}

/* =========================================================================
   Admin Menu
   ========================================================================= */

add_action( 'admin_menu', 'esb_pg_add_menu' );
function esb_pg_add_menu(): void {
	add_menu_page(
		esc_html__( 'Page Content', 'excellence-school' ),
		esc_html__( 'Page Content', 'excellence-school' ),
		'edit_theme_options',
		'esb-page-content',
		'esb_pg_settings_page',
		'dashicons-edit-page',
		61
	);
}

/* =========================================================================
   Settings Registration
   ========================================================================= */

add_action( 'admin_init', 'esb_pg_register_settings' );
function esb_pg_register_settings(): void {
	register_setting(
		'esb_page_content_group',
		'esb_page_content',
		[ 'sanitize_callback' => 'esb_pg_sanitize' ]
	);
}

function esb_pg_sanitize( $raw ): array {
	if ( ! is_array( $raw ) ) {
		return [];
	}
	// Merge with existing data so saving one tab never wipes another tab's fields.
	$clean = (array) get_option( 'esb_page_content', [] );
	foreach ( $raw as $key => $value ) {
		$key = sanitize_key( $key );
		// Percentage fields stay numeric; everything else is text.
		if ( str_ends_with( $key, '_pct' ) ) {
			$clean[ $key ] = (string) min( 100, max( 0, absint( $value ) ) );
		} elseif ( str_ends_with( $key, '_url' ) ) {
			$clean[ $key ] = esc_url_raw( wp_unslash( (string) $value ) );
		} else {
			$clean[ $key ] = sanitize_textarea_field( wp_unslash( (string) $value ) );
		}
	}
	return $clean;
}

/* =========================================================================
   Admin-page Styles (inline, minimal)
   ========================================================================= */

add_action( 'admin_head', 'esb_pg_admin_styles' );
function esb_pg_admin_styles(): void {
	$screen = get_current_screen();
	if ( ! $screen || 'toplevel_page_esb-page-content' !== $screen->id ) {
		return;
	}
	?>
	<style>
	.esb-pg-wrap { max-width: 900px; }
	.esb-pg-tabs { display: flex; gap: 0; margin-bottom: 0; border-bottom: 1px solid #ccd0d4; }
	.esb-pg-tabs a {
		display: inline-block; padding: 8px 18px; text-decoration: none;
		font-weight: 500; color: #50575e; border: 1px solid transparent;
		border-bottom: none; margin-bottom: -1px; background: #f0f0f1;
	}
	.esb-pg-tabs a.active {
		background: #fff; color: #1d2327;
		border-color: #ccd0d4; border-bottom-color: #fff;
	}
	.esb-pg-section { background: #fff; border: 1px solid #ccd0d4; border-top: none; padding: 20px 24px; }
	.esb-pg-group { margin-bottom: 28px; padding-bottom: 24px; border-bottom: 1px solid #f0f0f1; }
	.esb-pg-group:last-child { border-bottom: none; margin-bottom: 0; }
	.esb-pg-group-title { font-size: 14px; font-weight: 600; color: #1d2327; margin: 0 0 14px; text-transform: uppercase; letter-spacing: .04em; }
	.esb-pg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 20px; }
	.esb-pg-row.full { grid-template-columns: 1fr; }
	.esb-pg-field label { display: block; font-size: 12px; font-weight: 600; color: #50575e; margin-bottom: 4px; text-transform: uppercase; letter-spacing: .04em; }
	.esb-pg-field input[type=text],
	.esb-pg-field input[type=number],
	.esb-pg-field textarea { width: 100%; border-radius: 3px; }
	.esb-pg-field textarea { min-height: 70px; }
	.esb-pg-card-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
	.esb-pg-card { border: 1px solid #e2e4e7; border-radius: 4px; padding: 14px; background: #fafafa; }
	.esb-pg-card-num { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #9ca2a7; margin-bottom: 8px; }

	/* Section visibility toggles */
	.esb-pg-toggle-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4px 24px; }
	.esb-pg-toggle {
		display: flex; align-items: flex-start; gap: 12px;
		padding: 10px 8px; border-radius: 4px; cursor: pointer;
		transition: background-color .12s ease;
	}
	.esb-pg-toggle:hover { background: #f0f6fc; }
	.esb-pg-toggle-switch { position: relative; flex: 0 0 auto; margin-top: 2px; }
	.esb-pg-toggle-switch input[type="checkbox"] {
		position: absolute; opacity: 0; width: 36px; height: 20px; margin: 0; cursor: pointer;
	}
	.esb-pg-toggle-track {
		display: block; width: 36px; height: 20px; border-radius: 10px;
		background: #c3c4c7; transition: background-color .15s ease; position: relative;
	}
	.esb-pg-toggle-thumb {
		position: absolute; top: 2px; left: 2px; width: 16px; height: 16px;
		border-radius: 50%; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0,.25);
		transition: transform .15s ease;
	}
	.esb-pg-toggle-switch input[type="checkbox"]:checked ~ .esb-pg-toggle-track { background: #11603c; }
	.esb-pg-toggle-switch input[type="checkbox"]:checked ~ .esb-pg-toggle-track .esb-pg-toggle-thumb { transform: translateX(16px); }
	.esb-pg-toggle-switch input[type="checkbox"]:focus-visible ~ .esb-pg-toggle-track { outline: 2px solid #11603c; outline-offset: 2px; }
	.esb-pg-toggle-text { display: flex; flex-direction: column; font-size: 13px; line-height: 1.4; }
	.esb-pg-toggle-text strong { color: #1d2327; font-size: 13px; }
	.esb-pg-toggle-desc { color: #757575; font-size: 12px; margin-top: 2px; }
	</style>
	<?php
}

/* =========================================================================
   Settings Page Renderer
   ========================================================================= */

function esb_pg_settings_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'excellence-school' ) );
	}

	$tabs = [
		'home'       => __( '🏠 Home', 'excellence-school' ),
		'about'      => __( 'ℹ️ About', 'excellence-school' ),
		'academics'  => __( '📚 Academics', 'excellence-school' ),
		'admissions' => __( '📋 Admissions', 'excellence-school' ),
		'guide'      => __( '📖 Content Guide', 'excellence-school' ),
	];

	$active = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'home'; // phpcs:ignore WordPress.Security.NonceVerification
	if ( ! array_key_exists( $active, $tabs ) ) {
		$active = 'home';
	}
	?>
	<div class="wrap esb-pg-wrap">
		<h1><?php esc_html_e( 'Page Content', 'excellence-school' ); ?></h1>
		<p class="description" style="margin-bottom:16px">
			<?php esc_html_e( 'Edit the text shown on each page of the website. Changes save immediately and are reflected live.', 'excellence-school' ); ?>
		</p>

		<div class="esb-pg-tabs">
			<?php foreach ( $tabs as $slug => $label ) : ?>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=esb-page-content&tab=' . $slug ) ); ?>"
			   class="<?php echo $active === $slug ? 'active' : ''; ?>">
				<?php echo esc_html( $label ); ?>
			</a>
			<?php endforeach; ?>
		</div>

		<?php if ( 'guide' === $active ) : ?>
			<div class="esb-pg-section">
				<?php esb_pg_tab_guide(); ?>
			</div>
		<?php else : ?>
		<form method="post" action="options.php" class="esb-pg-section">
			<?php settings_fields( 'esb_page_content_group' ); ?>
			<input type="hidden" name="_esb_tab" value="<?php echo esc_attr( $active ); ?>" />

			<?php
			match ( $active ) {
				'home'       => esb_pg_tab_home(),
				'about'      => esb_pg_tab_about(),
				'academics'  => esb_pg_tab_academics(),
				'admissions' => esb_pg_tab_admissions(),
				default      => null,
			};
			?>

			<?php submit_button( __( 'Save Changes', 'excellence-school' ) ); ?>
		</form>
		<?php endif; ?>
	</div>
	<?php
}

/* =========================================================================
   Field Helpers
   ========================================================================= */

function esb_pg_text( string $key, string $label, string $default = '', string $placeholder = '' ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<input type="text"
		       id="esb_pg_<?php echo esc_attr( $key ); ?>"
		       name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		       value="<?php echo esc_attr( $value ); ?>"
		       placeholder="<?php echo esc_attr( $placeholder ?: $default ); ?>" />
	</div>
	<?php
}

function esb_pg_textarea( string $key, string $label, string $default = '', string $placeholder = '' ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<textarea id="esb_pg_<?php echo esc_attr( $key ); ?>"
		          name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		          placeholder="<?php echo esc_attr( $placeholder ?: $default ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
	</div>
	<?php
}

function esb_pg_number( string $key, string $label, string $default = '0', int $min = 0, int $max = 100 ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<input type="number"
		       id="esb_pg_<?php echo esc_attr( $key ); ?>"
		       name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		       value="<?php echo esc_attr( $value ); ?>"
		       min="<?php echo esc_attr( $min ); ?>"
		       max="<?php echo esc_attr( $max ); ?>" />
	</div>
	<?php
}

function esb_pg_url( string $key, string $label, string $default = '' ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<input type="url"
		       id="esb_pg_<?php echo esc_attr( $key ); ?>"
		       name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		       value="<?php echo esc_attr( $value ); ?>"
		       placeholder="https://" />
	</div>
	<?php
}

/**
 * Toggle switch for showing/hiding a homepage section.
 * Stores '1' (visible) or '0' (hidden) under key "show_{$key}".
 *
 * Uses the hidden-input + checkbox pattern so an unchecked box still
 * submits a value (browsers omit unchecked checkboxes entirely).
 */
function esb_pg_toggle( string $key, string $label, string $description = '' ): void {
	$field   = "show_{$key}";
	$checked = '0' !== esb_pg( $field, '1' );
	?>
	<label class="esb-pg-toggle" for="esb_pg_<?php echo esc_attr( $field ); ?>">
		<input type="hidden" name="esb_page_content[<?php echo esc_attr( $field ); ?>]" value="0" />
		<span class="esb-pg-toggle-switch">
			<input type="checkbox"
			       id="esb_pg_<?php echo esc_attr( $field ); ?>"
			       name="esb_page_content[<?php echo esc_attr( $field ); ?>]"
			       value="1"
			       <?php checked( $checked ); ?> />
			<span class="esb-pg-toggle-track"><span class="esb-pg-toggle-thumb"></span></span>
		</span>
		<span class="esb-pg-toggle-text">
			<strong><?php echo esc_html( $label ); ?></strong>
			<?php if ( $description ) : ?>
				<span class="esb-pg-toggle-desc"><?php echo esc_html( $description ); ?></span>
			<?php endif; ?>
		</span>
	</label>
	<?php
}

/**
 * Whether a homepage section should be rendered.
 * Defaults to true (visible) when no choice has been saved yet.
 *
 * @param string $key Section key, e.g. 'testimonials'.
 */
function esb_section_visible( string $key ): bool {
	return '0' !== esb_pg( "show_{$key}", '1' );
}

/* =========================================================================
   Tab: Home
   ========================================================================= */

function esb_pg_tab_home(): void {
	?>
	<!-- ---- Section Visibility ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Homepage Sections — Show / Hide', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px">
			<?php esc_html_e( 'Turn any section off to hide it from the homepage. Its content stays saved — switch it back on any time.', 'excellence-school' ); ?>
		</p>
		<div class="esb-pg-toggle-grid">
			<?php
			esb_pg_toggle( 'circulars', __( 'Circulars & Notices', 'excellence-school' ), __( 'Latest circulars/notices strip with a "View All" button.', 'excellence-school' ) );
			esb_pg_toggle( 'stats_band', __( 'Key Statistics Band', 'excellence-school' ), __( 'Pass rate, students, years of service strip.', 'excellence-school' ) );
			esb_pg_toggle( 'why_choose_us', __( 'Why Choose Us', 'excellence-school' ), __( 'Section heading + 6 highlight cards.', 'excellence-school' ) );
			esb_pg_toggle( 'principal_message', __( "Principal's Message", 'excellence-school' ), __( 'Quote, photo and message from the Principal.', 'excellence-school' ) );
			esb_pg_toggle( 'academic_excellence', __( 'Academic Excellence', 'excellence-school' ), __( 'Streams, subjects and academic highlights.', 'excellence-school' ) );
			esb_pg_toggle( 'achievements', __( 'Achievements', 'excellence-school' ), __( 'Badges and award highlights.', 'excellence-school' ) );
			esb_pg_toggle( 'facilities', __( 'Facilities', 'excellence-school' ), __( 'Labs, library, sports and other facilities.', 'excellence-school' ) );
			esb_pg_toggle( 'student_life', __( 'Student Life Mosaic', 'excellence-school' ), __( 'Photo mosaic with captions.', 'excellence-school' ) );
			esb_pg_toggle( 'news_events', __( 'News & Events', 'excellence-school' ), __( 'Latest posts from News & Events.', 'excellence-school' ) );
			esb_pg_toggle( 'testimonials', __( 'Testimonials', 'excellence-school' ), __( 'Quotes from parents and students.', 'excellence-school' ) );
			esb_pg_toggle( 'admissions_cta', __( 'Admissions CTA Banner', 'excellence-school' ), __( 'Mid-page "Give Your Child the Excellence" banner.', 'excellence-school' ) );
			esb_pg_toggle( 'contact', __( 'Contact Section', 'excellence-school' ), __( 'Map, address and enquiry form at the bottom.', 'excellence-school' ) );
			?>
		</div>
	</div>

	<!-- ---- Hero Content ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 1 — Full-Bleed Photo', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to variant 1 in Appearance → Customize → Hero.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'hero1_h1', 'Main Headline (H1)', 'A Government School of Distinction.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'hero1_sub', 'Subtitle', "Nurturing tomorrow's leaders in Subhash Shivaji Nagar — where academic excellence, character, and opportunity meet under one roof." ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 2 — Dark Prestige (default)', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to variant 2 (the default). Deep forest-green full-width hero with gold accents and mini stats.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'hero2_h1', 'Main Headline (H1)', 'Where Excellence Becomes a Habit.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'hero2_sub', 'Subtitle', 'A premier government institution in Bhopal offering Science, Commerce and Humanities with modern labs, a tinkering lab, and championship sports.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_text( 'hero2_cycle_words', 'Cycling Words (pipe-separated)', 'Excellence|Distinction|Achievement|Heritage', 'e.g. Excellence|Distinction|Achievement|Heritage' ); ?>
			<p class="description" style="margin-top:4px;font-size:12px;color:#777">
				<?php esc_html_e( 'Separate words with | (pipe). The first word must appear in your Main Headline above — it becomes the animated word.', 'excellence-school' ); ?>
			</p>
		</div>
		<div class="esb-pg-row" style="margin-top:10px">
			<?php esb_pg_text( 'hero2_cta1', 'Primary Button Label', 'Apply for Admission' ); ?>
			<?php esb_pg_text( 'hero2_cta2', 'Secondary Button Label', 'Explore Academics' ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 3 — Crest-Forward (centred)', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to variant 3. The H1 uses the Full School Name from School Identity → the Subtitle below is the only editable text here.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'hero3_sub', 'Subtitle', "Nurturing tomorrow's leaders through quality education, modern facilities, and holistic development — open to every section of society." ); ?>
		</div>
	</div>

	<!-- ---- Why Choose Us ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Why Choose Us — Section Header', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'wcu_h2', 'Heading', 'A Foundation Built on Trust & Merit' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'wcu_sub', 'Subtext', "As a designated Government School of Excellence, we combine the reach of public education with the standards of India's leading private schools." ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Why Choose Us — 6 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$wcu_defaults = [
				1 => [ 'Academic Rigour', 'A merit-driven curriculum across Science, Commerce and Humanities, with focused coaching for board and competitive exams.' ],
				2 => [ 'Modern Infrastructure', 'Smart classrooms, science labs, a computer lab and an ATAL Tinkering Lab sanctioned by NITI Aayog for hands-on STEM learning.' ],
				3 => [ 'Championship Sports', 'Professional coaching in boxing, cricket and badminton has produced district and state-level champions year after year.' ],
				4 => [ 'Holistic Development', 'Beyond marks — debate, arts, NCC, scouts and community service shape confident, responsible citizens.' ],
				5 => [ 'Residential Facility', 'A safe, disciplined hostel offers students from across the region a focused environment to live and learn.' ],
				6 => [ 'Education for All', 'World-class learning, open to every section of society — upholding the promise of an equitable public education.' ],
			];
			foreach ( $wcu_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Card $i" ); ?></div>
				<?php esb_pg_text( "wcu_card_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "wcu_card_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Home CTA Banner ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Admissions CTA Banner (Home Page)', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'home_cta_h2', 'Headline', 'Give Your Child the Excellence They Deserve' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'home_cta_body', 'Body Text', 'Join the School for Excellence, Bhopal and open the door to quality education, modern facilities and a community that believes in every child. Limited seats available.' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: About
   ========================================================================= */

function esb_pg_tab_about(): void {
	?>
	<!-- ---- About Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_hero_h1', 'Heading (H1)', 'A Legacy of Public Excellence' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_hero_sub', 'Subtitle', 'A premier government institution under the Department of School Education, Madhya Pradesh — committed to world-class learning for every child.' ); ?>
		</div>
	</div>

	<!-- ---- Our Story ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Story Section', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_story_h2', 'Heading', 'Two Decades of Distinction' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_story_lead', 'Lead Paragraph', 'Established in [year], the Govt. Higher Secondary School for Excellence, Subhash Shivaji Nagar, was created with a singular vision — to deliver the standard of India\'s finest schools within the public system.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_story_body', 'Body Paragraph', 'Affiliated with the MP Board of Secondary Education, we offer Science, Commerce and Humanities streams at the higher secondary level. With dedicated faculty, modern infrastructure and a focus on holistic growth, we nurture responsible citizens and future leaders from every section of society.' ); ?>
		</div>
	</div>

	<!-- ---- Vision & Mission ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Vision & Mission', 'excellence-school' ); ?></div>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'about_vision', 'Vision Text', 'To be a beacon of equitable, world-class education — where every learner, regardless of background, discovers their potential and rises to lead with knowledge and integrity.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_mission', 'Mission Text', 'To provide rigorous academics, modern facilities and value-based education that develops character, critical thinking and a lifelong love of learning in every student.' ); ?>
		</div>
	</div>

	<!-- ---- Values ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Values — 4 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$val_defaults = [
				1 => [ 'Excellence', 'Setting and meeting the highest standards in all we do.' ],
				2 => [ 'Integrity',  'Honesty, discipline and fairness at the heart of our culture.' ],
				3 => [ 'Equity',     'Quality education open and accessible to every child.' ],
				4 => [ 'Innovation', 'Modern methods and a tinkering mindset for tomorrow.' ],
			];
			foreach ( $val_defaults as $i => [ $label, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Value $i" ); ?></div>
				<?php esb_pg_text( "about_val_{$i}_label", 'Label', $label ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "about_val_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Principal's Message (About page) ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( "Principal's Message (About Page)", 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:12px">
			<?php esc_html_e( 'Name, role and portrait are shared with the home-page message — edit those under Appearance → Customise → School Settings → Principal\'s Message.', 'excellence-school' ); ?>
		</p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'about_pm_quote', 'Opening Quote', "Education is the most powerful tool we can place in a child's hands. At the School for Excellence, our promise is that no dream is too large and no child is left behind." ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_pm_para', 'Body Paragraph', 'Over two decades, this institution has grown into a name that families across Bhopal trust. Our students walk out as confident, principled young people — toppers, athletes, innovators and, above all, good human beings.' ); ?>
		</div>
	</div>

	<!-- ---- About CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_cta_h2', 'Headline', 'Become Part of Our Story' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: Academics
   ========================================================================= */

function esb_pg_tab_academics(): void {
	?>
	<!-- ---- Academics Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'acad_hero_h1', 'Heading (H1)', 'Learning Without Limits' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'acad_hero_sub', 'Subtitle', 'A rigorous, future-ready curriculum across Science, Commerce and Humanities — backed by modern labs and dedicated coaching for board and competitive exams.' ); ?>
		</div>
	</div>

	<!-- ---- Curriculum Overview (Classes I-XII) ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Curriculum Overview (Classes I-XII)', 'excellence-school' ); ?></div>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'acad_curr_intro', 'Intro Paragraph', 'Our curriculum follows the Madhya Pradesh Board of Secondary Education (MPBSE) syllabus for Classes I-XII, aligned with the National Curriculum Framework (NCF), the National Education Policy (NEP) 2020 and NCERT standards — building a strong foundation from the primary years through to board-exam success.' ); ?>
		</div>
		<div class="esb-pg-card-grid" style="margin-top:14px">
			<?php
			$level_defaults = [
				1 => [ 'Primary — Classes I-V', 'Foundational literacy, numeracy and environmental awareness through activity-based, NEP-aligned learning.' ],
				2 => [ 'Middle — Classes VI-VIII', 'Subject-wise teaching begins, building conceptual understanding in Science, Mathematics, Social Science, Hindi and English.' ],
				3 => [ 'Secondary — Classes IX-X', 'Focused preparation for MP Board (MPBSE) Class X examinations, with regular tests and NCERT-based teaching.' ],
				4 => [ 'Senior Secondary — Classes XI-XII', 'Specialisation in Science, Commerce or Humanities streams with board-exam and competitive-exam coaching.' ],
			];
			foreach ( $level_defaults as $i => [ $name, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Level $i" ); ?></div>
				<?php esb_pg_text( "acad_level_{$i}_name", 'Name', $name ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_level_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Examination Pattern ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Examination Pattern', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$exam_defaults = [
				1 => [ 'Periodic Tests', 'Regular class tests are held throughout the year to track progress and identify areas needing extra attention.' ],
				2 => [ 'Half-Yearly Examinations', 'A comprehensive mid-term exam assesses learning from the first half of the academic syllabus.' ],
				3 => [ 'Annual / Board Examinations', 'Final examinations cover the full syllabus — conducted by the school for Classes I-IX & XI, and by MPBSE for Classes X & XII.' ],
			];
			foreach ( $exam_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Item $i" ); ?></div>
				<?php esb_pg_text( "acad_exam_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_exam_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Streams ---- -->
	<?php
	$stream_defaults = [
		'sci' => [
			'Science',
			[
				'Physics, Chemistry, Mathematics (PCM)',
				'Physics, Chemistry, Biology (PCB)',
				'NEET / JEE foundation coaching',
				'Practical-led lab learning',
			],
		],
		'com' => [
			'Commerce',
			[
				'Accountancy & Book-keeping',
				'Business Studies',
				'Economics & Mathematics',
				'Commerce career guidance',
			],
		],
		'hum' => [
			'Humanities',
			[
				'History & Political Science',
				'Geography & Economics',
				'Hindi & English literature',
				'Civil services orientation',
			],
		],
	];
	foreach ( $stream_defaults as $slug => [ $stream_name, $items ] ) :
	?>
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php echo esc_html( "Stream: $stream_name" ); ?></div>
		<?php esb_pg_text( "acad_{$slug}_name", 'Stream Name', $stream_name ); ?>
		<div class="esb-pg-card-grid" style="margin-top:10px">
			<?php foreach ( $items as $i => $item ) :
				$n = $i + 1;
				?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Item $n" ); ?></div>
				<?php esb_pg_text( "acad_{$slug}_item_{$n}", 'Subject / Module', $item ); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endforeach; ?>

	<!-- ---- Our Approach ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Approach — 3 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$approach_defaults = [
				1 => [ 'Concept-First Teaching', 'Smart classrooms and visual aids build deep understanding before rote — so students reason, not just remember.' ],
				2 => [ 'Exam Mastery',            'Regular tests, remedial sessions and competitive-exam coaching ensure every learner is board-ready and beyond.' ],
				3 => [ 'Learning by Doing',       'Science labs and the ATAL Tinkering Lab turn theory into hands-on experiments, projects and real innovation.' ],
			];
			foreach ( $approach_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Card $i" ); ?></div>
				<?php esb_pg_text( "acad_app_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_app_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Board Results ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Board Results', 'excellence-school' ); ?></div>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'acad_results_desc', 'Description Paragraph', 'In 2025, our Class XII Science cohort recorded a 99% pass rate, with several students placing in the district merit list and scoring above 95%. Our results reflect a culture of disciplined preparation, individual attention and high expectations held for every student.' ); ?>
		</div>
		<div class="esb-pg-card-grid" style="margin-top:14px">
			<?php
			$bar_defaults = [
				1 => [ 'Class XII · Science',    99 ],
				2 => [ 'Class XII · Commerce',   98 ],
				3 => [ 'Class XII · Humanities', 97 ],
				4 => [ 'Class X · All Streams',  96 ],
			];
			foreach ( $bar_defaults as $i => [ $label, $pct ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Result Bar $i" ); ?></div>
				<?php esb_pg_text( "acad_bar_{$i}_label", 'Label', $label ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_number( "acad_bar_{$i}_pct", 'Pass Rate (%)', (string) $pct, 0, 100 ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr;margin-top:14px">
			<?php
			$pill_defaults = [
				1 => [ 'District Toppers', 'जिला टॉपर' ],
				2 => [ '95%+ Scorers', '95%+ अंक' ],
				3 => [ 'State Merit List', 'राज्य मेरिट सूची' ],
			];
			foreach ( $pill_defaults as $i => [ $en, $hi ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Pill $i" ); ?></div>
				<?php esb_pg_text( "acad_pill_{$i}_en", 'Label (English)', $en ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_text( "acad_pill_{$i}_hi", 'Label (Hindi)', $hi ); ?>
				</div>
				<div style="margin-top:8px">
					<?php esb_pg_url( "acad_pill_{$i}_url", 'Link (optional)' ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Academic Facilities ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Academic Facilities — 3 Items', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$acfac_defaults = [
				1 => [ 'Science Laboratories', 'Physics, Chemistry and Biology labs with modern apparatus for regular practical sessions.' ],
				2 => [ 'ATAL Tinkering Lab',   'A NITI Aayog–sanctioned lab for robotics, electronics and 21st-century STEM skills.' ],
				3 => [ 'Library & Resources',  'Over 5,000 books, periodicals and digital resources for study, research and exam prep.' ],
			];
			foreach ( $acfac_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Item $i" ); ?></div>
				<?php esb_pg_text( "acad_fac_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_fac_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Academics CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'acad_cta_h2', 'Headline', 'Build Your Future With Us' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: Admissions
   ========================================================================= */

function esb_pg_tab_admissions(): void {
	?>
	<!-- ---- Admissions Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'The H1 heading automatically shows the current year. The subtitle is editable below.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'adm_hero_sub', 'Subtitle', 'Join a community where every child is challenged, supported and inspired to excel. Applications for Classes IX to XII are now open.' ); ?>
		</div>
	</div>

	<!-- ---- How to Apply Steps ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'How to Apply — 4 Steps', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$step_defaults = [
				1 => [ 'Enquire',           'Submit the enquiry form below or visit the school office to register your interest.' ],
				2 => [ 'Submit Documents',  'Provide the required documents and the completed admission form at the office.' ],
				3 => [ 'Interaction',       'A short interaction or entry assessment for the chosen class and stream.' ],
				4 => [ 'Confirmation',      'On selection, complete enrolment formalities and welcome to the family!' ],
			];
			foreach ( $step_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Step $i" ); ?></div>
				<?php esb_pg_text( "adm_step_{$i}_title", 'Step Name', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "adm_step_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Eligibility ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Eligibility Table — 4 Rows', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$elig_defaults = [
				1 => [ 'Class IX – X',          'Passed previous class' ],
				2 => [ 'Class XI – Science',     'Class X with required %' ],
				3 => [ 'Class XI – Commerce',    'Class X passed' ],
				4 => [ 'Class XI – Humanities',  'Class X passed' ],
			];
			foreach ( $elig_defaults as $i => [ $class, $req ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Row $i" ); ?></div>
				<?php esb_pg_text( "adm_elig_{$i}_class", 'Class / Stream', $class ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_text( "adm_elig_{$i}_req", 'Eligibility Requirement', $req ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Documents ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Documents Required — up to 6 items', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$doc_defaults = [
				1 => "Previous year's marksheet / report card",
				2 => 'Transfer Certificate (TC) from previous school',
				3 => 'Aadhaar card of student',
				4 => 'Birth certificate (for Class IX)',
				5 => 'Caste / income certificate (if applicable)',
				6 => 'Passport-size photographs (4)',
			];
			foreach ( $doc_defaults as $i => $doc ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Document $i" ); ?></div>
				<?php esb_pg_text( "adm_doc_{$i}", 'Document', $doc ); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Important Dates ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Important Dates — 3 entries', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$date_defaults = [
				1 => [ 'Jun', '15', 'Applications Open',   'Enquiry & forms available at the office and online.' ],
				2 => [ 'Jul', '10', 'Last Date to Apply',  'Submit completed forms with all documents.' ],
				3 => [ 'Jul', '20', 'Session Begins',      'New academic session commences.' ],
			];
			foreach ( $date_defaults as $i => [ $month, $day, $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Date $i" ); ?></div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
					<?php esb_pg_text( "adm_date_{$i}_month", 'Month (3 letters)', $month ); ?>
					<?php esb_pg_text( "adm_date_{$i}_day",   'Day', $day ); ?>
				</div>
				<div style="margin-top:8px">
					<?php esb_pg_text( "adm_date_{$i}_title", 'Event Title', $title ); ?>
				</div>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "adm_date_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- FAQ ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'FAQ — up to 6 Q&As (leave blank to hide)', 'excellence-school' ); ?></div>
		<?php
		$faq_defaults = [
			1 => [ 'Is this a government school?', 'Yes. We are a designated Government School of Excellence under the Department of School Education, Madhya Pradesh, affiliated with the MP Board of Secondary Education.' ],
			2 => [ 'Which classes can I apply for?', 'Admissions are offered for Classes IX to XII, with Science, Commerce and Humanities streams at the higher secondary level (XI–XII).' ],
			3 => [ 'Is hostel accommodation available?', 'Yes, a safe and disciplined hostel facility is available for eligible students from outside Bhopal, subject to availability. Please enquire at the office for details.' ],
			4 => [ 'How will I be informed about selection?', 'Our admissions team will contact you by phone or email after the document verification and interaction stage.' ],
			5 => [ '', '' ],
			6 => [ '', '' ],
		];
		foreach ( $faq_defaults as $i => [ $q, $a ] ) :
		?>
		<div class="esb-pg-card" style="margin-bottom:12px;border-radius:4px;padding:14px;border:1px solid #e2e4e7;background:#fafafa">
			<div class="esb-pg-card-num"><?php echo esc_html( "Q&A $i" ); ?></div>
			<?php esb_pg_text( "adm_faq_{$i}_q", 'Question', $q ); ?>
			<div style="margin-top:8px">
				<?php esb_pg_textarea( "adm_faq_{$i}_a", 'Answer', $a ); ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

	<!-- ---- Admissions Bottom CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'adm_cta_h2', 'Headline', "Secure Your Child's Seat Today" ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: Content Guide
   ========================================================================= */

function esb_pg_tab_guide(): void {
	$cz = admin_url( 'customize.php' );
	$mn = admin_url( 'nav-menus.php' );
	$me = admin_url( 'admin.php?page=esb-page-content&tab=' );
	?>
	<style>
	.esb-guide h2 { font-size:16px; font-weight:700; color:#1d2327; margin:28px 0 6px; padding-bottom:6px; border-bottom:2px solid #dba617; display:inline-block; }
	.esb-guide h3 { font-size:13px; font-weight:700; color:#1d2327; margin:18px 0 4px; text-transform:uppercase; letter-spacing:.04em; }
	.esb-guide p, .esb-guide li { font-size:13.5px; color:#3c434a; line-height:1.6; }
	.esb-guide ul { margin:6px 0 0 18px; }
	.esb-guide .esb-guide-row { display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-top:16px; }
	.esb-guide .esb-guide-card { background:#f9f9f9; border:1px solid #e2e4e7; border-radius:6px; padding:18px 20px; }
	.esb-guide .esb-guide-card h3 { margin-top:0; }
	.esb-guide .path { display:inline-block; background:#1d2327; color:#fff; font-size:12px; font-weight:600; border-radius:3px; padding:3px 8px; margin:2px 0 8px; letter-spacing:.02em; }
	.esb-guide .path a { color:#dba617; text-decoration:none; }
	.esb-guide .path a:hover { text-decoration:underline; }
	.esb-guide .note { background:#fff8e1; border-left:3px solid #dba617; padding:10px 14px; font-size:13px; color:#555; border-radius:0 4px 4px 0; margin-top:10px; }
	.esb-guide table { border-collapse:collapse; width:100%; margin-top:10px; font-size:13px; }
	.esb-guide table th { background:#1d2327; color:#fff; padding:8px 12px; text-align:left; font-weight:600; }
	.esb-guide table td { padding:8px 12px; border-bottom:1px solid #f0f0f1; vertical-align:top; }
	.esb-guide table tr:last-child td { border-bottom:none; }
	.esb-guide table tr:nth-child(even) td { background:#f9f9f9; }
	</style>

	<div class="esb-guide">

		<p style="font-size:14px;color:#50575e;margin-bottom:4px">
			<?php esc_html_e( 'This guide tells you exactly where to go in wp-admin to change every piece of text, image and setting on the website.', 'excellence-school' ); ?>
		</p>

		<!-- ===== SCHOOL IDENTITY ===== -->
		<h2><?php esc_html_e( '1. School Identity & Contact Details', 'excellence-school' ); ?></h2>
		<p><?php esc_html_e( 'School name, phone number, email, address, established year, principal name — anything that appears in the header, footer, topbar and contact section.', 'excellence-school' ); ?></p>
		<div class="path">📍 <a href="<?php echo esc_url( $cz ); ?>" target="_blank"><?php esc_html_e( 'Appearance → Customize → School Identity', 'excellence-school' ); ?></a></div>

		<table>
			<tr><th><?php esc_html_e( 'What to change', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Setting name', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'Full school name (footer, contact)', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Full School Name', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Short name (header / eyebrow)', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Short School Name', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Tagline under header name', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Header Tagline', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Phone number', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Phone Number', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Email address', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Email Address', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Physical address', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Address', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'UDISE code, established year', 'excellence-school' ); ?></td><td><?php esc_html_e( 'UDISE Code / Established Year', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Principal name & role', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Principal Name / Principal Role', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Social media links', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Facebook / Instagram / LinkedIn / YouTube', 'excellence-school' ); ?></td></tr>
		</table>

		<!-- ===== HERO SECTION ===== -->
		<h2><?php esc_html_e( '2. Homepage Hero (the big banner at the top)', 'excellence-school' ); ?></h2>
		<div class="esb-guide-row">
			<div class="esb-guide-card">
				<h3><?php esc_html_e( 'Choose hero layout (1, 2 or 3)', 'excellence-school' ); ?></h3>
				<div class="path">📍 <a href="<?php echo esc_url( $cz ); ?>" target="_blank"><?php esc_html_e( 'Customize → Hero', 'excellence-school' ); ?></a></div>
				<p><?php esc_html_e( 'Pick variant 1 (photo), 2 (dark prestige — default), or 3 (crest centred). Upload a background image here too.', 'excellence-school' ); ?></p>
			</div>
			<div class="esb-guide-card">
				<h3><?php esc_html_e( 'Edit hero text & buttons', 'excellence-school' ); ?></h3>
				<div class="path">📍 <a href="<?php echo esc_url( $me . 'home' ); ?>"><?php esc_html_e( 'Page Content → Home → Hero 2', 'excellence-school' ); ?></a></div>
				<ul>
					<li><?php esc_html_e( 'Main Headline (H1)', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Subtitle paragraph', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Primary button label', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Secondary button label', 'excellence-school' ); ?></li>
					<li><strong><?php esc_html_e( 'Cycling / animated word', 'excellence-school' ); ?></strong></li>
				</ul>
			</div>
		</div>
		<div class="note">
			<strong><?php esc_html_e( 'Cycling word:', 'excellence-school' ); ?></strong>
			<?php esc_html_e( 'The animated word in the headline (e.g. "Excellence → Distinction → Achievement") is set in the "Cycling Words" field using pipe | to separate words — e.g.', 'excellence-school' ); ?>
			<code>Excellence|Distinction|Achievement|Heritage</code>.
			<?php esc_html_e( 'The first word in the list must also appear in your Main Headline text.', 'excellence-school' ); ?>
		</div>

		<!-- ===== HOMEPAGE SECTIONS ===== -->
		<h2><?php esc_html_e( '3. Homepage Sections', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $me . 'home' ); ?>"><?php esc_html_e( 'Page Content → Home tab', 'excellence-school' ); ?></a></div>

		<table>
			<tr><th><?php esc_html_e( 'Section', 'excellence-school' ); ?></th><th><?php esc_html_e( 'What you can change', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'Why Choose Us', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Section heading, subtext, and all 6 card titles + descriptions', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Admissions CTA Banner', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Headline and body text of the mid-page call-to-action strip', 'excellence-school' ); ?></td></tr>
		</table>

		<div class="note" style="margin-top:14px">
			<strong><?php esc_html_e( 'Show / hide a whole section:', 'excellence-school' ); ?></strong>
			<?php esc_html_e( 'At the very top of the Home tab is a "Homepage Sections — Show / Hide" panel with an on/off switch for every section (Stats Band, Why Choose Us, Principal\'s Message, Academic Excellence, Achievements, Facilities, Student Life, News & Events, Testimonials, Admissions CTA, Contact). Switch a section off and it disappears from the homepage immediately on save — its text and settings are kept, so switching it back on restores everything exactly as it was.', 'excellence-school' ); ?>
		</div>

		<div class="path" style="margin-top:12px">📍 <a href="<?php echo esc_url( $cz ); ?>" target="_blank"><?php esc_html_e( 'Customize → Stats & Numbers', 'excellence-school' ); ?></a></div>
		<p><?php esc_html_e( 'Board pass rate %, total students, and years of service shown in the hero mini-stats and the stats band section.', 'excellence-school' ); ?></p>

		<!-- ===== ABOUT PAGE ===== -->
		<h2><?php esc_html_e( '4. About Page', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $me . 'about' ); ?>"><?php esc_html_e( 'Page Content → About tab', 'excellence-school' ); ?></a></div>
		<table>
			<tr><th><?php esc_html_e( 'Section', 'excellence-school' ); ?></th><th><?php esc_html_e( 'What you can change', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'Page hero', 'excellence-school' ); ?></td><td><?php esc_html_e( 'H1 heading and subtitle', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Our Story', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Section heading, lead sentence, body paragraph', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Vision & Mission', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Vision statement and mission statement', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( '4 Core Values', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Label and description for each value', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( "Principal's Message", 'excellence-school' ); ?></td><td><?php esc_html_e( 'Quote and paragraph. Name & role → Customize → School Identity.', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Headline text', 'excellence-school' ); ?></td></tr>
		</table>
		<div class="path" style="margin-top:8px">📍 <?php esc_html_e( 'Principal photo → Customize → Principal Photo', 'excellence-school' ); ?></div>

		<!-- ===== ACADEMICS PAGE ===== -->
		<h2><?php esc_html_e( '5. Academics Page', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $me . 'academics' ); ?>"><?php esc_html_e( 'Page Content → Academics tab', 'excellence-school' ); ?></a></div>
		<table>
			<tr><th><?php esc_html_e( 'Section', 'excellence-school' ); ?></th><th><?php esc_html_e( 'What you can change', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'Page hero', 'excellence-school' ); ?></td><td><?php esc_html_e( 'H1 and subtitle', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( '3 Stream names', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Science / Commerce / Humanities stream names and 4 subjects each', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Our Approach cards', 'excellence-school' ); ?></td><td><?php esc_html_e( '3 card titles and descriptions', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Results bars', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Description text, and label + % for each of the 4 progress bars', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Facilities cards', 'excellence-school' ); ?></td><td><?php esc_html_e( '3 facility titles and descriptions', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Headline text', 'excellence-school' ); ?></td></tr>
		</table>

		<!-- ===== ADMISSIONS PAGE ===== -->
		<h2><?php esc_html_e( '6. Admissions Page', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $me . 'admissions' ); ?>"><?php esc_html_e( 'Page Content → Admissions tab', 'excellence-school' ); ?></a></div>
		<table>
			<tr><th><?php esc_html_e( 'Section', 'excellence-school' ); ?></th><th><?php esc_html_e( 'What you can change', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'Page hero subtitle', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The subtitle text below the heading', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( '4 How to Apply steps', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Step title and description for each step', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Eligibility table', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Class name and requirement text for each row', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Required documents', 'excellence-school' ); ?></td><td><?php esc_html_e( '6 document names in the checklist', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Important dates', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Month, day, title and description for each of 3 key dates', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'FAQs', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Question and answer for each of 6 FAQ entries', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Headline text', 'excellence-school' ); ?></td></tr>
		</table>

		<!-- ===== NAVIGATION ===== -->
		<h2><?php esc_html_e( '7. Navigation Menu', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $mn ); ?>" target="_blank"><?php esc_html_e( 'Appearance → Menus', 'excellence-school' ); ?></a></div>
		<p><?php esc_html_e( 'This is where you add, remove or reorder links in the top navigation bar and the mobile drawer.', 'excellence-school' ); ?></p>
		<ul>
			<li><?php esc_html_e( 'Create a menu and assign it to "Primary Menu" for the desktop nav.', 'excellence-school' ); ?></li>
			<li><?php esc_html_e( 'Assign the same (or a different) menu to "Mobile Drawer Menu" for the hamburger menu on phones.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Hindi translation of each link:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'open the nav item in the menu editor → find the "Description" field → type the Hindi text there.', 'excellence-school' ); ?></li>
			<li><?php esc_html_e( 'To add a new page to the menu: create the page via Pages → Add New, then come here and add it to the menu.', 'excellence-school' ); ?></li>
		</ul>

		<!-- ===== LOGO & IMAGES ===== -->
		<h2><?php esc_html_e( '8. Logo & Images', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $cz ); ?>" target="_blank"><?php esc_html_e( 'Appearance → Customize', 'excellence-school' ); ?></a></div>
		<table>
			<tr><th><?php esc_html_e( 'Image', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Where to upload', 'excellence-school' ); ?></th></tr>
			<tr><td><?php esc_html_e( 'School crest / logo', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Customize → Site Identity → Logo', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Hero background image', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Customize → Hero → Hero Background Image', 'excellence-school' ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Principal portrait', 'excellence-school' ); ?></td><td><?php esc_html_e( "Customize → Principal Photo", 'excellence-school' ); ?></td></tr>
		</table>

		<!-- ===== NEWS & EVENTS ===== -->
		<h2><?php esc_html_e( '9. News & Events', 'excellence-school' ); ?></h2>
		<div class="path">📍 <?php esc_html_e( 'wp-admin sidebar → News & Events → Add New', 'excellence-school' ); ?></div>
		<p><?php esc_html_e( 'Each news item has a title, content, featured image, event date and venue. Published items appear automatically in the News section on the homepage.', 'excellence-school' ); ?></p>

		<!-- ===== PHOTO GALLERY PAGE ===== -->
		<h2><?php esc_html_e( '10. Photo Gallery Page', 'excellence-school' ); ?></h2>
		<div class="path">📍 <?php esc_html_e( 'wp-admin sidebar → Pages → Gallery → Edit', 'excellence-school' ); ?></div>
		<p><?php esc_html_e( 'The photo gallery now lives on its own page (linked from the menu as "Gallery" / "गैलरी") instead of on the homepage. It is a normal WordPress page built with the block editor, using a "Gallery" template.', 'excellence-school' ); ?></p>
		<ul>
			<li><?php esc_html_e( 'Open the page and click on the photo grid — it is a single "Gallery" block.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Add a photo:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'click the gallery block, then the "+" / "Add" button inside it, and pick or upload an image from the Media Library.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Remove a photo:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'select the photo inside the gallery block and use its toolbar/options to remove it.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Reorder photos:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'drag a photo to a new position within the gallery block.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Captions:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'click below a photo inside the gallery block to add or edit its caption.', 'excellence-school' ); ?></li>
			<li><strong><?php esc_html_e( 'Intro text:', 'excellence-school' ); ?></strong> <?php esc_html_e( 'the short paragraph above the photos is a normal text block — edit it like any other text.', 'excellence-school' ); ?></li>
			<li><?php esc_html_e( 'Click "Update" to publish your changes — they appear on the live site immediately.', 'excellence-school' ); ?></li>
		</ul>
		<div class="note" style="margin-top:14px">
			<strong><?php esc_html_e( 'Menu link:', 'excellence-school' ); ?></strong>
			<?php esc_html_e( 'The "Gallery" link in the header, mobile drawer and footer points to this page. To rename, remove or reposition it, go to', 'excellence-school' ); ?>
			<a href="<?php echo esc_url( $mn ); ?>" target="_blank"><?php esc_html_e( 'Appearance → Menus', 'excellence-school' ); ?></a>.
		</div>

		<!-- ===== COLOURS & FONTS ===== -->
		<h2><?php esc_html_e( '11. Colours & Fonts', 'excellence-school' ); ?></h2>
		<div class="path">📍 <a href="<?php echo esc_url( $cz ); ?>" target="_blank"><?php esc_html_e( 'Customize → Appearance & Hero', 'excellence-school' ); ?></a></div>

		<div class="esb-guide-row">
			<div class="esb-guide-card">
				<h3><?php esc_html_e( 'Colour Palette', 'excellence-school' ); ?></h3>
				<p><?php esc_html_e( 'Pick from 5 ready-made colour schemes, shown as clickable swatch cards with a live preview of each palette\'s colours:', 'excellence-school' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Forest & Gold (default)', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Royal Navy & Gold', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Maroon & Copper', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Midnight Indigo & Gold', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Slate & Teal', 'excellence-school' ); ?></li>
				</ul>
			</div>
			<div class="esb-guide-card">
				<h3><?php esc_html_e( 'Font Pairing', 'excellence-school' ); ?></h3>
				<p><?php esc_html_e( 'Pick from 5 heading + body font combinations, shown as cards with a live text preview in each font:', 'excellence-school' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Classic Prestige (default)', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Modern Serif', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Elegant Scholar', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Academic', 'excellence-school' ); ?></li>
					<li><?php esc_html_e( 'Contemporary', 'excellence-school' ); ?></li>
				</ul>
			</div>
		</div>
		<div class="note" style="margin-top:14px">
			<?php esc_html_e( 'Click any swatch card or font card and then "Publish" to apply it across the whole site — header, buttons, headings and body text all update together. Use the Customizer\'s live preview (left side) to check how a palette or font pairing looks before publishing.', 'excellence-school' ); ?>
		</div>

		<div class="note" style="margin-top:24px">
			<strong><?php esc_html_e( 'Tip:', 'excellence-school' ); ?></strong>
			<?php esc_html_e( 'Every field on every tab of this Page Content panel has a placeholder showing the default text. If you leave a field blank, the default value is shown on the site.', 'excellence-school' ); ?>
		</div>

	</div>
	<?php
}
