<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package oliord
 */

?>
	</div>
</div>
<footer class="footer-content">
	<div class="wrap container">
		<div class="row">
			<div class="col-sm-4">
				<?php dynamic_sidebar('sidebar-2'); ?>
			</div>
			<div class="col-sm-4">
				<?php dynamic_sidebar('sidebar-3'); ?>
			</div>
			<div class="col-sm-4">
				<?php dynamic_sidebar('sidebar-4'); ?>
			</div>					
		</div>
		<div class="row copy-right-txt">
			<div class="col-sm-12 text-right">
				<?php
					if( !empty(get_theme_mod("oliord_cp_op")) ) { echo get_theme_mod("oliord_cp_op"); } 
					else { echo 'Please insert copyright text from theme settings.'; }
				?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery('#example2').accordionSlider({
	width: 1960,
	height: 500,
	responsiveMode: 'custom',
	autoplay: false,
	mouseWheel:false,
	keyboard:false,
	visiblePanels: 8,
	breakpoints: {
		900: {visiblePanels: 6,height: 900},
		600: {visiblePanels: 4,height: 1000}
	}
});
</script>
</body>
</html>
