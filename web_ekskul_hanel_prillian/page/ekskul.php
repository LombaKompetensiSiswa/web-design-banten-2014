<?php
	$q=mysqli_query($db,"SELECT * FROM ekskul");
	if(mysqli_num_rows($q) == 0) {
?>
		<div id="right">

			<!-- box section -->
			<div class="box">
				<div class="box-content">
					<?php echo validation::invalid("Ekskul Tidak ada");?>
					
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
				Lihat Profile ekskul.
			</div>
			
			<div class="box-content">
				<ul class="list">
					<?php
						while($f=mysqli_fetch_array($q)) {
							echo '<li><a href="index.php?page=ekskul&action=view&id='.$f[id].'">'.$f[title].'</a></li>';
						}
					?>
				</ul>
			</div>
		</div>
		
	</div>
<?php	
	}
?>