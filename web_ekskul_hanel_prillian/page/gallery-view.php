<?php
	$q=mysqli_query($db,"SELECT * FROM gallery where id = '$id'");
	$f=mysqli_fetch_array($q);
	if(mysqli_num_rows($q) == 0) {
?>
		<div id="right">

			<!-- box section -->
			<div class="box">
				<div class="box-content">
					<?php echo validation::invalid("Gallery Tidak ada");?>
					
				</div>
			</div>
			
		</div>
<?php
	} else {
?>
	<div id="right">

		<!-- box section -->
		<div class="box">
			<div class="box-head">
				Gallery dari ekskul <?=ekskul_name($f[id])?>.
			</div>
			
			<div class="box-content">
				<table width="100%">
					<tr>
						<td width="20%">Title</td>
						<td width="80%">: <?=$f[title]?></td>
					</tr>
					<tr>
						<td width="20%">Photo</td>
						<td width="80%" height="100"><img src="img/<?=$f[path_photo]?>" width="100%"></td>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
<?php	
	}
?>