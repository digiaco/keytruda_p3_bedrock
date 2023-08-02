<?php /* Template Name: NSCLC Clinical Program */?>
<?php get_header(); ?> 
<?php 
	$nsclc_top_text = get_field('nsclc_top_text','options');
	$nsclc_indicate_list = get_field('nsclc_list','options');
	$explore_text = get_field('exp_text','options');
	$nsclc_clinical_title = get_field('nsclc_cl_main_title','options');
	$nsclc_desc = get_field('nsclc_cl_desc','options');	
	$keynotes = get_field('nsclc_cl_keynotes','options',false, false);
	$cl_program_line_title = get_field('cl_program_line_title','options');
	$cl_program_editor = get_field('cl_program_editor','options');
	$cl_overview = get_field('cl_overview','options');
	$main_nsclc_ref = get_field('main_nsclc_ref','options');
	$cl_studies_ref = get_field('cl_studies_ref','options');
	$cl_program_ref = get_field('cl_program_ref','options');
	$main_page_url = get_field('nsclc_url','options');
   	$clinical_url = get_field('nsclc_clinical_url','options');
   	$programs_url = get_field('nsclc_program_url','options');
	//$child = get_pages('child_of='.$post->post_parent.'&sort_column=menu_order'); 
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="nsclc-tabs"> 
		<ul class="tabset">
			<?php if($nsclc_top_text || $nsclc_indicate_list || $explore_text) { ?>
				<li><a href="<?php echo $main_page_url;?>"><?php pll_e('KEYTRUDA<sup>®</sup> in NSCLC'); ?></a></li>
			<?php } ?>
			<?php if($nsclc_clinical_title || $nsclc_desc || $keynotes) { ?>
				<li ><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in NSCLC'); ?></a></li>
			<?php } ?>
			<li class="active"><a href="<?php echo $programs_url;?>" ><?php pll_e('Clinical program in NSCLC'); ?></a>
		</ul>
	    <div id="c-program">
	     	<?php if($cl_program_line_title) echo '<h2 class="promo-line">'.$cl_program_line_title.'</h2>';?>
	     	<?php if($cl_program_editor) echo '<div class="top-desc">'.$cl_program_editor.'</div>';?>
	     	<?php if($cl_overview) { ?>
	     		<div class="overview-pivotal">
	     			<h3><?php pll_e('Pivotal trial overview'); ?></h3>
	     			<div class="wrapper">
	     				<?php $i = 0;?>
	     				<?php foreach($cl_overview as $el) { $i++; ?>
	     					<?php
	     						$title = $el['title'];
	     						$btn_name = $el['btn_name'];
	     						$btn_url = $el['btn_url'];
	     					?>
	     					<div class="el">
	     						<?php if($title) echo '<h4>'.$title.'</h4>'; ?>
	     						<a class="btn" href="<?php echo $btn_url;?>"><?php echo $btn_name?></a>
	     					</div>	
	     				<?php } ?>	
	     			</div>	
	     		</div>
	     		<?php $i = 0;?>
	     		<div class="m-wrap">
					<?php foreach($cl_overview as $el) { $i++; 
						$main_title = $el['main_title'];
						$survival_content = $el['survival_content'];
						$survival_buttons = $el['survival_buttons'];
						$survival_buttons_obj = $el['survival_buttons_obj'];
						$survival_small_ref = $el['survival_small_ref'];
						$survival_small_ref_obj = $el['survival_small_ref_obj'];
						$response_content = $el['response_content'];
						$duration_content = $el['duration_content'];
						$survival_small_ref_dur = $el['survival_small_ref_dur'];
						$survival_buttons_dur = $el['survival_buttons_dur'];
					?>
			     		<?php if($survival_content || $response_content || $duration_content) { ?>
							<div class="trial-content">
								<?php if($main_title) echo '<h2>'.$main_title.'</h2>';?>
								<div id="trial-tab-<?php echo $i?>" class="tabs">
									<ul class="tabset inside">
										<?php if($survival_content) echo '<li><a href="#survival-'.$i.'">'; ?>
										<?php pll_e('Overall survival');?>
										<?php echo '</a></li>'?>
										<?php if($response_content) echo '<li><a href="#response-'.$i.'">'; ?>
										<?php pll_e('Objective response rate');?>
										<?php echo '</a></li>'?>
										<?php if($duration_content) echo '<li><a href="#duration-'.$i.'">'; ?>
										<?php pll_e('Duration of response');?>
										<?php echo '</a></li>'?>
									</ul>
									
						 		 		<div id="survival-<?php echo $i;?>">
						 		 			<?php echo $survival_content?>
						 		 			<?php
						 		 				$circles_editor = $el['circles_editor']; 
						 		 				if($circles_editor) { ?>
						 		 					<div class="circles" data-simplebar>
						 		 						<?php foreach($circles_editor as $row) { ?> 
						 		 							<div class="row">
							 		 							<?php
							 		 								$side_row_title = $row['side_row_title'];
							 		 								$circle = $row['circles_flex'];
							 		 								
							 		 							?>
							 		 							<?php if($side_row_title) echo '<strong class="row-title">'.$side_row_title.'</strong>';?>
						 		 								<?php
						 		 									foreach ($circle as $flex_elem) {
						 		 										if($flex_elem['acf_fc_layout'] == 'survival_rate_circle') {
						 		 											echo '<div class="survival-circle"><span><img src="'.get_template_directory_uri().'/assets/img/arrowup.svg" alt="top arrow"></span>';
						 		 											pll_e('Overall survival rate');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'duplicate_rate_circle' ) {
						 		 											echo '<div class="survival-circle median"><span><img src="'.get_template_directory_uri().'/assets/img/x-icon.svg" alt="top arrow"></span>';
						 		 											pll_e('Median survival <strong>not reached</strong> for KEYTRUDA<sup>®</sup> + plat/pem');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'i_circle'){
						 		 											$above_title = $flex_elem['i_above_title'];
						 		 											$main_title = $flex_elem['i_inside_title'];
						 		 											$main_text = $flex_elem['i_short_text'];
						 		 											$bg_color = $flex_elem['bg_color'];
						 		 											echo '<div class="main-circle">';
						 		 												if($above_title) echo '<p class="circle-title"><span>'.$above_title.'</span></p>';
						 		 												if($main_title || $main_text){
						 		 													echo '<div class="b-circle" '.($bg_color ? ' style="background:'.$bg_color.'"' : '').'>';
						 		 														if($main_title) echo '<strong '.($main_text ? ' class="with-text"' : '').'>'.$main_title.'</strong>';
						 		 														if($main_text) echo '<span>'.$main_text.'</span>';
						 		 													echo '</div>';
						 		 												}
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'empty_box' ) {
						 		 											echo '<div class="main-circle empty">';
						 		 											echo '</div>';
						 		 										}
						 		 									}
						 		 								?>
						 		 							</div>
						 		 						<?php } ?>	
						 		 					</div>	
						 		 			<?php	
						 		 				} 
						 		 			?>
						 		 			<?php if($survival_small_ref) echo '<div class="small-ref">'.$survival_small_ref.'</div>';?>
						 		 			<?php if($survival_buttons) { ?>
						 		 				<div class="bottom-buttons">
						 		 					<?php  $b = 0;?>
						 		 					<?php foreach($survival_buttons as $btn) {  ?>
						 		 						<?php
						 		 							$b++;
						 		 							$btn_type = $btn['button_type'];
						 		 							$btn_name = $btn['button_name'];
						 		 							$btn_url = $btn['url'];
						 		 							$popup_content = $btn['popup_content'];
						 		 						?>
						 		 						<?php if($btn_type == 'link') { ?>
						 		 							<?php echo '<a class="btn" id="s_el-'.$b.$i.'" href="'.$btn_url.'">'.$btn_name.'</a>';?>
						 		 						<?php } else {  ?>
						 		 							<?php echo '<a class="btn popup-btn" data-fancybox data-src="#popup_k-'.$i.'" href="javascript:;" id="s_el-'.$b.$i.'">'.$btn_name.'</a>';?>
						 		 							<div class="popup-holder" data-simplebar id="popup_k-<?php echo $i;?>">
						 		 								<div class="popup-scroller"><?php echo $popup_content;?></div>
						 		 							</div>	
						 		 						<?php } ?>	
						 		 					<?php } ?>	
						 		 				</div>	
						 		 			<?php } ?>	
							 		 	</div>
						 		 	
						 		 	<?php if($response_content) {  ?>
						 		 		<div id="response-<?php echo $i;?>">
						 		 			<?php echo $response_content?>
						 		 			<?php
						 		 				$circles_editor_obj = $el['circles_editor_obj'];
						 		 				if($circles_editor_obj) { ?>
						 		 					<div class="circles" data-simplebar>
						 		 						<?php foreach($circles_editor_obj as $row) { ?>
						 		 							<div class="row">
							 		 							<?php
							 		 								$side_row_title = $row['side_row_title'];
							 		 								$circle = $row['circles_flex'];
							 		 								
							 		 							?>
							 		 							<?php if($side_row_title) echo '<strong class="row-title">'.$side_row_title.'</strong>';?>
						 		 								<?php
						 		 									foreach ($circle as $flex_elem) {
						 		 										/*print_r($flex_elem);*/
						 		 										
						 		 										if($flex_elem['acf_fc_layout'] == 'survival_rate_circle') {
						 		 											echo '<div class="survival-circle"><span><img src="'.get_template_directory_uri().'/assets/img/arrowup.svg" alt="top arrow"></span>';
						 		 											pll_e('Overall survival rate');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'duplicate_rate_circle' ) {
						 		 											echo '<div class="survival-circle median"><span><img src="'.get_template_directory_uri().'/assets/img/x-icon.svg" alt="top arrow"></span>';
						 		 											pll_e('Median survival <strong>not reached</strong> for KEYTRUDA<sup>®</sup> + plat/pem');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'i_circle'){
						 		 											$above_title = $flex_elem['i_above_title'];
						 		 											$main_title = $flex_elem['i_inside_title'];
						 		 											$main_text = $flex_elem['i_short_text'];
						 		 											$bg_color = $flex_elem['bg_color'];
						 		 											echo '<div class="main-circle">';
						 		 												if($above_title) echo '<p class="circle-title"><span>'.$above_title.'</span></p>';
						 		 												if($main_title || $main_text){
						 		 													echo '<div class="b-circle" '.($bg_color ? ' style="background:'.$bg_color.'"' : '').'>';
						 		 														if($main_title) echo '<strong '.($main_text ? ' class="with-text"' : '').'>'.$main_title.'</strong>';
						 		 														if($main_text) echo '<span>'.$main_text.'</span>';
						 		 													echo '</div>';
						 		 												}
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'empty_box' ) {
						 		 											echo '<div class="main-circle empty">';
						 		 											echo '</div>';
						 		 										}
						 		 									}
						 		 								?>
						 		 							</div>
						 		 						<?php } ?>	
						 		 					</div>	
						 		 			<?php	
						 		 				} 
						 		 			?>
						 		 			<?php if($survival_small_ref_obj) echo '<div class="small-ref">'.$survival_small_ref_obj.'</div>';?>
						 		 			<?php if($survival_buttons_obj) { ?>
						 		 				<div class="bottom-buttons">
						 		 					<?php $d = 0;?>
						 		 					<?php foreach($survival_buttons_obj as $btn) { ?>
						 		 						<?php
						 		 							$d++;
						 		 							$btn_type = $btn['button_type'];
						 		 							$btn_name = $btn['button_name'];
						 		 							$btn_url = $btn['url'];
						 		 							$popup_content = $btn['popup_content'];
						 		 						?>
						 		 						<?php if($btn_type == 'link') { ?>
						 		 							<?php echo '<a class="btn" id="d_el-'.$d.$i.'" href="'.$btn_url.'">'.$btn_name.'</a>';?>
						 		 						<?php } else {  ?>
						 		 							<?php echo '<a class="btn popup-btn" data-fancybox data-src="#popup-'.$i.'" href="javascript:;" id="d_el-'.$d.$i.'">'.$btn_name.'</a>';?>
						 		 							<div class="popup-holder" data-simplebar id="popup-<?php echo $i;?>">
						 		 								<div class="popup-scroller"><?php echo $popup_content;?></div>
						 		 							</div>	
						 		 						<?php } ?>	
						 		 					<?php } ?>	
						 		 				</div>	
						 		 			<?php } ?>
							 		 	</div>
						 		 	<?php } ?>
						 		 	<?php if($duration_content) {  ?>
						 		 		<div id="duration-<?php echo $i;?>">
						 		 			<?php echo $duration_content?>
						 		 			<?php
						 		 				$circles_editor_dur = $el['circles_editor_dur'];
						 		 				if($circles_editor_dur) { ?>
						 		 					<div class="circles" data-simplebar>
						 		 						<?php foreach($circles_editor_dur as $row) { ?>
						 		 							<div class="row">
							 		 							<?php
							 		 								$side_row_title = $row['side_row_title'];
							 		 								$circle = $row['circles_flex'];
							 		 								
							 		 							?>
							 		 							<?php if($side_row_title) echo '<strong class="row-title">'.$side_row_title.'</strong>';?>
						 		 								<?php
						 		 									foreach ($circle as $flex_elem) {
						 		 										/*print_r($flex_elem);*/
						 		 										
						 		 										if($flex_elem['acf_fc_layout'] == 'survival_rate_circle') {
						 		 											echo '<div class="survival-circle"><span><img src="'.get_template_directory_uri().'/assets/img/arrowup.svg" alt="top arrow"></span>';
						 		 											pll_e('Overall survival rate');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'duplicate_rate_circle' ) {
						 		 											echo '<div class="survival-circle median"><span><img src="'.get_template_directory_uri().'/assets/img/x-icon.svg" alt="top arrow"></span>';
						 		 											pll_e('Median survival <strong>not reached</strong> for KEYTRUDA<sup>®</sup> + plat/pem');
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'i_circle'){
						 		 											$above_title = $flex_elem['i_above_title'];
						 		 											$main_title = $flex_elem['i_inside_title'];
						 		 											$main_text = $flex_elem['i_short_text'];
						 		 											$bg_color = $flex_elem['bg_color'];
						 		 											echo '<div class="main-circle">';
						 		 												if($above_title) echo '<p class="circle-title"><span>'.$above_title.'</span></p>';
						 		 												if($main_title || $main_text){
						 		 													echo '<div class="b-circle" '.($bg_color ? ' style="background:'.$bg_color.'"' : '').'>';
						 		 														if($main_title) echo '<strong '.($main_text ? ' class="with-text"' : '').'>'.$main_title.'</strong>';
						 		 														if($main_text) echo '<span>'.$main_text.'</span>';
						 		 													echo '</div>';
						 		 												}
						 		 											echo '</div>';
						 		 										}
						 		 										if($flex_elem['acf_fc_layout'] == 'empty_box' ) {
						 		 											echo '<div class="main-circle empty">';
						 		 											echo '</div>';
						 		 										}
						 		 									}
						 		 								?>
						 		 							</div>
						 		 						<?php } ?>	
						 		 					</div>	
						 		 			<?php	
						 		 				} 
						 		 			?>
						 		 			<?php if($survival_small_ref_dur) echo '<div class="small-ref">'.$survival_small_ref_dur.'</div>';?>
						 		 			<?php if($survival_buttons_dur) { ?>
						 		 				<div class="bottom-buttons">
						 		 					<?php $c = 0;?>
						 		 					<?php foreach($survival_buttons_dur as $btn) { ?>
						 		 						<?php
						 		 							$c++;
						 		 							$btn_type = $btn['button_type'];
						 		 							$btn_name = $btn['button_name'];
						 		 							$btn_url = $btn['url'];
						 		 							$popup_content = $btn['popup_content'];
						 		 						?>
						 		 						<?php if($btn_type == 'link') { ?>
						 		 							<?php echo '<a class="btn" id="el-'.$c.$i.'" href="'.$btn_url.'">'.$btn_name.'</a>';?>
						 		 						<?php } else {  ?>
						 		 							<?php echo '<a class="btn popup-btn" data-src="#popup_s-'.$i.'" href="javascript:;" id="el-'.$c.$i.'">'.$btn_name.'</a>';?>
						 		 							<div class="popup-holder" data-simplebar id="popup_s-<?php echo $i;?>">
						 		 								<div class="popup-scroller" ><?php echo $popup_content;?></div>
						 		 							</div>	
						 		 						<?php } ?>	
						 		 					<?php } ?>	
						 		 				</div>	
						 		 			<?php } ?> 
							 		 	</div>
						 		 	<?php } ?>	
								</div>	
							</div>	
						<?php } ?>	
					<?php } ?>
				</div>
	     	<?php } ?>	
	     	<?php get_template_part('partials/top');?>
	     	<?php if($cl_program_ref) { ?>
				<div class="ref-text" id="ref">
					<?php echo $cl_program_ref;?>
				</div>	
			<?php } ?>
	    </div>  
	</div>
</div>
<?php get_footer(); ?>