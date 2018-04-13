<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<?php
	$q=mysqli_query($db,"SELECT * FROM ekskul where id='$_SESSION[id_ekskul]'");
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
				Edit Profile Ekskul <?=$f[title]?>. 
			</div>
			<?php
				$title=addslashes(strip_tags($_POST['title']));
				$profile=addslashes(strip_tags($_POST['profile']));
				
				if($_POST[edit_ekskul]) {
					if($title!="" && $profile!=""){
						$q_i=mysqli_query($db,"UPDATE ekskul SET title = '$title',profile='$profile' where id='$_SESSION[id_ekskul]'");
						header('location:index.php?page=ekskul&action=view&id='.$_SESSION[id_ekskul]);
						
					} else {
						validation::invalid("Form Yang Bertanda * Wajib Diisi!<br>");
					}
				}
			?>
			<script type="text/javascript">
				function validate() {
					var f = document.forms["edit-form"]["title","profile"].value;
					if(f=="" || f==null) {
						alert("Form Yang Bertanda * Wajib Diisi!");
						return false;
					}
				}
			</script>
			<div class="box-content">
				<form action="" method="post" name="edit-form" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td width="20%">Title *</td>
							<td width="80%"><input type="text" name="title" value="<?=$f[title]?>" class="form-txt" style="width:95%" autocomplete="off"></td>
						</tr>
						<tr>
							<td width="20%">Profile *</td>
							<td width="80%" height="100">
								<textarea name="profile" cols="70" rows="30"><?=$f[profile]?></textarea>
							</td>
						</tr>
						<tr>
							<td width="20%"></td>
							<td width="80%">
								<input type="submit" value="Save" name="edit_ekskul" onclick="return validate();" class="form-btn">
							</td>
						</tr>
					</table>
				</form>
				
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