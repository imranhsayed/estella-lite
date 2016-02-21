
<?php
/**
 * Tempate part used in index.php for showing flexslider
 * @package estella
 */

$slides = get_theme_mod( 'estella_slides', estella_default_slides() );

?>

<?php if( ! estella_mod( 'hide_slider' , false ) ) :  ?>

	<section id="slider" class="flexslider">
		<ul class='slides'>

		<?php if( is_array( $slides ) ) : foreach ( $slides as $slide ) : ?>

			<?php
				$slide_title       = isset( $slide['title'] ) ? $slide['title'] : false;
				$slide_link        = isset( $slide['link'] ) ? $slide['link'] : false;
				$slide_image       = isset( $slide['image'] ) ? $slide['image'] : false;
				$slide_description = isset( $slide['description'] ) ? $slide['description'] : false;

			if( ! trim( $slide_image ) ) continue; ?>

			<li>
				<a href='<?php echo esc_url( $slide_link ); ?>'>
					<img src='<?php echo esc_url( $slide_image ); ?>' alt='image'>
					<?php if( $slide_title || $slide_description ) { ?>
					<div class='estella-slider-content animated slideInUp'>
						<div class="estella-slider-content-wrapper">
							<h6 class="estella-slider-title"><?php echo esc_attr( $slide_title ); ?></h6>
							<p class="estella-slider-description"><?php echo esc_attr( $slide_description ); ?></p>
						</div>
					</div>
					<?php } ?>
				</a>
			</li>

		<?php endforeach; endif; ?>

		</ul>
	</section>

	<section id="carousel" class="flexslider">
		<ul class='slides'>

		<?php if( is_array( $slides ) ) : foreach ( $slides as $slide ) : ?>

			<?php
				$slide_title       = isset( $slide['title'] ) ? $slide['title'] : false;
				$slide_link        = isset( $slide['link'] ) ? $slide['link'] : false;
				$slide_image       = isset( $slide['image'] ) ? $slide['image'] : false;
				$slide_description = isset( $slide['description'] ) ? $slide['description'] : false;

			if( ! trim( $slide_image ) ) continue; ?>

			<li>
				<a href='<?php echo esc_url( $slide_link ); ?>'>
					<img src='<?php echo esc_url( $slide_image ); ?>' alt='image'>
				</a>
			</li>

		<?php endforeach; endif; ?>

		</ul>
	</section>

<?php endif; ?>