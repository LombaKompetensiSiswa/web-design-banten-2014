<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<div id="right">
	<!-- box section -->
	<div class="box">
		<div class="box-head">
			Data Siswa Ekskul <?=ekskul_name($_SESSION[id_ekskul])?>. <a href="index.php?page=siswa&action=add"><u>Tambah Siswa</u></a>
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
						<td>Dari Ekskul
							<select class="form-txt" name="id_ekskul">
								<option value="">-- Semua Ekskul --</option>
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
						<td>Username Berdasarkan Alphabetic
							<select class="form-txt" name="alpha">
								<option value="">-- Semua Alphabet --</option>
								<?php
									$alpha=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
									$c_a=count($alpha);
									for($x=0;$x < $c_a;$x++) {
										if($_POST[alpha]==$alpha[$x]) {
											$selected="selected=selected";
										} else {
											$selected="";
										}
										echo '<option value="'.$alpha[$x].'" '.$selected.'>'.$alpha[$x].'</option>';
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
			<table class="table_data" width="100%">
				<tr>
					<th width="5%">No</th>
					<th width="15%">Username</th>
					<th width="25%">Fullname</th>
					<th width="33%">Email</th>
					<th width="10%">Status</th>
					<th width="10%">Action</th>
				</tr>
				<?php
					$q=mysqli_query($db,"SELECT * FROM users where role='3' and id_ekskul = '$_SESSION[id_ekskul]' order by id desc");
					if($_POST[search_advance]) {
						$keyword=addslashes(strip_tags($_POST['keyword']));
						$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
						$alpha=addslashes(strip_tags($_POST['alpha']));
						$q=mysqli_query($db,"SELECT * FROM users where (username like '%$keyword%' OR email like '%$keyword%' OR fullname like '%$keyword%') and LEFT(username,1) like '%$alpha%' and id_ekskul like '%$id_ekskul%' and role = '3' order by id desc");
					}
					if(mysqli_num_rows($q) > 0) {
						$x=0;
						while($f=mysqli_fetch_array($q)) {
						$x++;
				?>
				<tr>
					<td width="5%"><?=$x?></td>
					<td width="10%"><?=$f[username]?></td>
					<td width="15%"><?=$f[fullname]?></td>
					<td width="25%"><?=$f[email]?></td>
					<td><?=status($f[status])?></td>
					<td width="25%">
						<a class="link" target="_blank" href="index.php?page=siswa&action=view&id=<?=$f[id]?>" title="View">V</a> | 
						<a class="link" href="index.php?page=siswa&action=edit&id=<?=$f[id]?>" title="Edit">E</a> | 
						<a class="link" onclick="return confirm('Yakin mau menghapus siswa <?=$f[fullname]?> ?');" style="color:red" href="index.php?page=siswa&action=delete&id=<?=$f[id]?>" title="Delete">D</a>
					</td>
				</tr>
				<?php
						}
					} else {
						echo "Data siswa kosong";
					}
				?>
			</table>

			<!-- /while_post section -->
			
		</div>
	</div>
	<!-- /box section -->
	
</div>