<?php 
	$promo = get_field('promo_grey');
	$promo_btn_type = get_field('promo_btn_type');
	$promo_btn = get_field('promo_btn_grey');
	if($promo_btn_type == 'external'){
		$promo_url = get_field('promo_btn_url');
	} else {
		$promo_url = get_field('promo_btn_ins');
	}
		
	if($promo) { 
?>
	<div class="promo grey">
		<?php if($promo) echo '<h3>'.$promo.'</h3>';?>
		<?php if($promo_url) echo '<a class="btn" href="'.$promo_url.'">'.$promo_btn.'</a>'?>
	</div>	
<?php } ?>
