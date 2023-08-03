<?php
$content = get_sub_field('content_cta');
$section_id = get_sub_field('section_id');
$button_type = 'link';
if(get_sub_field('button_type')){
  $button_type = get_sub_field('button_type');
}

$btn_target = false;
$btn_url = '';
$btn_title = '';

if($button_type === 'link'){
  $btn_link = get_sub_field('cta_button');
  if($btn_link){
    $btn_target = $btn_link['target'];
    $btn_url = $btn_link['url'];
    $btn_title = $btn_link['title'];
  }
} else {
  $btn_target = false;
  $btn_url = get_sub_field('button_url');
  $btn_title = get_sub_field('button_text');
}
?>
<?php if($content) { ?>
  <div class="explore" <?php if($section_id) echo ' id="'.$section_id.'"'?>>
   <?php echo $content; ?>
   <?php if($btn_url && $btn_title) { ?>
    <a 
      <?php if($btn_target) echo ' target="_blank" rel="noopener noreferrer"';?> 
      class="btn" 
      href="<?php echo $btn_url; ?>"
    >
      <?php echo $btn_title; ?>
    </a>
   <?php } ?> 
  </div>
<?php } ?>