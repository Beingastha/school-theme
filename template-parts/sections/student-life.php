<?php
/**
 * Student Life mosaic section
 *
 * @package excellence-school
 */
$tiles = [];
$tile_classes = [ 1 => 'big', 2 => '', 3 => '', 4 => 'wide', 5 => '', 6 => '' ];
$default_names_en = [ 1 => 'Annual Day',   2 => 'NCC',          3 => 'Debate',       4 => 'Science Fair', 5 => 'Cultural',     6 => 'Sports Meet' ];
$default_names_hi = [ 1 => 'वार्षिकोत्सव', 2 => 'एनसीसी',       3 => 'वाद-विवाद',    4 => 'विज्ञान मेला', 5 => 'सांस्कृतिक',  6 => 'खेलकूद' ];
$default_labels   = [ 1 => 'annual-day.jpg', 2 => 'ncc-parade.jpg', 3 => 'debate.jpg', 4 => 'science-fair.jpg', 5 => 'cultural.jpg', 6 => 'sports-meet.jpg' ];
$mapped_files     = [ 1 => 'cultural', 2 => 'teachers-group', 3 => 'teacher', 4 => 'academics-lab', 5 => 'cultural', 6 => 'sports' ];

for ( $i = 1; $i <= 6; $i++ ) {
	$custom_img_id  = (int) esb_opt( "esb_student_life_img_{$i}", '0' );
	$custom_img_url = $custom_img_id ? wp_get_attachment_image_url( $custom_img_id, 'large' ) : '';

	// Fallback to old mapping if no custom image is uploaded
	if ( ! $custom_img_url ) {
		$fallback_slug  = $mapped_files[$i];
		$custom_img_url = $fallback_slug ? esb_get_image_url_by_filename( $fallback_slug ) : '';
	}

	$tiles[] = [
		'class'   => $tile_classes[$i],
		'en'      => esb_opt( "esb_student_life_lbl_{$i}_en", $default_names_en[$i] ),
		'hi'      => esb_opt( "esb_student_life_lbl_{$i}_hi", $default_names_hi[$i] ),
		'img_url' => $custom_img_url,
		'label'   => $default_labels[$i],
	];
}
?>
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow" data-en="Student Life &amp; Activities" data-hi="विद्यार्थी जीवन व गतिविधियां">
				<?php esc_html_e( 'Student Life & Activities', 'excellence-school' ); ?>
			</span>
			<h2 data-en="A Campus That's Always Alive" data-hi="एक सदा जीवंत परिसर">
				<?php esc_html_e( "A Campus That's Always Alive", 'excellence-school' ); ?>
			</h2>
		</div>
		<div class="life-grid reveal">
			<?php foreach ( $tiles as $tile ) : ?>
			<div class="life-tile<?php echo $tile['class'] ? ' ' . esc_attr( $tile['class'] ) : ''; ?>">
				<div class="ov"></div>
				<?php if ( $tile['img_url'] ) : ?>
					<img src="<?php echo esc_url( $tile['img_url'] ); ?>" alt="<?php echo esc_attr( $tile['en'] ); ?>" style="object-fit:cover; width:100%; height:100%;" />
				<?php else : ?>
					<div class="ph" data-label="<?php echo esc_attr( $tile['label'] ); ?>"></div>
				<?php endif; ?>
				<span class="cap" data-en="<?php echo esc_attr( $tile['en'] ); ?>" data-hi="<?php echo esc_attr( $tile['hi'] ); ?>">
					<?php echo esc_html( $tile['en'] ); ?>
				</span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
