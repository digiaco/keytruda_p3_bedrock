<?php
		$banner = get_field('indication_banner');
		$banner_mob = get_field('indication_banner_mob');
		$banner_title = get_field('indication_banner_title'); 
		$add_banner = '';
		$add_banner_mob = '';
?> 
<?php if($banner) { ?>
	<div class="banner <?php if($banner_mob || $add_banner_mob) echo ' mob';?> <?php if($add_banner) echo ' add-banner';?>">
		<div class="text-hold"> 
			<div class="content-wrapper">
					<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
			</div>
		</div> 
		<?php echo wp_get_attachment_image( $banner, 'banner', $icon = false, array('alt'=> strip_tags($banner_title) ,'width'=>'1440','height'=>'350','class'=>'m-banner','tabindex'=>'0')); ?>
		<?php if($banner_mob) echo wp_get_attachment_image( $banner_mob, 'mob-banner', $icon = false, array('alt'=>'' ,'class'=>'mob-img','role'=>'presentation') ); ?>
	</div>
<?php } else { ?>
	<div class="banner no-img"></div>
<?php } ?>