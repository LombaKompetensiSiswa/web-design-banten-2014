<div id="left">
	
	<!-- box section -->
	<div class="box">
		<?php
			if($_POST[login]) {
				$usn=addslashes(strip_tags($_POST['username']));
				$psw=addslashes(strip_tags(md5($_POST['password'])));
				
				$q_s=mysqli_query($db,"SELECT * FROM users where username = '$usn' and password = '$psw' and status = 1");
				$f_s=mysqli_fetch_array($q_s);
				if(mysqli_num_rows($q_s) > 0) {
					$valid=1;
				} else {
					$valid=0;
				}
				
			/*	if($valid==2) {
					$_SESSION[user_id] = $f_s[id];
					$_SESSION[username] = $f_s[username];
					$_SESSION[fullname] = $f_s[fullname];

					$select = mysqli_query("SELECT * FROM db WHERE id='$id' ORDER BY id ASC");
					$q = mysql_num_rows($select);

				} */

				if($valid==1) {
					$_SESSION[usr_id]=$f_s[id];
					$_SESSION[username]=$f_s[username];
					$_SESSION[fullname]=$f_s[fullname];
					$_SESSION[id_ekskul]=$f_s[id_ekskul];
					$_SESSION[role]=$f_s[role];
					
				}
			}
		?>
		<div class="box-head">
			<?php
				if(!empty($_SESSION[role]) && $_SESSION[role]==1) {
					echo "Menu Pembina Osis";
				} else if(!empty($_SESSION[role]) && $_SESSION[role]==2) {
					echo "Menu Admin Ekskul";
				} else if(!empty($_SESSION[role]) && $_SESSION[role]==3) {
					echo "Menu Users";
				} else {
					echo "LOGIN";
				}
			?>
			
		</div>
		
		<div class="box-content">
			<?php
				if(!empty($_SESSION[role]) && $_SESSION[role]==1) {
			?>
				Hai <?=$_SESSION[fullname]?>, Anda login sebagai pembina osis! <br>
				<ul class="list">
					<li><a href="index.php?page=berita&action=list">Daftar Berita Umum</a></li>
					<!-- <li><a href="index.php?page=users&action=list">Daftar Admin Ekskul</a></li>-->
					<li><a href="logout.php" onclick="return confirm('Yakin ingin keluar?');" >Keluar</a></li>
				</ul>
			<?php
				} else if(!empty($_SESSION[role]) && $_SESSION[role]==2) {
			?>
				Hai <?=$_SESSION[fullname]?>, Anda login sebagai admin ekskul <?=ekskul_name($_SESSION[id_ekskul])?> <br>
				<ul class="list">
					<li><a href="index.php?page=ekskul&action=view&id=<?=$_SESSION[id_ekskul]?>">Ekskul Profile</a></li>
					<li><a href="index.php?page=siswa&action=list">Daftar Siswa Ekskul</a></li>
					<li><a href="index.php?page=berita&action=list">Daftar Berita Ekskul</a></li>
					<li><a href="index.php?page=prestasi&action=list">Daftar Prestasi Ekskul</a></li>
					<li><a href="index.php?page=gallery&action=list">Daftar Gallery Ekskul</a></li>
					<li><a href="logout.php" onclick="return confirm('Yakin ingin keluar?');" >Keluar</a></li>
				</ul>
			<?php
				} else if(!empty($_SESSION[role]) && $_SESSION[role]==3) {
			?>
				<ul class="list">
					<li><a href="index.php?page=profile">Profile</a></li>
					<li><a href="logout.php" onclick="return confirm('Yakin ingin keluar?');" >Keluar</a></li>
				</ul>
			<?php
				} else {
			?>
			<form action="" method="POST">
				<table width="100%">
					<tr>
						<td>Username<input type="text" placeholder="Username" autocomplete="off" name="username" class="form-txt" style="width:90%;float:left"></td>
					</tr>
					<tr>
						<td>Password<input type="password" placeholder="Password" name="password" class="form-txt" style="width:90%;float:left"></td>
					</tr>
					<tr>
						<td><input type="submit" value="LOGIN!" name="login" class="form-btn" style="margin-top:10px;float:left"><br><a href="index.php?page=siswa&action=add" class="link">Register</a></td>
					</tr>
				</table>
			</form>
			<?php
				}
			?>
		</div>
	</div>
	<?php
		if($page=="berita") {
			echo "";
		} else {
	?>
		<div class="box">
			<div class="box-head">
				CARI BERITA
			</div>
			<div class="box-content">
				test
			</div>
		</div>
		
		<div class="box">
			<div class="box-head">
				CARI BERITA
			</div>
			
			<div class="box-content">
				<form action="index.php?page=berita" method="POST">
					<table width="100%">
						<tr>
							<td>Keyword<input type="text" placeholder="Keyword" name="keyword" class="form-txt" style="width:90%;float:left"></td>
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
							<td><input type="submit" value="Cari!" name="search_advance" class="form-btn" style="margin-top:10px;float:left"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	<?php
		}
	?>
	
	<div class="box">
		<div class="box-head">
			STATISTIK
		</div>
		
		<div class="box-content">
			<table width="100%">
				<tr>
					<td width="40%">Tannggal</td>
					<td width="65%">: <?=date('D, d M Y');?></td>
				</tr>
				<tr>
					<td width="35%">Total Berita</td>
					<td width="65%">: <?php echo mysqli_num_rows(mysqli_query($db,"SELECT * FROM berita"))?></td>
				</tr>
				<tr>
					<td width="35%">Total Gallery</td>
					<td width="65%">: <?php echo mysqli_num_rows(mysqli_query($db,"SELECT * FROM gallery"))?></td>
				</tr>
				<tr>
					<td width="35%">Total Siswa</td>
					<td width="65%">: <?php echo mysqli_num_rows(mysqli_query($db,"SELECT * FROM users where role = 3"))?></td>
				</tr>
				<tr>
					<td width="35%">Pengunjung</td>
					<td width="65%">: 
						<?php
							$q_i=mysqli_query($db,"INSERT INTO pengunjung SET ip = '$_SERVER[REMOTE_ADDR]'");
							echo mysqli_num_rows(mysqli_query($db,"SELECT * FROM pengunjung"));
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- /box section -->
	
</div>