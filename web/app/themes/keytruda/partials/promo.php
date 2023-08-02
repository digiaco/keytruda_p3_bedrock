<?php 
	$promo = get_field('promo');

	if($promo) { 
?>
	<div class="promo">
		<?php echo $promo;?>
	</div>	
<?php } ?>
