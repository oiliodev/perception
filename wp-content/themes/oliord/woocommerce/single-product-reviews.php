<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;


if ( ! comments_open() ) {
	return;
}


?>

<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<?php if ( have_comments() ) : 
		$five_star_per	= $product->rating_counts['5'] / 5 * 100; //70
		$for_star_per 	= $product->rating_counts['4'] / 5 * 100;	//60
		$three_star_per = $product->rating_counts['3'] / 5 * 100;	//50
		$two_star_per 	= $product->rating_counts['2'] / 5 * 100;	//20
		$one_star_per 	= $product->rating_counts['1'] / 5 * 100;	//10
		
		?>
<div class="average_commentlist_secton">
<div class="progressbar-part">
	<div class="form-group"><div class="star-progress float-left">5 </div>
		 <div class="progress five_star">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $five_star_per; ?>"  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $five_star_per; ?>%">
					<span class="sr-only"><?php echo $five_star_per; ?>% Complete</span>
				 </div>
		</div> 
		<div class="star-progress-number float-left"><?php if(isset($product->rating_counts['5'])) { echo $product->rating_counts['5']; } else { echo '0'; } ?></div>
	</div>
	
	<div class="form-group"><div class="star-progress float-left">4</div>
		<div class="progress four_star">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $for_star_per; ?>"  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $for_star_per; ?>%">
					<span class="sr-only"><?php echo $for_star_per; ?>% Complete</span>
				 </div>
		</div> 		
		<div class="star-progress-number float-left"><?php if(isset($product->rating_counts['4'])) { echo $product->rating_counts['4']; } else { echo '0'; } ?></div>
	</div>
	
	<div class="form-group"><div class="star-progress float-left">3 </div>
	<div class="progress three_star">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $three_star_per; ?>"  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $three_star_per; ?>%">
					<span class="sr-only"><?php echo $three_star_per; ?>% Complete</span>
				 </div>
	</div> 
	<div class="star-progress-number float-left"><?php if(isset($product->rating_counts['3'])) { echo $product->rating_counts['3']; } else { echo '0'; } ?></div>
	</div>
	
	<div class="form-group"><div class="star-progress float-left">2 </div>
	<div class="progress tow_star">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $two_star_per; ?>"  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $two_star_per; ?>%">
				<span class="sr-only"><?php echo $two_star_per; ?>% Complete</span>
			 </div>
		</div> 
	<div class="star-progress-number float-left"><?php if(isset($product->rating_counts['2'])) { echo $product->rating_counts['2']; } else { echo '0'; } ?></div></div>
	<div class="form-group"><div class="star-progress float-left">1 </div>
	<div class="progress one_star">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $one_star_per; ?>"  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $one_star_per; ?>%">
				<span class="sr-only"><?php echo $one_star_per; ?>% Complete</span>
			 </div>
		</div> 
	<div class="star-progress-number float-left"><?php if(isset($product->rating_counts['1'])) { echo $product->rating_counts['1']; } else { echo '0'; } ?></div></div>
</div>
</div>


			<div class="commentlist_secton clearfix">
				<ol class="commentlist">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>
			</div>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</span>',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label class="custom_label" for="author">' . esc_html__( 'Name', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
							'email'  => '<p class="comment-form-email"><label for="email" class="custom_label">' . esc_html__( 'Email', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										'<input id="email" class="form-control" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
						),
						'label_submit'  => __( 'Submit', 'woocommerce' ),
						'logged_in_as'  => '',
						'comment_field' => '',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . '</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
