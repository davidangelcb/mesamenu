<style>
.row1
{
	background-color:#FFFFFF;
}
.row2{
	background-color:#CCCCCC;
}
</style>
<TABLE style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px" width="100%" border="0"><?php
for($i=0;  $i<sizeof($Data);$i++){
	$RowIndex     =     1;
	$Css          =     $RowIndex%2 == 0 ? 'row1' : 'row2';
	?>
     <TR class="<?php echo $Css;?>"><?php
		foreach ( $Data[$i] as $Dat) {?>
          	<TD>&nbsp;<?php echo $Dat;?></TD>
		<?php } ?>
     </TR><?php
}?>	
</TABLE>
