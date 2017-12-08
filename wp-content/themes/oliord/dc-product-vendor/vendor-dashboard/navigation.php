<?php
/*
 * The template for displaying vendor dashboard nav
 * Override this template by copying it to yourtheme/dc-product-vendor/vendor-dashboard/navigation.php
 *
 * @author 	WC Marketplace
 * @package 	WCMp/Templates
 * @version   2.4.5
 */
if (!defined('ABSPATH')) {
    exit;
}
global $WCMp;

sksort($nav_items, 'position', true);
$vendor = get_wcmp_vendor(get_current_vendor_id());
if(!$vendor){
    return;
}
if (!$vendor->image) {
    $vendor->image = $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
}
do_action('wcmp_before_vendor_dashboard_navigation');


global $current_user;	
						
$attachment_url = esc_url( get_the_author_meta( 'cupp_upload_meta', $current_user->ID ) ); 
 
if($attachment_url == ''){
	$attachment_url	=	get_template_directory_uri() .'/images/sign-in-ico.png';
	//echo '<span class="profile-name">'.substr($current_user->user_login,0,1).'</span>';
}else{
	$image_id	= get_attachment_id( $attachment_url ); 
	$attachment_url = wp_get_attachment_image_src($image_id, 'member_product_big');
	$attachment_url	=	$attachment_url[0];
	//echo '<span  class="profile-ing"><img class="img-fluid" src="'. $attachment_url .'"></span>';
}
							
?>
<div class="wcmp_side_menu">
    <div class="wcmp_top_logo_div"> 
		<img src="<?php echo $attachment_url; //$vendor->image; ?>" alt="vendordavatar">
        <h3>
            <?php echo get_user_meta(get_current_vendor_id(), '_vendor_page_title', true) ? get_user_meta(get_current_vendor_id(), '_vendor_page_title', true) : __('Shop Name', 'dc-woocommerce-multi-vendor'); ?>
        </h3>
        <?php /* ?>
        <ul>
            <li><a target="_blank" href="<?php echo apply_filters('wcmp_vendor_shop_permalink', $vendor->permalink); ?>"><?php _e('Shop', 'dc-woocommerce-multi-vendor'); ?></a> </li>
            <?php if (apply_filters('wcmp_show_vendor_announcements', true)) : ?>
                <li><a target="_self" href="<?php echo wcmp_get_vendor_dashboard_endpoint_url(get_wcmp_vendor_settings('wcmp_vendor_announcements_endpoint', 'vendor', 'general', 'vendor-announcements')); ?>"><?php _e('Announcements', 'dc-woocommerce-multi-vendor'); ?></a></li>
            <?php endif; ?>
        </ul>
        <?php */ ?>
    </div>
    <div class="wcmp_main_menu">
        <ul>
            <?php foreach ($nav_items as $key => $item): ?>
                <?php if (current_user_can($item['capability']) || $item['capability'] === true): ?>
                    <li class="<?php if(!empty($item['submenu'])){ echo 'hasmenu';} ?>">
                        <?php if(array_key_exists($WCMp->endpoints->get_current_endpoint(), $item['submenu'])){ $force_active = true;} else {$force_active = false;}?>
                        <a href="<?php echo esc_url($item['url']); ?>" target="<?php echo $item['link_target'] ?>" data-menu_item="<?php echo $key ?>" class="<?php echo implode(' ', array_map('sanitize_html_class', wcmp_get_vendor_dashboard_nav_item_css_class($key, $force_active))); ?>">
                            <i class="icon_stand dashicons-before <?php echo $item['nav_icon'] ?>"></i>
                            <span class="writtings"><?php echo esc_html($item['label']); ?></span>
                        </a>
                        <?php if (!empty($item['submenu']) && is_array($item['submenu'])): sksort($item['submenu'], 'position', true) ?>
                        <ul class="submenu" <?php if(!in_array('active', wcmp_get_vendor_dashboard_nav_item_css_class($key, $force_active))){ echo 'style="display:none"'; } ?>>
                                <?php foreach ($item['submenu'] as $submenukey => $submenu): ?>
                                    <?php if(current_user_can($submenu['capability']) || $submenu['capability'] === true): ?>
                                        <li class="<?php echo implode(' ', array_map('sanitize_html_class', wcmp_get_vendor_dashboard_nav_item_css_class($submenukey))); ?>">
                                            <a href="<?php echo esc_url($submenu['url']); ?>" target="<?php echo $submenu['link_target'] ?>">- <?php echo esc_html($submenu['label']); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php do_action('wcmp_after_vendor_dashboard_navigation'); ?>
