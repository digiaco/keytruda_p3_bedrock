<?php
	$next_post = get_next_post();
	$prev_post = get_previous_post();
	if($next_post) {
		$next_post = $next_post->ID;
	}
	if($prev_post) { 
		$prev_post = $prev_post->ID;
	}
	$next_title = get_field('navigation_title',$next_post);
	$prev_title = get_field('navigation_title',$prev_post);
	if(!$next_title){
		$next_title = get_field('custom_title',$next_post);
		if(!$next_title){
			$next_title = get_the_title($next_post);	
		}
	}
	if(!$prev_title){
		$prev_title = get_field('custom_title',$prev_post);
		if(!$prev_title){
			$prev_title = get_the_title($prev_post);	
		}
	}
	$prev_nav_img = get_field('navigation_image',$prev_post);
	
	$thumb_id = get_post_thumbnail_id($next_post);
	$thumb_id_prev = get_post_thumbnail_id($prev_post);
	$thumb_url = wp_get_attachment_image_src($thumb_id,'post-nav', true);
	$thumb_url_prev = wp_get_attachment_image_src($thumb_id_prev,'post-nav', true);
	
	$next_arrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21"> 
	  <g id="angle-right" transform="translate(274 265) rotate(180)">
	    <g id="angle-left" transform="translate(364.138 260) rotate(180)">
	      <path id="Path_1" data-name="Path 1" class="cls-2" d="M103.732,6.594l-5.16,5.16a.84.84,0,1,1-1.189-1.188L101.95,6,97.385,1.434A.84.84,0,0,1,98.573.246l5.16,5.16a.84.84,0,0,1,0,1.188Z" transform="translate(0 0)"/>
	    </g>
	  </g>
	</svg>';
	$prev_arrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21">
		  <g id="Group_1" data-name="Group 1" transform="translate(-253 -244)">
		    <g id="angle-left-s" transform="translate(366.54 264.5) rotate(180)">
		      <path id="Path_2" data-name="Path 2" class="cls-2" d="M108.129,10.99l-8.6,8.6a1.4,1.4,0,1,1-1.981-1.98l7.61-7.61L97.549,2.391A1.4,1.4,0,0,1,99.53.41l8.6,8.6a1.4,1.4,0,0,1,0,1.98Z"/>
		    </g>
		  </g>
		</svg>';
?> 
<?php if($next_post || $prev_post) { ?>
	<div class="nav-hold <?php if($next_post && $prev_post) echo ' both-nav'; ?>" >
		<?php if( ( $next_post && $prev_post) || $prev_post ) {  ?>
			<div class="posts-nav prev <?php if($next_post && $prev_post) echo ' both';?> <?php if($prev_post && !$next_post) echo ' single-next'?>">
				<div class="heading">
					<div class="btn-nav"><a href="<?php echo get_permalink($prev_post)?>"><?php echo $prev_arrow;?> <?php pll_e('Previous'); ?> </a></div> 
				</div>	
				<div class="wrap">
					<?php if(kt_nav_img($prev_post)) { ?>
						<a href="<?php echo get_permalink($prev_post);?>" tabindex="-1"> 
							<div class="post-thumb" style="background: url(<?php echo kt_nav_img($prev_post)?>) no-repeat 100% 4px;background-size:cover;"><?php echo $prev_title; ?></div>
						</a>
					<?php } ?>
					<p><?php echo $prev_title; ?></p>
				</div>	
			</div>
		<?php }?>
		<?php if( ( $next_post && $prev_post) || $next_post ) {  ?> 
			<div class="posts-nav next <?php if($next_post && $prev_post) echo ' both';?>  <?php if($next_post && !$prev_post) echo ' single-next'?>">
				<div class="heading">
					<div class="btn-nav"><a href="<?php echo get_permalink($next_post)?>"><?php pll_e('Next'); ?> <?php echo $next_arrow;?></a></div>
				</div>	
				<div class="wrap">
					<p><?php echo $next_title; ?></p>
					<?php if(kt_nav_img($next_post)) { ?>
						<a href="<?php echo get_permalink($next_post);?>" tabindex="-1">
							<div class="post-thumb" style="background: url(<?php echo kt_nav_img($next_post)?>) no-repeat 50% 0;background-size:cover;"><?php echo $next_title; ?></div>
						</a>
					<?php } ?>
				</div>	
			</div>	
		<?php } ?>		
	</div>
<?php } ?>