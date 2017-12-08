<?php
/**
 * Template: Single Product Thumbnails
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $post, $product, $woocommerce;

if( WC_VERSION >= 3.0 ) {
	$attachment_ids = $product->get_gallery_image_ids();
} else {
	$attachment_ids = $product->get_gallery_attachment_ids();
}
if ( ! empty( $attachment_ids ) ) array_unshift( $attachment_ids, get_post_thumbnail_id() );

if ( $attachment_ids ) {
    ?><div class="jcarousel-wrapper">
		<div class="jcarousel" id="woozoom-gallery"> 
			<ul>
				<?php
					foreach ( $attachment_ids as $attachment_id ) {
						//Main Image
						$main_image_full  = wp_get_attachment_image_src( $attachment_id, 'full' );
			
						$main_image_size = get_option('woozoom_main_image_size');
						if( $main_image_size['width'] > 0 && $main_image_size['height'] > 0 ) {
							$image_src = ! empty( $main_image_full[0] ) ? $main_image_full[0] : false;
			
							$args = apply_filters( 'woozoom_main_image_args',
								array(
									'position' => 'c',
									'width'    => $main_image_size['width'],
									'height'   => $main_image_size['height'],
									'quality'  => 100,
									'retina'   => false
								)
							);
					
							$woozoom_resizer = new WOOZOOm_Resizer();
							$main_image = $woozoom_resizer->resize_image( 
								$image_src,
								$args['width'],
								$args['height'],
								false,
								$args['position'],
								$args['quality'],
								$args['retina']
							);
						} else {
							$main_image = $main_image_full[0];
						}
						
						
						//Thumb Image
						$thumb_image_full  = wp_get_attachment_image_src( $attachment_id, 'small' );						
						if( !empty($thumb_image_full) ) {
							$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
							$image_description 	= esc_attr( get_post_field( 'post_content', $attachment_id ) );
							
							$thumb_image_size = get_option('woozoom_thumb_image_size');
							if( $thumb_image_size['width'] > 0 && $thumb_image_size['height'] > 0 ) {
								$image_src = ! empty( $thumb_image_full[0] ) ? $thumb_image_full[0] : false;
			
								$args = apply_filters( 'woozoom_thumb_image_args',
									array(
										'position' => 'c',
										'width'    => $thumb_image_size['width'],
										'height'   => $thumb_image_size['height'],
										'quality'  => 100,
										'retina'   => false
									)
								);
					
								$woozoom_resizer = new WOOZOOm_Resizer();
								$thumb_image = $woozoom_resizer->resize_image( 
									$image_src,
									$args['width'],
									$args['height'],
									false,
									$args['position'],
									$args['quality'],
									$args['retina']
								);
							} else {
								$thumb_image = $thumb_image_full[0];
							}
							
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" title="%s" data-description="%s" data-rel="prettyPhoto[product-gallery]" data-image="%s" data-zoom-image="%s"><img src="%s" class="product-img" alt="" /></a></li>', $main_image_full[0], $image_caption, $image_description, $main_image, $main_image_full[0], $thumb_image ), $attachment_id, $post->ID );
						}
					}
					
					$featured_video	=	get_post_meta($post->ID, 'featured_video');					
					
					if(!empty($featured_video[0])){
						$attachment_ids[]	=	$featured_video[0];
						$parsed = parse_url( wp_get_attachment_url( $featured_video[0] ) );
						$video_url    = dirname( $parsed [ 'path' ] ) . '/' . rawurlencode( basename( $parsed[ 'path' ] ) );
						
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" class="product-video" data-video_link="%s" data-zoom-image="%s"><span class="product-video-play"></span><video width="100"> <source src="%s" class="product-video" type="video/mp4" /></video></a></li>', $video_url,$video_url, $featured_video[0], $video_url ), $attachment_id, $post->ID );
					
					}
				?>
		    </ul>
		</div>
		<?php
		
		 if (count($attachment_ids) > 4) { ?>
		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		<a href="#" class="jcarousel-control-next">&rsaquo;</a>
		<?php } ?>
		<!-- p class="jcarousel-pagination"></p -->
	</div><?php
}
?>
