<?php
/**
 * Custom visual Customizer controls — palette swatches & font previews.
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

/*
 * WP_Customize_Control only exists when the Customizer classes have been
 * loaded (admin / customize.php requests). Guard the class declarations so
 * this file can be safely required on every front-end request too.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Visual swatch-grid control for colour palette selection.
 */
class ESB_Palette_Control extends WP_Customize_Control {
	public $type = 'esb_palette';

	public function render_content(): void {
		if ( empty( $this->choices ) ) {
			return;
		}
		?>
		<label class="esb-control-label">
			<?php if ( $this->label ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( $this->description ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</label>
		<div class="esb-palette-grid">
			<?php foreach ( $this->choices as $value => $data ) :
				$checked = ( (string) $this->value() === (string) $value );
				?>
				<label class="esb-palette-card<?php echo $checked ? ' is-selected' : ''; ?>">
					<input type="radio"
						value="<?php echo esc_attr( $value ); ?>"
						name="<?php echo esc_attr( $this->id ); ?>"
						<?php $this->link(); checked( $checked ); ?> />
					<span class="esb-swatch-row">
						<?php foreach ( $data['swatches'] as $color ) : ?>
							<span class="esb-swatch" style="background:<?php echo esc_attr( $color ); ?>"></span>
						<?php endforeach; ?>
					</span>
					<span class="esb-palette-name"><?php echo esc_html( $data['label'] ); ?></span>
					<span class="esb-palette-desc"><?php echo esc_html( $data['desc'] ); ?></span>
					<span class="esb-check" aria-hidden="true">✓</span>
				</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

/**
 * Visual font-pairing preview control.
 */
class ESB_Font_Control extends WP_Customize_Control {
	public $type = 'esb_font';

	public function render_content(): void {
		if ( empty( $this->choices ) ) {
			return;
		}
		?>
		<label class="esb-control-label">
			<?php if ( $this->label ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( $this->description ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</label>
		<div class="esb-font-list">
			<?php foreach ( $this->choices as $value => $data ) :
				$checked = ( (string) $this->value() === (string) $value );
				?>
				<label class="esb-font-card<?php echo $checked ? ' is-selected' : ''; ?>">
					<input type="radio"
						value="<?php echo esc_attr( $value ); ?>"
						name="<?php echo esc_attr( $this->id ); ?>"
						<?php $this->link(); checked( $checked ); ?> />
					<span class="esb-font-heading" style="font-family:<?php echo esc_attr( $data['display'] ); ?>"><?php echo esc_html( $data['sample'] ); ?></span>
					<span class="esb-font-body" style="font-family:<?php echo esc_attr( $data['body'] ); ?>"><?php echo esc_html( $data['body_sample'] ); ?></span>
					<span class="esb-font-name"><?php echo esc_html( $data['label'] ); ?></span>
					<span class="esb-check" aria-hidden="true">✓</span>
				</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

/**
 * Enqueue admin CSS + Google Fonts (for live previews) on the Customizer screen.
 */
add_action( 'customize_controls_enqueue_scripts', 'esb_customizer_controls_assets' );
function esb_customizer_controls_assets(): void {
	wp_enqueue_style(
		'esb-customizer-fonts-preview',
		'https://fonts.googleapis.com/css2?' . implode( '&', [
			'family=Playfair+Display:wght@700',
			'family=Plus+Jakarta+Sans:wght@400;600',
			'family=DM+Serif+Display',
			'family=DM+Sans:wght@400;600',
			'family=Cormorant+Garamond:wght@700',
			'family=Lato:wght@400;700',
			'family=EB+Garamond:wght@700',
			'family=Source+Sans+3:wght@400;600',
			'family=Fraunces:wght@700',
			'family=Nunito:wght@400;600',
		] ) . '&display=swap',
		[],
		ESB_VERSION
	);

	wp_enqueue_style(
		'esb-customizer-controls',
		ESB_URI . '/assets/css/customizer-controls.css',
		[],
		ESB_VERSION
	);
}
