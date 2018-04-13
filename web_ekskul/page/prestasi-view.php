<?php
	$q=mysqli_query($db,"SELECT * FROM prestasi where id='$id'");
	$f=mysqli_fetch_array($q);
	if(mysqli_num_rows($q) == 0) {
?>
		<div id="right">

			<!-- box section -->
			<div class="box">
				<div class="box-content">
					<?php echo validation::invalid("Prestasi Tidak ada");?>
					
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
				Prestasi
			</div>
			
			<div class="box-content">
				<div class="while_post-view">
					<!-- while_post_content title section -->
					<div class="title">
						<?=$f[title]?>
					</div>
					<!-- /while_post_content title section -->
					
					<!-- while_post_content info section -->
					<div class="info">
						Ekskul <a href="index.php?page=ekskul&action=view&id=<?=$f[id_ekskul]?>"><?=ekskul_name("$f[id_ekskul]")?></a>.
					</div>
					<!-- /while_post_content info section -->
					
					<div class="while_post_content">
						
						<!-- while_post_content desc section -->
						<div class="desc">
							  <?=$f[content]?>
						</div>
						<!-- /while_post_content desc section -->
						
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
<?php	
	}
?>