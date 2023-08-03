<?php
	$left_col = get_sub_field('left_col');
	$middle_col = get_sub_field('middle_col');
	$right_col = get_sub_field('right_col');
	if($left_col || $right_col) { 
?>
	<div class="editor-block three-cols bl">
		<?php if($left_col) { ?>
			<div class="left-col">
				<?php echo $left_col;?>
			</div>
		<?php } ?>
		<?php if($middle_col) { ?>
			<div class="middle-col">
				<?php echo $middle_col;?>
			</div>
		<?php } ?>
		<?php if($right_col) { ?>
			<div class="right-col">
				<?php echo $right_col;?>
			</div>
		<?php } ?>	
	</div>	
<?php } ?>