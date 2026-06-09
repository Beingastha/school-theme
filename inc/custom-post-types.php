<?php
/**
 * Custom Post Types — News, Achievements, Testimonials, Facilities, Gallery
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'esb_register_post_types' );
function esb_register_post_types(): void {

	/* ---- News & Events ---- */
	register_post_type(
		'esb_news',
		[
			'labels'       => [
				'name'          => esc_html__( 'News & Events', 'excellence-school' ),
				'singular_name' => esc_html__( 'News Item', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add News Item', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit News Item', 'excellence-school' ),
			],
			'public'       => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'  => 'news',
			'rewrite'      => [ 'slug' => 'news' ],
			'menu_icon'    => 'dashicons-megaphone',
		]
	);

	/* ---- Achievements ---- */
	register_post_type(
		'esb_achievement',
		[
			'labels'       => [
				'name'          => esc_html__( 'Achievements', 'excellence-school' ),
				'singular_name' => esc_html__( 'Achievement', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Achievement', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Achievement', 'excellence-school' ),
			],
			'public'       => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'  => false,
			'rewrite'      => [ 'slug' => 'achievements' ],
			'menu_icon'    => 'dashicons-awards',
		]
	);

	/* ---- Testimonials ---- */
	register_post_type(
		'esb_testimonial',
		[
			'labels'       => [
				'name'          => esc_html__( 'Testimonials', 'excellence-school' ),
				'singular_name' => esc_html__( 'Testimonial', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Testimonial', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'excellence-school' ),
			],
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor' ],
			'menu_icon'    => 'dashicons-format-quote',
		]
	);

	/* ---- Facilities ---- */
	register_post_type(
		'esb_facility',
		[
			'labels'       => [
				'name'          => esc_html__( 'Facilities', 'excellence-school' ),
				'singular_name' => esc_html__( 'Facility', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Facility', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Facility', 'excellence-school' ),
			],
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'menu_icon'    => 'dashicons-building',
		]
	);

	/* ---- Gallery ---- */
	register_post_type(
		'esb_gallery',
		[
			'labels'       => [
				'name'          => esc_html__( 'Gallery Photos', 'excellence-school' ),
				'singular_name' => esc_html__( 'Gallery Photo', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Gallery Photo', 'excellence-school' ),
			],
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'thumbnail' ],
			'menu_icon'    => 'dashicons-format-gallery',
		]
	);
}

add_action( 'init', 'esb_register_taxonomies' );
function esb_register_taxonomies(): void {
	register_taxonomy(
		'esb_achievement_cat',
		'esb_achievement',
		[
			'labels'       => [
				'name'          => esc_html__( 'Achievement Categories', 'excellence-school' ),
				'singular_name' => esc_html__( 'Category', 'excellence-school' ),
			],
			'hierarchical' => false,
			'show_in_rest' => true,
			'rewrite'      => [ 'slug' => 'achievement-category' ],
		]
	);

	register_taxonomy(
		'esb_facility_tag',
		'esb_facility',
		[
			'labels'       => [
				'name'          => esc_html__( 'Facility Tags', 'excellence-school' ),
				'singular_name' => esc_html__( 'Tag', 'excellence-school' ),
			],
			'hierarchical' => false,
			'show_in_rest' => true,
		]
	);
}

/* ---- Custom meta boxes ---- */
add_action( 'add_meta_boxes', 'esb_add_meta_boxes' );
function esb_add_meta_boxes(): void {
	add_meta_box(
		'esb_testimonial_meta',
		esc_html__( 'Testimonial Details', 'excellence-school' ),
		'esb_render_testimonial_meta',
		'esb_testimonial',
		'normal',
		'high'
	);

	add_meta_box(
		'esb_achievement_meta',
		esc_html__( 'Achievement Details', 'excellence-school' ),
		'esb_render_achievement_meta',
		'esb_achievement',
		'normal',
		'high'
	);

	add_meta_box(
		'esb_facility_meta',
		esc_html__( 'Facility Details', 'excellence-school' ),
		'esb_render_facility_meta',
		'esb_facility',
		'normal',
		'high'
	);

	add_meta_box(
		'esb_gallery_meta',
		esc_html__( 'Gallery Options', 'excellence-school' ),
		'esb_render_gallery_meta',
		'esb_gallery',
		'normal',
		'high'
	);
}

function esb_render_testimonial_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_testimonial_meta_save', 'esb_testimonial_meta_nonce' );
	$author_name = get_post_meta( $post->ID, '_esb_author_name', true );
	$author_role = get_post_meta( $post->ID, '_esb_author_role', true );
	$initials    = get_post_meta( $post->ID, '_esb_initials', true );
	?>
	<p>
		<label for="esb_author_name"><strong><?php esc_html_e( 'Author Name', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_author_name" name="esb_author_name" value="<?php echo esc_attr( $author_name ); ?>" class="widefat" />
	</p>
	<p>
		<label for="esb_author_role"><strong><?php esc_html_e( 'Role / Batch (e.g. Alumni, Batch 2022)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_author_role" name="esb_author_role" value="<?php echo esc_attr( $author_role ); ?>" class="widefat" />
	</p>
	<p>
		<label for="esb_initials"><strong><?php esc_html_e( 'Initials (e.g. AS)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_initials" name="esb_initials" value="<?php echo esc_attr( $initials ); ?>" class="widefat" maxlength="3" />
	</p>
	<?php
}

function esb_render_achievement_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_achievement_meta_save', 'esb_achievement_meta_nonce' );
	$label = get_post_meta( $post->ID, '_esb_badge_label', true );
	?>
	<p>
		<label for="esb_badge_label"><strong><?php esc_html_e( 'Badge Label (e.g. State Champion)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_badge_label" name="esb_badge_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" />
	</p>
	<?php
}

function esb_render_facility_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_facility_meta_save', 'esb_facility_meta_nonce' );
	$tag = get_post_meta( $post->ID, '_esb_fac_tag', true );
	?>
	<p>
		<label for="esb_fac_tag"><strong><?php esc_html_e( 'Facility Tag (e.g. STEM, Innovation, Sports)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_fac_tag" name="esb_fac_tag" value="<?php echo esc_attr( $tag ); ?>" class="widefat" />
	</p>
	<?php
}

function esb_render_gallery_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_gallery_meta_save', 'esb_gallery_meta_nonce' );
	$span = get_post_meta( $post->ID, '_esb_gallery_span', true );
	?>
	<p>
		<label for="esb_gallery_span"><strong><?php esc_html_e( 'Grid Span', 'excellence-school' ); ?></strong></label><br>
		<select id="esb_gallery_span" name="esb_gallery_span" class="widefat">
			<option value="normal" <?php selected( $span, 'normal' ); ?>><?php esc_html_e( 'Normal (1×1)', 'excellence-school' ); ?></option>
			<option value="tall" <?php selected( $span, 'tall' ); ?>><?php esc_html_e( 'Tall (1×2)', 'excellence-school' ); ?></option>
		</select>
	</p>
	<?php
}

add_action( 'save_post', 'esb_save_meta_boxes' );
function esb_save_meta_boxes( int $post_id ): void {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	/* Testimonial meta */
	if ( isset( $_POST['esb_testimonial_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_testimonial_meta_nonce'] ) ), 'esb_testimonial_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_author_name', sanitize_text_field( wp_unslash( $_POST['esb_author_name'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_author_role', sanitize_text_field( wp_unslash( $_POST['esb_author_role'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_initials',    sanitize_text_field( wp_unslash( $_POST['esb_initials'] ?? '' ) ) );
	}

	/* Achievement meta */
	if ( isset( $_POST['esb_achievement_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_achievement_meta_nonce'] ) ), 'esb_achievement_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_badge_label', sanitize_text_field( wp_unslash( $_POST['esb_badge_label'] ?? '' ) ) );
	}

	/* Facility meta */
	if ( isset( $_POST['esb_facility_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_facility_meta_nonce'] ) ), 'esb_facility_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_fac_tag', sanitize_text_field( wp_unslash( $_POST['esb_fac_tag'] ?? '' ) ) );
	}

	/* Gallery meta */
	if ( isset( $_POST['esb_gallery_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_gallery_meta_nonce'] ) ), 'esb_gallery_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		$allowed_spans = [ 'normal', 'tall' ];
		$span = sanitize_key( wp_unslash( $_POST['esb_gallery_span'] ?? 'normal' ) );
		update_post_meta( $post_id, '_esb_gallery_span', in_array( $span, $allowed_spans, true ) ? $span : 'normal' );
	}
}
