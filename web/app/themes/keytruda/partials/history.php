<?php
	$history_list = get_field('history');
?>
<?php if($history_list) { ?>	
	<div class="history-list">
		<?php $i=0; foreach($history_list as $el) { $i++; ?>
			<div class="el item-<?php echo $i;?>">
				<?php
					$year = $el['year'];
					$title = $el['title'];
					$list = $el['list'];
				?>
				<?php if($year) echo '<span class="year" tabindex="0"><em>'.$year.'</em></span>';?>
				<div class="wrapper">
					<?php if($title) echo '<h3>'.$title.'</h3>';?>
					<?php if($list) { ?>
						<ul>
							<?php foreach($list as $item) { ?>
								<?php $boxed = $item['boxed'];?>
								<li <?php if($boxed == true) echo ' class="boxed"';?>><?php echo $item['item'];?></li>
							<?php } ?>	
						</ul>
					<?php } ?>	
				</div>	
			</div>	
		<?php } ?>	
	</div>	
<?php } ?>