<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<?php
	$q=mysqli_query($db,"SELECT * FROM users where role = '3' and id = '$id'");
	$f=mysqli_fetch_array($q);
	if(mysqli_num_rows($q) == 0) {
?>
		<div id="right">

			<!-- box section -->
			<div class="box">
				<div class="box-content">
					<?php echo validation::invalid("Siswa Tidak ada");?>
					
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
			Edit siswa ekskul <?=$f[fullname]?>.
		</div>
			
		<div class="box-content">
		<?php
			$usn=addslashes(strip_tags($_POST['usn']));
			$email=addslashes(strip_tags($_POST['email']));
			$fullname=addslashes(strip_tags($_POST['fullname']));
			$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
			$status=addslashes(strip_tags($_POST['status']));
			$profile=addslashes(strip_tags($_POST['profile']));
			
			if($_POST[save_siswa]) {
				if($usn!="" && $email!="" && $fullname!="" && $id_ekskul!="" && $status!=""){
					$q_i=mysqli_query($db,"UPDATE users SET username = '$usn',email='$email',fullname='$fullname',id_ekskul='$id_ekskul',profile='$profile',status='$status',role='3' where id_ekskul='$id_ekskul' and id='$id'");
					validation::valid("Berhasil Mengedit siswa!.");
					header('location:index.php?page=siswa&action=list');
				} else {
					validation::invalid("Form Yang Bertanda * Wajib Diisi!");
				}
				
			} 
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["register-form"]["usn","email","fullname","id_ekskul","status"].value;
				if(f=="" || f==null) {
					alert("Form Yang Bertanda * Wajib Diisi!");
					return false;
				}
			}
		</script>
			<form action="" method="post" name="register-form">
				<table width="100%">
					<tr>
						<td width="20%">Username *</td>
						<td width="80%"><input type="text" name="usn" value="<?=$f[username]?>" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Email *</td>
						<td width="80%"><input type="text" name="email" value="<?=$f[email]?>" class="form-txt" style="width:95%"></td>
					</tr>
					<tr>
						<td width="20%">Fullname *</td>
						<td width="80%"><input type="text" name="fullname" value="<?=$f[fullname]?>" class="form-txt" style="width:95%"></td>
					</tr>
					<tr>
						<td width="20%">Pilih Ekskul *</td>
						<td width="80%">
							<select name="id_ekskul" class="form-txt">
								<option value="<?=$f[id_ekskul]?>"><?=ekskul_name($f[id_ekskul])?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%">Status *</td>
						<td width="80%">
							<select name="status" class="form-txt">
								<?php
									for($x=1;$x <= 3;$x++) {
										if($f[status]==$x) {
											$selected="selected=selected";
										} else {
											$selected="";
										}
										echo '<option value="'.$x.'" '.$selected.'>'.status($x).'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%">Profile</td>
						<td width="80%" height="100">
							<textarea name="profile" cols="70" rows="5"><?=$f[profile]?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Save" name="save_siswa" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>
<?php	
	}
?>