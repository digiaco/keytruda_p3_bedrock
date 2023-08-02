<?php /*Template Name: Dosing Options */ ?>
<?php get_header(); ?>
<?php
	$dosing_rep = get_field('dosing_rep');
	$page_ref = get_field('ref_text');
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php if($dosing_rep) { ?>
						<div class="dosing-list">
							<?php foreach($dosing_rep as $item) {  ?>
								<?php
									$title = $item['title'];
									$icon = $item['icon'];
									$btn_type = $item['btn_type'];
									$main_content = $item['dos_content'];
									$table_ref = $item['table_ref'];
									$table = $item['dosing_table'];
									if($btn_type == 'url') { 
										$url = $item['url'];
									} elseif($btn_type == 'file') {
										$url = $item['url_file'];
									} else {
										$url = '#';
									}
									$btn = $item['btn']; 
								?>
								<div class="el">
									<div class="img-wrapper"><?php echo wp_get_attachment_image( $icon, 'icon', $icon = false, array('alt'=>strip_tags($title) ) );?></div>
									<?php if($title || $btn) { ?>
										<div class="text-wrapper">
											<h2><?php echo $title;?></h2>
											<?php if($btn_type == 'content') { ?>
												<?php if($url) echo '<a class="btn opener" href="'.$url.'"><span class="open">Open <em>Arrow</em></span><span class="close">Close <em>Arrow</em></span></a>';?>
											<?php  } else { ?>
												<?php if($url) echo '<a class="btn" href="'.$url.'">'.$btn.'</a>';?>
											<?php } ?>	
										</div>
										<?php } ?>	
										<?php if($main_content || $table) { ?>
												<div class="toggle-cont">
													<?php if($main_content) echo '<div class="main-cont">'.$main_content.'</div>';?>
													<?php if($table) { ?>
														<div class="table-hold">
															<table>
																<?php foreach($table as $row) { ?>
																	<?php
																		$cols_count = $row['cols_count'];
																		$col_one = $row['col_one_content'];
																		$col_two = $row['col_two_content'];
																	?>
																	<tr>
																		<?php if($cols_count == 'two') { ?>
																			<td><?php echo $col_one?></td>
																			<td><?php echo $col_two?></td>
																		<?php } else { ?>
																			<td colspan="2"><?php echo $col_one?></td>
																		<?php } ?>		
																	</tr>	
																<?php } ?>
															</table>	
														</div>
														<?php if($table_ref) echo '<span class="t-ref">'.$table_ref.'</span>'?>
													<?php } ?>	
												</div>
											<?php } ?>
								</div>
							<?php } ?>	
						</div>	
					<?php } ?>	
				</div>
				<?php get_template_part('partials/top');?>
		      	<?php if($page_ref) { ?>
					<div class="ref-text">
						<?php echo $page_ref;?>
					</div>	
				<?php } ?>
			</div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>