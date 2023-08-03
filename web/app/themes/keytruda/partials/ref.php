<?php $ref_text = get_field('ref_text');?>
<?php if($ref_text) { ?>
<div class="ref-text" id="ref">
	<div class="content-wrapper"><?php echo $ref_text;?></div>
</div>	
<?php } ?>	