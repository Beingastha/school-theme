<?php
/**
 * Principal's Message section
 *
 * @package excellence-school
 */
$principal_name  = esb_opt( 'esb_principal_name', 'Dr. (Mrs.) Anjali Verma' );
$principal_role  = esb_opt( 'esb_principal_role', 'Principal, School for Excellence, Bhopal' );
$principal_quote = esb_opt( 'esb_principal_quote', 'Our mission is simple — to ensure that every child who walks through our gates leaves with the knowledge, character and confidence to lead. Excellence here is not a privilege; it is a promise we keep to every family.' );
$portrait_id     = (int) get_theme_mod( 'esb_principal_image', 0 );
$portrait_url    = $portrait_id ? wp_get_attachment_image_url( $portrait_id, 'large' ) : '';
?>
<section class="section principal">
	<div class="container">
		<div class="grid2">
			<div class="portrait reveal">
				<?php if ( $portrait_url ) : ?>
					<img class="portrait-img" src="<?php echo esc_url( $portrait_url ); ?>"
					     alt="<?php echo esc_attr( $principal_name ); ?>" />
				<?php else : ?>
					<div class="ph" data-label="principal-portrait.jpg — 600×760"></div>
				<?php endif; ?>
				<div class="seal">
					<?php esb_logo(); ?>
				</div>
			</div>
			<div class="reveal">
				<span class="eyebrow" data-en="Principal's Message" data-hi="प्राचार्य का संदेश">
					<?php esc_html_e( "Principal's Message", 'excellence-school' ); ?>
				</span>
				<span class="quote-mark">"</span>
				<blockquote data-en="<?php echo esc_attr( $principal_quote ); ?>"
				            data-hi="">
					<?php echo esc_html( $principal_quote ); ?>
				</blockquote>
				<div class="signoff">
					<div class="nm" data-en="<?php echo esc_attr( $principal_name ); ?>">
						<?php echo esc_html( $principal_name ); ?>
					</div>
					<div class="rl" data-en="<?php echo esc_attr( $principal_role ); ?>">
						<?php echo esc_html( $principal_role ); ?>
					</div>
				</div>
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>"
				   class="btn btn-outline"
				   style="margin-top:28px"
				   data-en="Read Full Message" data-hi="पूरा संदेश पढ़ें">
					<?php esc_html_e( 'Read Full Message', 'excellence-school' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
