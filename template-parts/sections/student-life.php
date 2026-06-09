<?php
/**
 * Student Life mosaic section
 *
 * @package excellence-school
 */
$tiles = [
	[ 'class' => 'big',  'en' => 'Annual Day',   'hi' => 'वार्षिकोत्सव', 'label' => 'annual-day.jpg' ],
	[ 'class' => '',     'en' => 'NCC',           'hi' => 'एनसीसी',       'label' => 'ncc-parade.jpg' ],
	[ 'class' => '',     'en' => 'Debate',        'hi' => 'वाद-विवाद',    'label' => 'debate.jpg' ],
	[ 'class' => 'wide', 'en' => 'Science Fair',  'hi' => 'विज्ञान मेला', 'label' => 'science-fair.jpg' ],
	[ 'class' => '',     'en' => 'Cultural',      'hi' => 'सांस्कृतिक',  'label' => 'cultural.jpg' ],
	[ 'class' => '',     'en' => 'Sports Meet',   'hi' => 'खेलकूद',       'label' => 'sports-meet.jpg' ],
];
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
			<?php foreach ( $tiles as $tile ) : 
				$mapped_file = match( $tile['label'] ) {
					'annual-day.jpg'   => 'cultural',
					'ncc-parade.jpg'   => 'teachers-group',
					'debate.jpg'       => 'teacher',
					'science-fair.jpg' => 'academics-lab',
					'cultural.jpg'     => 'cultural',
					'sports-meet.jpg'  => 'sports',
					default            => '',
				};
				$img_url = $mapped_file ? esb_get_image_url_by_filename( $mapped_file ) : '';
			?>
			<div class="life-tile<?php echo $tile['class'] ? ' ' . esc_attr( $tile['class'] ) : ''; ?>">
				<div class="ov"></div>
				<?php if ( $img_url ) : ?>
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $tile['en'] ); ?>" style="object-fit:cover; width:100%; height:100%;" />
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
