<?php
	$q=mysqli_query($db,"SELECT * FROM ekskul where id='$id'");
	$f=mysqli_fetch_array($q);
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
				Profile Ekskul <?=$f[title]?>. 
				<?php
					if($_SESSION[role]==2) {
						echo '<a href="index.php?page=ekskul&action=edit"><u>Edit</u></a>';
					}
				?>
			</div>
			
			<div class="box-content">
				<div class="while_post-view">
					
					<div class="img">
						<!-- <img src="img/"> -->
					</div>
					
					<div class="while_post_content">
						
						<!-- while_post_content desc section -->
						<div class="desc">
							  <?=nl2br($f[profile])?>
						</div>
						<!-- /while_post_content desc section -->
						
					</div>
				</div>
				
			</div>
		</div>
		<div class="box">
			<div class="box-head">
				Berita Terbaru Seputar Ekskul <?=$f[title]?>
			</div>
			
			<div class="box-content">
				<ul class="list">
					<?php
						$q_b=mysqli_query($db,"SELECT * FROM berita where id_ekskul='$f[id]'");
						if(mysqli_num_rows($q_b)== 0) {
							echo "Tidak ada berita terkait dengan ekskul ini!";
						} else {
							while($f_b=mysqli_fetch_array($q_b)) {
								echo '<li><a href="index.php?page=berita&action=view&id='.$f_b[id].'">'.$f_b[title].'</a></li>';
							}
						}
					?>
				</ul>
			</div>
		</div>
		<div class="box">
			<div class="box-head">
				Prestasi
			</div>
			
			<div class="box-content">
				<ul class="list">
					<?php
						$q_p=mysqli_query($db,"SELECT * FROM prestasi where id_ekskul='$f[id]'");
						if(mysqli_num_rows($q_p)== 0) {
							echo "Tidak ada prestasi terkait dengan ekskul ini!";
						} else {
							while($f_p=mysqli_fetch_array($q_p)) {
								echo '<li><a href="index.php?page=prestasi&action=view&id='.$f_p[id].'">'.$f_p[title].'</a></li>';
							}
						}
					?>
				</ul>
			</div>
		</div>
		
		<div class="box">
			<div class="box-head">
				Gallery Kegiatan
			</div>
			
			<div class="box-content">
				<?php
					$q_p=mysqli_query($db,"SELECT * FROM gallery where id_ekskul='$f[id]'");
					if(mysqli_num_rows($q_p)== 0) {
						echo "Tidak ada gallery terkait dengan ekskul ini!";
					} else {
						while($f_p=mysqli_fetch_array($q_p)) {
							echo '<div class="img_gal">
									<a href="index.php?page=gallery&action=view&id='.$f_p[id].'"><img src="img/'.$f_p[path_photo].'"></a>
								</div>';
						}
					}
				?>
				<div style="clear:both"></div>
			</div>
		</div>
		
	</div>
<?php	
	}
?>