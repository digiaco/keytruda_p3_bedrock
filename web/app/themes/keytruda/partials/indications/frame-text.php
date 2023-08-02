<?php $content = get_sub_field('add_content');?>
<?php $section_id = get_sub_field('section_id');?>
<?php if($content) { ?>
<div class="frame-text" <?php if($section_id) echo ' id="'.$section_id.'"'?>>
 <?php echo $content;?>
</div>
<?php } ?>