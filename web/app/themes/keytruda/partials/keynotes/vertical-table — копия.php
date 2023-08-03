<?php
	$ver_table = get_sub_field('ver-table');
  $add_borders = get_sub_field('add_borders');
  $table_type = get_sub_field('table_type');
  $table_foot = get_sub_field('table_foot');
  $i = 0;
	if($ver_table) { 
?>
	<div class="vertical-table bl <?php echo $table_type;?> <?php if($add_borders) echo ' with-borders'?>">

	<?php foreach($ver_table as $el) { ?>
   <?php 
    $i ++;
    $title = $el['title'];
    $title_bg = $el['title_bg'];
    $table_rows = $el['table_rows'];
   ?>
   <div class="main-row table-<?php echo $i?>">
    <div class="main-title <?php if(!$title) echo ' empty-title';?> <?php if(!$table_rows) echo ' only-title'?> <?php echo $title_bg;?>"><div class="hold"><?php echo $title?></div></div>
    <?php if($table_rows) { ?>
     <div class="table-hold nano <?php if(!$title) echo ' empty-title';?>">
       <?php foreach($table_rows as $item) { ?>
        <?php
         $cols_count = $item['cols_count'];
         $two_cols = $item['two_cols'];
         $one_col = $item['one_col'];
         $three_cols = $item['three_cols'];
         $four_cols = $item['four_cols'];
        ?>
        <?php if($cols_count == 'one') { ?>
         <?php if($one_col) { ?>
         <div class="tr">
          <?php foreach($one_col as $col) { ?>
           <?php 
            $col_bg = $col['col_bg'];
            $custom_color = $col['custom_t_color'];
            $split_columns = $col['custom_col_split'] 
           ?>
           <div class="one-col <?php if($split_columns) echo ' split-col';?> td <?php echo $col_bg;?>" <?php if($custom_color) echo ' style="color:'.$custom_color.'"';?>><div class="hold"><?php echo $col['text']?></div></div>
          <?php } ?>
         </div> 
         <?php } } ?>
          <?php if($cols_count == 'two') { ?>
          <?php if($two_cols) { ?>  
            <div class="tr">
              <?php foreach($two_cols as $col) { ?>
               <?php 
                $col_bg = $col['col_bg'];
                $custom_color = $col['custom_t_color'];
                $split_columns = $col['custom_col_split']
               ?>
               <div class="two-cols <?php if($split_columns) echo ' split-col';?> td <?php echo $col_bg;?>" <?php if($custom_color) echo ' style="color:'.$custom_color.'"';?>><div class="hold"><?php echo $col['text']?></div></div>
              <?php } ?>
            </div> 
          <?php } } ?>
         <?php if($cols_count == 'three') { ?>
          <?php if($three_cols) { ?>  
          <div class="tr">
           <?php foreach($three_cols as $col) { ?>
            <?php 
              $col_bg = $col['col_bg'];
              $custom_color = $col['custom_t_color'];
              $split_columns = $col['custom_col_split'] 
            ?>
            <div class="three-cols <?php if($split_columns) echo ' split-col';?> td  <?php echo $col_bg;?>" <?php if($custom_color) echo ' style="color:'.$custom_color.'"';?>><div class="hold"><?php echo $col['text']?></div></div>
           <?php } ?>
          </div> 
         <?php } } ?>
         <?php if($cols_count == 'four') {  ?>
          <?php if($four_cols) { ?>  
          <div class="tr">
           <?php foreach($four_cols as $col) { ?>
            <?php 
              $col_bg = $col['col_bg'];
              $custom_color = $col['custom_t_color'];
              $split_columns = $col['custom_col_split']
            ?>
            <div class="four-cols td <?php if($split_columns) echo ' split-col';?> <?php echo $col_bg;?>" <?php if($custom_color) echo ' style="color:'.$custom_color.'"';?>><div class="hold"><?php echo $col['text']?></div></div>
           <?php } ?>
          </div> 
         <?php } } ?>
        <?php } ?> 
     </div> 
    <?php } ?> 
   </div> 
  <?php } ?> 
	</div>
  <?php if($table_foot) echo '<span class="table-foot">'.$table_foot.'</span>'?>	
<?php } ?>
