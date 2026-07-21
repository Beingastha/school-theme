<?php
/**
 * Custom Post Types — News, Achievements, Testimonials, Facilities, Circulars
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
			'public'       => true,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'  => false,
			'rewrite'      => [ 'slug' => 'facility' ],
			'menu_icon'    => 'dashicons-building',
		]
	);

	/* ---- Staff ---- */
	register_post_type(
		'esb_staff',
		[
			'labels'       => [
				'name'          => esc_html__( 'Staff', 'excellence-school' ),
				'singular_name' => esc_html__( 'Staff Member', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Staff Member', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Staff Member', 'excellence-school' ),
			],
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'thumbnail', 'page-attributes' ],
			'menu_icon'    => 'dashicons-groups',
		]
	);

	/* ---- Circulars & Notices ---- */
	register_post_type(
		'esb_circular',
		[
			'labels'       => [
				'name'          => esc_html__( 'Circulars & Notices', 'excellence-school' ),
				'singular_name' => esc_html__( 'Circular', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Circular', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Circular', 'excellence-school' ),
			],
			'public'       => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor' ],
			'has_archive'  => 'circulars',
			'rewrite'      => [ 'slug' => 'circulars' ],
			'menu_icon'    => 'dashicons-media-document',
		]
	);

	/* ---- Why Choose Us ---- */
	register_post_type(
		'esb_feature',
		[
			'labels'       => [
				'name'          => esc_html__( 'Why Choose Us', 'excellence-school' ),
				'singular_name' => esc_html__( 'Feature Card', 'excellence-school' ),
				'add_new_item'  => esc_html__( 'Add Feature Card', 'excellence-school' ),
				'edit_item'     => esc_html__( 'Edit Feature Card', 'excellence-school' ),
			],
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'page-attributes' ],
			'menu_icon'    => 'dashicons-star-filled',
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
		'esb_feature_meta',
		esc_html__( 'Hindi Translation', 'excellence-school' ),
		'esb_render_feature_meta',
		'esb_feature',
		'normal',
		'high'
	);

	add_meta_box(
		'esb_staff_meta',
		esc_html__( 'Staff Details', 'excellence-school' ),
		'esb_render_staff_meta',
		'esb_staff',
		'normal',
		'high'
	);

	add_meta_box(
		'esb_circular_meta',
		esc_html__( 'Circular Details', 'excellence-school' ),
		'esb_render_circular_meta',
		'esb_circular',
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

function esb_render_feature_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_feature_meta_save', 'esb_feature_meta_nonce' );
	$title_hi = get_post_meta( $post->ID, '_esb_feature_title_hi', true );
	$desc_hi  = get_post_meta( $post->ID, '_esb_feature_desc_hi', true );
	?>
	<p>
		<label for="esb_feature_title_hi"><strong><?php esc_html_e( 'Hindi Title', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_feature_title_hi" name="esb_feature_title_hi" value="<?php echo esc_attr( $title_hi ); ?>" class="widefat" />
	</p>
	<p>
		<label for="esb_feature_desc_hi"><strong><?php esc_html_e( 'Hindi Description', 'excellence-school' ); ?></strong></label><br>
		<textarea id="esb_feature_desc_hi" name="esb_feature_desc_hi" class="widefat" rows="3"><?php echo esc_textarea( $desc_hi ); ?></textarea>
	</p>
	<?php
}

function esb_render_staff_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_staff_meta_save', 'esb_staff_meta_nonce' );
	$name_hi  = get_post_meta( $post->ID, '_esb_staff_name_hi', true );
	$role     = get_post_meta( $post->ID, '_esb_staff_role', true );
	$role_hi  = get_post_meta( $post->ID, '_esb_staff_role_hi', true );
	$qual     = get_post_meta( $post->ID, '_esb_staff_qualification', true );
	$qual_hi  = get_post_meta( $post->ID, '_esb_staff_qualification_hi', true );
	?>
	<p>
		<label for="esb_staff_name_hi"><strong><?php esc_html_e( 'Name (Hindi)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_staff_name_hi" name="esb_staff_name_hi" value="<?php echo esc_attr( $name_hi ); ?>" class="widefat" />
	</p>
	<p>
		<label for="esb_staff_role"><strong><?php esc_html_e( 'Designation (English)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_staff_role" name="esb_staff_role" value="<?php echo esc_attr( $role ); ?>" class="widefat" placeholder="e.g. LECTURER (MATHEMATICS)" />
	</p>
	<p>
		<label for="esb_staff_role_hi"><strong><?php esc_html_e( 'Designation (Hindi)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_staff_role_hi" name="esb_staff_role_hi" value="<?php echo esc_attr( $role_hi ); ?>" class="widefat" />
	</p>
	<p>
		<label for="esb_staff_qualification"><strong><?php esc_html_e( 'Qualification (English)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_staff_qualification" name="esb_staff_qualification" value="<?php echo esc_attr( $qual ); ?>" class="widefat" placeholder="e.g. M.Sc. B.Ed." />
	</p>
	<p>
		<label for="esb_staff_qualification_hi"><strong><?php esc_html_e( 'Qualification (Hindi)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_staff_qualification_hi" name="esb_staff_qualification_hi" value="<?php echo esc_attr( $qual_hi ); ?>" class="widefat" />
	</p>
	<?php
}

function esb_render_circular_meta( WP_Post $post ): void {
	wp_nonce_field( 'esb_circular_meta_save', 'esb_circular_meta_nonce' );
	$ref_no   = get_post_meta( $post->ID, '_esb_circular_no', true );
	$file_url = get_post_meta( $post->ID, '_esb_circular_file', true );
	?>
	<p>
		<label for="esb_circular_no"><strong><?php esc_html_e( 'Circular / Notice No. (optional)', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_circular_no" name="esb_circular_no" value="<?php echo esc_attr( $ref_no ); ?>" class="widefat" placeholder="e.g. SES/2026/014" />
	</p>
	<p>
		<label for="esb_circular_file"><strong><?php esc_html_e( 'Attached PDF / Document URL (optional)', 'excellence-school' ); ?></strong></label><br>
		<input type="url" id="esb_circular_file" name="esb_circular_file" value="<?php echo esc_attr( $file_url ); ?>" class="widefat" placeholder="https://..." />
		<span class="description"><?php esc_html_e( 'Upload the file to the Media Library, then paste its URL here. If left blank, the circular links to its own page.', 'excellence-school' ); ?></span>
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

	/* Feature/WCU meta */
	if ( isset( $_POST['esb_feature_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_feature_meta_nonce'] ) ), 'esb_feature_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_feature_title_hi', sanitize_text_field( wp_unslash( $_POST['esb_feature_title_hi'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_feature_desc_hi',  sanitize_textarea_field( wp_unslash( $_POST['esb_feature_desc_hi'] ?? '' ) ) );
	}

	/* Staff meta */
	if ( isset( $_POST['esb_staff_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_staff_meta_nonce'] ) ), 'esb_staff_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_staff_name_hi', sanitize_text_field( wp_unslash( $_POST['esb_staff_name_hi'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_staff_role', sanitize_text_field( wp_unslash( $_POST['esb_staff_role'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_staff_role_hi', sanitize_text_field( wp_unslash( $_POST['esb_staff_role_hi'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_staff_qualification', sanitize_text_field( wp_unslash( $_POST['esb_staff_qualification'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_staff_qualification_hi', sanitize_text_field( wp_unslash( $_POST['esb_staff_qualification_hi'] ?? '' ) ) );
	}

	/* Circular meta */
	if ( isset( $_POST['esb_circular_meta_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['esb_circular_meta_nonce'] ) ), 'esb_circular_meta_save' ) &&
		current_user_can( 'edit_post', $post_id )
	) {
		update_post_meta( $post_id, '_esb_circular_no', sanitize_text_field( wp_unslash( $_POST['esb_circular_no'] ?? '' ) ) );
		update_post_meta( $post_id, '_esb_circular_file', esc_url_raw( wp_unslash( $_POST['esb_circular_file'] ?? '' ) ) );
	}
}
