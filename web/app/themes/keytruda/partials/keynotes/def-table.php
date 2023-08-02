<?php
	$table_two = get_sub_field('table_two');
  $cols_count = get_sub_field('table_count');
?>
<div class="def-table">
  <table>
   <?php $i = 0;?>
   <?php if($table_two) { ?>
    <?php foreach($table_two as $col) { ?>
      <?php if($i++ == 0){ echo '<tr>';}?>
        <td class="<?php echo $col['weight']?>" <?php if($col['td_color']) echo ' style="color:'.$col['td_color'].';"'?>><?php echo $col['td']?></td>
      <?php if($i == $cols_count){ $i = 0; echo '</tr>'; }?>
    <?php } ?> 
    <?php if($i != 0) echo '</tr>';?> 
   <?php } ?> 
  </table>  
</div>  
