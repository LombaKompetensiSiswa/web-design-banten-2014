<div id="right">

	<!-- box section -->
	
	<div class="box">
		<div class="box-head">
			Semua Berita
		</div>
	</div>

	<div class="box">
		<div class="box-content">
			<form action="" method="POST">
				<table width="100%">
					<tr>
						<td>Keyword<input type="text" value="<?=$_POST['keyword']?>" placeholder="Keyword" name="keyword" class="form-txt" style="width:96%;float:left"></td>
					</tr>
					<tr>
						<td>Kategori Ekskul
							<select class="form-txt" name="id_ekskul">
								<option value="">-- Semua Ekskul --</option>
								<option value="0">Berita Umum</option>
								<?php
									$q_e=mysqli_query($db,"SELECT * FROM ekskul order by title asc");
									while($f_e=mysqli_fetch_array($q_e)) {
										if($_POST[id_ekskul]==$f_e[id]) {
											$selected="selected=selected";
										} else {
											$selected="";
										}
										echo '<option value="'.$f_e[id].'" '.$selected.'>'.$f_e[title].'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="Filter!" name="search_advance" class="form-btn" style="margin-top:10px;float:left"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-content">
			<!-- while_post section -->
			<?php
				$q=mysqli_query($db,"SELECT * FROM berita order by id desc");
				if($_POST[search_advance]) {
					$keyword=addslashes(strip_tags($_POST['keyword']));
					$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
					$q=mysqli_query($db,"SELECT * FROM berita where (title like '%$keyword%' OR content like '%$keyword%') and id_ekskul like '%$id_ekskul%' order by id desc");
				}
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
									Ekskul <a href="index.php?page=ekskul&action=view&id=<?=$f[id_ekskul]?>"><?=ekskul_name("$f[id_ekskul]")?></a>. Date <?=$f[date]?>. By <?=user_name($f[id_user])?>.
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