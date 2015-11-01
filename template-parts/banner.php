
<?php
/**
 * Tempate part used in index.php for showing flexslider
 * @package estella
 */

$estella_default_slides =  array(

        array
            (
				'title'       => __('The Supermodel', 'estella'),
				'link' 		  => '',
				'description' => __('Style Icon', 'estella'),
				'image'       => get_template_directory_uri() . '/images/slides/slide3.jpg',
            ),
        array
            (
				'title'       => __('Summer Shades', 'estella'),
				'link' 		  => '',
				'description' => __('Style icon', 'estella'),
				'image'       => get_template_directory_uri() . '/images/slides/slide2.jpg',
            ),
        array
            (
				'title'       => __('Sun bathing', 'estella'),
				'link' 		  => '',
				'description' => __('Style Icon', 'estella'),
				'image'       => get_template_directory_uri() . '/images/slides/slide1.jpg',
            )
         );

$slides = get_theme_mod( 'estella_slides', $estella_default_slides );

?>

<div id="estella-main-slider" class="clear">
	<section id="slider" class="flexslider">
		<ul class='slides'>

		<?php if( is_array( $slides ) ) : foreach ( $slides as $slide ) : ?>

			<li>
				<a href='<?php echo esc_url( $slide['link'] ); ?>'>
					<img src='<?php echo esc_url( $slide['image'] ); ?>' alt='image'>
					
					<div class='estella-slider-content'>
					<div class="wrapper">
						<?php $title = isset( $slide['title'] ) ? $slide['title'] : '' ?>
						<?php $description = isset($slide['description']) ? $slide['description'] : '' ?>
						<h2><?php echo esc_attr($title); ?></h2>
						<br>
						<p><?php echo esc_attr( $description ); ?></p>
					</div>
					</div>
					
				</a>
			</li>

		<?php endforeach; endif; ?>

		</ul>
	</section>
</div>