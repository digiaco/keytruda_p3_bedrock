 <?php
  $global_btn = get_field('global_btn');
  $global_btn_icon = get_field('global_btn_icon');
  $global_btn_name = get_field('global_btn_name');
 ?>
 <?php if($global_btn) { ?>
 <div class="bottom-button-section">
  <a class="btn white <?php if($global_btn_icon) echo ' w-icon';?>" target="_blank" href="<?php echo $global_btn;?>"><?php if($global_btn_icon) echo wp_get_attachment_image( $global_btn_icon, $size = 'btn-icon', $icon = false, array('alt'=>'') ) ?><?php echo $global_btn_name?></a>
 </div>
<?php } ?> 