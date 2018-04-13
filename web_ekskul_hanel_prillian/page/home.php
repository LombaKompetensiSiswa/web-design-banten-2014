<div id="right">
	<div class="box">
			<div class="box-head">
				CARI BERITA
			</div>
			<div class="box-content">
				test
			</div>
		</div>
	<!-- box section -->
	<div class="box">
		<div class="box-head">
			Selamat Datang
		</div>
		
		<div class="box-content">
			Jelajahi Ekskul Kami!<br>
			
		</div>
	</div>
	
	<div class="box">
		<div class="box-head">
			Berita Terbaru Dari Semua Ekskul
		</div>
	</div>
	
	<div class="box">
		<div class="box-content">
		
			<!-- while_post section -->
			<?php
				$q=mysqli_query($db,"SELECT * FROM berita order by id desc LIMIT 3");
				if(mysqli_num_rows($q) > 0) {
					while($f=mysqli_fetch_array($q)) {
			?>
						<div class="while_post">
							<div class="img">
								<img src="img/<?=$f[photo]?>">
							</div>
							
							<div class="while_post_content">
								
								<!-- while_post_content title section -->
								<div class="title">
									<?=$f[title]?>
								</div>
								<!-- /while_post_content title section -->
								
								
								<!-- while_post_content info section -->
								<div class="info">
								<?php
									if($f[id_ekskul]==0) {
								?>
									Berita Umum. Date <?=$f[date]?>. By <?=user_name($f[id_user])?>.
								<?php
									} else {
								?>
									Ekskul <a href="index.php?page=ekskul&action=view&id=<?=$f[id_ekskul]?>"><?=ekskul_name("$f[id_ekskul]")?></a>. Date <?=$f[date]?>. By <?=user_name($f[id_user])?>.
								<?php
									}
								?>
								</div>
								<!-- /while_post_content info section -->
								
								
								<!-- while_post_content desc section -->
								<div class="desc">
									  <?=substr("$f[content]",0,100)?>...<a class="link" href="index.php?page=berita&action=view&id=<?=$f[id]?>">Read More</a>
								</div>
								<!-- /while_post_content desc section -->
								
							</div>
						</div>
			<?php
					}
				} else {
					echo "Tidak ada berita";
				}
			?>

			<!-- /while_post section -->
			
		</div>
	</div>
	<!-- /box section -->
	
</div>