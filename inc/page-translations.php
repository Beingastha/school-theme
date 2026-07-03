<?php
/**
 * Hindi Translation meta box for generic pages (page.php template).
 *
 * Adds a "Hindi Translation" box to the Page editor with a Hindi title and
 * Hindi body field, stored as post meta. page.php outputs both languages
 * via the data-lang-show pattern so the EN/HI toggle can switch them.
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

add_action( 'add_meta_boxes', 'esb_add_hindi_meta_box' );
function esb_add_hindi_meta_box(): void {
	add_meta_box(
		'esb_hindi_translation',
		esc_html__( 'Hindi Translation', 'excellence-school' ),
		'esb_render_hindi_meta_box',
		'page',
		'normal',
		'high'
	);
}

function esb_render_hindi_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'esb_save_hindi_translation', 'esb_hindi_nonce' );
	$title_hi   = get_post_meta( $post->ID, '_esb_title_hi', true );
	$content_hi = get_post_meta( $post->ID, '_esb_content_hi', true );
	?>
	<p>
		<label for="esb_title_hi"><strong><?php esc_html_e( 'Hindi Title', 'excellence-school' ); ?></strong></label><br>
		<input type="text" id="esb_title_hi" name="esb_title_hi" value="<?php echo esc_attr( $title_hi ); ?>" style="width:100%;margin-top:6px" />
	</p>
	<p style="margin-top:16px"><strong><?php esc_html_e( 'Hindi Content', 'excellence-school' ); ?></strong></p>
	<?php
	wp_editor(
		$content_hi,
		'esb_content_hi',
		[
			'textarea_name' => 'esb_content_hi',
			'textarea_rows' => 16,
			'media_buttons' => false,
		]
	);
	?>
	<p class="description" style="margin-top:10px">
		<?php esc_html_e( 'Optional. Leave blank to keep showing the English content when the site is switched to Hindi.', 'excellence-school' ); ?>
	</p>
	<?php
}

add_action( 'save_post_page', 'esb_save_hindi_meta_box' );
function esb_save_hindi_meta_box( int $post_id ): void {
	if ( ! isset( $_POST['esb_hindi_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['esb_hindi_nonce'] ), 'esb_save_hindi_translation' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['esb_title_hi'] ) ) {
		update_post_meta( $post_id, '_esb_title_hi', sanitize_text_field( wp_unslash( $_POST['esb_title_hi'] ) ) );
	}
	if ( isset( $_POST['esb_content_hi'] ) ) {
		update_post_meta( $post_id, '_esb_content_hi', wp_kses_post( wp_unslash( $_POST['esb_content_hi'] ) ) );
	}
}
