<?php /*Template Name: Pan Tumour */ ?>
<?php get_header(); ?>
<?php
	$stats_title = get_field('key_stats_title');
	$st_ind = get_field('key_stats_ind');
	$st_txt = get_field('key_stats_text');
	$st_launched = get_field('st_launch_title');
	$st_launched_desc = get_field('st_launched_desc');
	$st_dispens = get_field('dispens_title');
	$st_dispens_desc = get_field('dispens_desc');
	$st_winner_title = get_field('st_winner_title');
	$st_winner_desc = get_field('st_winner_desc');
	$page_ref = get_field('ref_text');
	$body_hnscc = get_field('body_hnscc');
	$body_eso = get_field('body_eso');
	$body_nsclc = get_field('body_nsclc');
	$body_mel = get_field('body_mel');
	$body_pmbcl = get_field('body_pmbcl');
	$body_rcc = get_field('body_rcc');
	$body_ec = get_field('body_ec');
	$body_ec_add = get_field('body_ec_add');
	$body_crc = get_field('body_crc');
	$body_uc = get_field('body_uc');
	$body_chl = get_field('body_chl');
	$body_tnbc = get_field('body_tnbc');
	$body_cc = get_field('body_cc');

	$show_form = get_field('show_form');
	$form_title = get_field('reg_form_title');
	$form_text = get_field('reg_form_text');
	$form_button_text = get_field('reg_form_b_t');
	$form_button_url = get_field('reg_button_url');

	$body_added = $body_hnscc || $body_eso || $body_nsclc || $body_mel || $body_pmbcl || $body_rcc || $body_ec || $body_crc || $body_uc || $body_chl || $body_tnbc || $body_cc || $body_ec_add;
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php if($st_txt || $st_launched || $st_dispens || $st_winner_title) { ?>
						<div class="stats">
							<div class="content-wrapper">
								<?php if($stats_title) echo '<h2>'.$stats_title.'</h2>';?>
								<div class="stats-holder">
									<?php if($st_txt || $st_ind) { ?>
										<div class="circle blue">
											<?php if($st_launched) echo '<strong>'.$st_ind.'</strong>';?>
											<?php if($st_txt) echo '<span>'.$st_txt.'</span>';?>
										</div>	
									<?php } ?>	
									<?php if($st_launched || $st_launched_desc) { ?>
										<div class="circle white">
											<?php if($st_launched) echo '<strong>'.$st_launched.'</strong>';?>
											<?php if($st_launched_desc) echo '<span>'.$st_launched_desc.'</span>';?>
										</div>	
									<?php } ?>	
									<?php if($st_dispens || $st_dispens_desc) { ?>
										<div class="circle green">
											<?php if($st_dispens) echo '<strong>'.$st_dispens.'</strong>';?>
											<?php if($st_dispens_desc) echo '<span>'.$st_dispens_desc.'</span>';?>
										</div>	
									<?php } ?>	
									<?php if($st_winner_title || $st_winner_desc) { ?>
										<div class="circle light-green">
											<?php if($st_winner_title) echo '<strong>'.$st_winner_title.'</strong>';?>
											<?php if($st_winner_desc) echo '<span>'.$st_winner_desc.'</span>';?>
										</div>	
									<?php } ?>
								</div>	
							</div>
						</div>	
					<?php } ?>
					<?php the_content(); ?>
					<?php if($body_added) { ?>
						<div class="body-hold">	
							<?php /* 
							<div class="indicator-dropdown">
								<span class="heading" role="heading" aria-level="1" tabindex="0"><?php pll_e('Indications:'); ?> <img class="w-arrow" src="<?php echo get_template_directory_uri()?>/assets/img/w-arrow.png" alt="arrow"></span>
								<ul>
								<?php if($body_mel_main_name = get_field('body_mel_main_name')) echo '<li><a href="#mel" data-box="mel">'.$body_mel_main_name.'</a></li>'; ?>
								<?php if($body_nsclc_main_name = get_field('body_nsclc_main_name')) echo '<li><a href="#nsclc" data-box="nsclc">'.$body_nsclc_main_name.'</a></li>'; ?>
								<?php if($body_chl_main_name = get_field('body_chl_main_name')) echo '<li><a href="#chl" data-box="chl">'.$body_chl_main_name.'</a></li>'; ?>
								<?php if($body_pmbcl_main_name = get_field('body_pmbcl_main_name')) echo '<li><a href="#pmbcl" data-box="pmbcl">'.$body_pmbcl_main_name.'</a></li>'; ?>
								<?php if($body_uc_main_name = get_field('body_uc_main_name')) echo '<li><a href="#uc" data-box="uc">'.$body_uc_main_name.'</a></li>'; ?>
								<?php if($body_rcc_main_name = get_field('body_rcc_main_name')) echo '<li><a href="#rcc" data-box="rcc">'.$body_rcc_main_name.'</a></li>'; ?>
								<?php if($body_crc_main_name = get_field('body_crc_main_name')) echo '<li><a href="#crc" data-box="crc">'.$body_crc_main_name.'</a></li>'; ?>
								<?php if($body_ec_main_name = get_field('body_ec_main_name')) echo '<li><a href="#ec" data-box="ec">'.$body_ec_main_name.'</a></li>'; ?>
								<?php if($body_hnscc_main_name = get_field('body_hnscc_main_name')) echo '<li><a href="#hnscc" data-box="hnscc">'.$body_hnscc_main_name.'</a></li>'; ?>
								<?php if($body_eso_main_name = get_field('body_eso_main_name')) echo '<li><a href="#eso" data-box="eso">'.$body_eso_main_name.'</a></li>'; ?>
								</ul>	
							</div>	
							 */?>
							<div class="indicator-selector" role="region">
								<div class="indicator-selector-wrp">
									<?php if($body_hnscc) { ?>
										<a data-order="1" href="#hnscc" data-box="hnscc" class="indicator-item hnscc toleft">
											<span data-toggle="tooltip" title="HNSCC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Skull.png" alt="HNSCC" title="HNSCC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Skull_hover.png" title="HNSCC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('HNSCC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_nsclc) { ?>
										<a data-order="2" href="#nsclc" data-box="nsclc" class="indicator-item nsclc toleft">
											<span data-toggle="tooltip" title="NSCLC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lungs.png" alt="NSCLC" title="NSCLC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lungs_hover.png" title="NSCLC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('NSCLC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_eso) { ?>
										<a data-order="3" href="#focus-link" data-box="eso"  class="indicator-item eso toright" >
											<span data-toggle="tooltip" title="ESO" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/ec-icon.png" alt="ESO" title="ESO" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/ec-icon-hover.png" title="ESO active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('ESO'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_pmbcl) { ?>
										<a data-order="3" href="#focus-link" data-box="pmbcl"  class="indicator-item pmbcl toright" >
											<span data-toggle="tooltip" title="PMBCL" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bone.png" alt="PMBCL" title="PMBCL" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bone_hover.png" title="PMBCL active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('PMBCL'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_mel) { ?>
										<a data-order="4" href="#focus-link" data-box="mel" class="indicator-item melanoma toleft" >
											<span data-toggle="tooltip" title="Melanoma" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Melanoma.png" alt="Melanoma" title="Melanoma" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Melanoma-hover.png" title="Melanoma active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('Melanoma'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_rcc) { ?>
										<a data-order="5" href="#focus-link" data-box="rcc" class="indicator-item rcc toright" >
											<span data-toggle="tooltip" title="RCC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Kidney.png" alt="RCC" title="RCC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Kidney_hover.png" title="RCC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('RCC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_cc) { ?>
										<a data-order="11" href="#focus-link" data-box="cc" class="indicator-item cc toleft" >
											<span data-toggle="tooltip" title="CC" class="img-wrp cc-img"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/cc.png" alt="CC" title="CC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/cc_hover.png" title="CC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('CC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_ec_add) { ?>
										<a data-order="12" href="#focus-link" data-box="mmr-ec" class="indicator-item mmr-ec add toright" >
											<span class="img-description"><?php pll_e('EC Additional'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_ec) { ?>
										<a data-order="6" href="#focus-link" data-box="ec" class="indicator-item ec toright" >
											<span data-toggle="tooltip" title="EC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Uterus.png" alt="EC" title="EC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Uterus_hover.png" title="EC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('EC'); ?></span>
										</a>
									<?php } ?>
									
									<?php if($body_crc) { ?>
										<a data-order="7" href="#focus-link" data-box="crc" class="indicator-item crc toleft" >
											<span data-toggle="tooltip" title="CRC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Colon.png" alt="CRC" title="CRC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Colon_hover.png" title="CRC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('CRC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_uc) { ?>
										<a data-order="8" href="#focus-link" data-box="uc"  class="indicator-item uc toleft" >
											<span data-toggle="tooltip" title="UC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bladder.png" alt="UC" title="UC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bladder_hover.png" title="UC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('UC'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_chl) { ?>
										<a data-order="9" href="#focus-link" data-box="chl" class="indicator-item chl toright" >
											<span data-toggle="tooltip" title="cHL" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lymph.png" alt="cHL" title="cHL" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lymph_hover.png" title="cHL active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('cHL'); ?></span>
										</a>
									<?php } ?>
									<?php if($body_tnbc) { ?>
										<a data-order="10" href="#focus-link" data-box="tnbc" class="indicator-item tnbc toright" >
											<span data-toggle="tooltip" title="TNBC" class="img-wrp"><img class="img-inactive" src="<?php echo get_template_directory_uri()?>/assets/img/body/tnbc.png" alt="TNBC" title="TNBC" width="49" height="49">
												<img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/tnbc_hover.png" title="TNBC active" width="49" height="49">
											</span>
											<span class="img-description"><?php pll_e('TNBC'); ?></span>
										</a>
									<?php } ?>
									
								
								</div>
								<img class="indicator-selector-bg" src="<?php echo get_template_directory_uri()?>/assets/img/Figure.png" alt="Indicator" title="Indicator">
							</div>
							<?php if($body_hnscc) { ?>
								<div class="body-box" id="hnscc">
									<div class="heading">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Skull_hover.png" title="HNSCC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('HNSCC'); ?></em></span>
									</div>
									<?php 
										$body_hnscc_desc = get_field('body_hnscc_desc');
										if($body_hnscc_desc) echo '<p>'.$body_hnscc_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_hnscc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}
											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_nsclc) { ?>
								<div class="body-box" id="nsclc">
									<div class="heading">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lungs_hover.png" title="NSCLC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('NSCLC'); ?></em></span>
									</div>	
									<?php 
										$body_nsclc_desc = get_field('body_nsclc_desc');
										if($body_nsclc_desc) echo '<p>'.$body_nsclc_desc.'</p>';
									?>
									<div class="btns-hold">
										<?php foreach ($body_nsclc as $el) { 
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_eso) { ?>
								<div class="body-box" id="eso">
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/ec-icon-hover-white.png" title="eso active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('ESO'); ?></em></span>
									</div>
									<?php 
										$body_eso_desc = get_field('body_eso_desc');
										if($body_eso_desc) echo '<p>'.$body_eso_desc.'</p>';
									?>	
									<div class="btns-hold">
										<?php foreach ($body_eso as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_pmbcl) { ?>
								<div class="body-box" id="pmbcl">
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bone_hover.png" title="PMBCL active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('PMBCL'); ?></em></span>
									</div>
									<?php 
										$body_pmbcl_desc = get_field('body_pmbcl_desc');
										if($body_pmbcl_desc) echo '<p>'.$body_pmbcl_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_pmbcl as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_mel) { ?>
								<div class="body-box" id="mel">
									<div class="heading">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Melanoma-hover.png" title="Melanoma active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('Melanoma'); ?></em></span>
									</div>
									<?php 
										$body_mel_desc = get_field('body_mel_desc');
										if($body_mel_desc) echo '<p>'.$body_mel_desc.'</p>';
									?>	
									<div class="btns-hold">
										<?php foreach ($body_mel as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_rcc) { ?>
								<div class="body-box" id="rcc">
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Kidney_hover.png" title="RCC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('RCC'); ?></em></span>
									</div>
									<?php 
										$body_rcc_desc = get_field('body_rcc_desc');
										if($body_rcc_desc) echo '<p>'.$body_rcc_desc.'</p>';
									?>	
									<div class="btns-hold">
										<?php foreach ($body_rcc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}
											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_ec) { ?>
								<div class="body-box" id="ec">
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Uterus_hover.png" title="EC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('EC'); ?></em></span>
									</div>
									<?php 
										$body_ec_desc = get_field('body_ec_desc');
										if($body_ec_desc) echo '<p>'.$body_ec_desc.'</p>';
									?>	
									<div class="btns-hold">	
										<?php foreach ($body_ec as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_ec_add) { ?>
								<div class="body-box" id="mmr-ec">
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Uterus_hover.png" title="EC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('EC Additional'); ?></em></span>
									</div>
									<?php 
										$body_ec_add_desc = get_field('body_ec_add_desc');
										if($body_ec_add_desc) echo '<p>'.$body_ec_add_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_ec_add as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_crc) { ?>
								<div class="body-box" id="crc">
									<div class="heading">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Colon_hover.png" title="CRC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('MSI-H/dMMR CRC'); ?></em></span>
									</div>
									<?php 
										$body_crc_desc = get_field('body_crc_desc');
										if($body_crc_desc) echo '<p>'.$body_crc_desc.'</p>';
									?>
									<div class="btns-hold">		
										<?php foreach ($body_crc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_uc) { ?>
								<div class="body-box" id="uc">
									<div class="heading">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Bladder_hover.png" title="UC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('UC'); ?></em></span>
									</div>	
									<?php 
										$body_uc_desc = get_field('body_uc_desc');
										if($body_uc_desc) echo '<p>'.$body_uc_desc.'</p>';
									?>
									<div class="btns-hold">
										<?php foreach ($body_uc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}
											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_chl) { ?>
								<div class="body-box" id="chl">
									
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/Lymph_hover.png" title="cHL active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('cHL'); ?></em></span>
									</div>
									<?php 
										$body_chl_desc = get_field('body_chl_desc');
										if($body_chl_desc) echo '<p>'.$body_chl_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_chl as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_tnbc) { ?>
								<div class="body-box" id="tnbc">
									
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/tnbc_hover.png" title="TNBC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('TNBC'); ?></em></span>
									</div>
									<?php 
										$body_tnbc_desc = get_field('body_tnbc_desc');
										if($body_tnbc_desc) echo '<p>'.$body_tnbc_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_tnbc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>
							<?php if($body_cc) { ?>
								<div class="body-box" id="cc">
									
									<div class="heading img-right">
										<div class="img-placer"><img class="img-active" src="<?php echo get_template_directory_uri()?>/assets/img/body/cc_hover.png" title="CC active" width="49" height="49"></div>
										<span class="description"><em><?php pll_e('CC'); ?></em></span>
									</div>
									<?php 
										$body_cc_desc = get_field('body_cc_desc');
										if($body_cc_desc) echo '<p>'.$body_cc_desc.'</p>';
									?>
									<div class="btns-hold">	
										<?php foreach ($body_cc as $el) {
											$btn_type = $el['btn_type']; 
											$name = $el['btn_name'];
											$url = $el['btn_url'];
											if($btn_type == 'inside'){
												$url = $el['btn_inside'];	
											}

											if($url) echo '<a class="btn" href="'.$url.'">'.$name.'</a>';
										} ?>
									</div>
									<a href="#" class="close">
										<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg>
										Close
									</a>
								</div>	
							<?php } ?>	
							<?php /*<div class="focus-link" style="margin-top: -5%;padding-bottom:5%;" id="focus-link"></div>*/?>
						</div>	
					<?php } ?>
					<?php if($body_main_link = get_field('main_bottom_link')) { ?>
						<a class="btn main-btn" href="<?php echo $body_main_link;?>"><?php echo get_field('main_bottom_link_name')?></a>
					<?php } ?>
				</div>
				<?php get_template_part('partials/top');?>
		      	<?php if($page_ref) { ?>
					<div class="ref-text">
						<?php echo $page_ref;?>
					</div>	
				<?php } ?>
			</div>
			<?php if($show_form) { ?>
				<?php 
					$popup_text = get_field('popup_text');
					$rating_question = get_field('rating_question');
				?>
				
				<div class="registration-form" id="reg">
					<div class="content-wrapper">
						<div class="form-wrap">
							<?php if($form_title) echo '<h3>'.$form_title.'</h3>'?>
							<?php if($form_text) echo '<p>'.$form_text.'</p>'?>
							<?php if($form_button_url) { ?>
								<div class="form-placer">
									<a class="reg-button" href="<?php echo $form_button_url?>" rel="noopener noreferrer" target="_blank"><?php echo $form_button_text ?></a>
								</div>	
							<?php } ?>
						</div>
						<div class="rating-hold">
							<div class="rating-wrap">
								<?php if($rating_question) { ?>
									<p><?php echo $rating_question;?></p>
								<?php } ?>
								<div class="rating not-voted trigger">
								  <svg class="star" data-value="1" viewBox="0 0 24 24">
								    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
								  </svg>
								  <svg class="star" data-value="2" viewBox="0 0 24 24">
								    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
								  </svg>
								  <svg class="star" data-value="3" viewBox="0 0 24 24">
								    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
								  </svg>
								  <svg class="star" data-value="4" viewBox="0 0 24 24">
								    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
								  </svg>
								  <svg class="star" data-value="5" viewBox="0 0 24 24">
								    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
								  </svg>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="register-popup" id="thanks">
					<div class="form-wrapper">
						<?php if($rating_question) { ?>
							<?php echo '<p>'.$rating_question.'</p>';?>
						<?php } ?>	
						<div class="rating not-voted">
						  <svg class="star" data-value="1" viewBox="0 0 24 24">
						    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
						  </svg>
						  <svg class="star" data-value="2" viewBox="0 0 24 24">
						    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
						  </svg>
						  <svg class="star" data-value="3" viewBox="0 0 24 24">
						    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
						  </svg>
						  <svg class="star" data-value="4" viewBox="0 0 24 24">
						    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
						  </svg>
						  <svg class="star" data-value="5" viewBox="0 0 24 24">
						    <path d="M12 2.362l3.09 7.52 8.91.647-6.82 5.894 2.727 8.287L12 19.038l-7.909 4.673 2.727-8.287-6.82-5.894 8.91-.647z" />
						  </svg>
						</div>
						<?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]')?>
					</div>
				</div>	
			<?php } ?>
		</article>

	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>