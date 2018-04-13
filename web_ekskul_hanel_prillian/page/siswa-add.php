<div id="right">

	<!-- box section -->
	<div class="box">
		<div class="box-head">
			Register<?=$f[fullname]?>.
		</div>
			
		<div class="box-content">
		<?php
			$usn=addslashes(strip_tags($_POST['usn']));
			$pw=addslashes(strip_tags(md5($_POST['pw'])));
			$email=addslashes(strip_tags($_POST['email']));
			$fullname=addslashes(strip_tags($_POST['fullname']));
			$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
			$profile=addslashes(strip_tags($_POST['profile']));
			
			if($_POST[register]) {
				if($usn!="" && $pw!="" && $email!="" && $fullname!="" && $id_ekskul!=""){
					$q_i=mysqli_query($db,"INSERT into users SET username = '$usn',password='$pw',email='$email',fullname='$fullname',id_ekskul='$id_ekskul',profile='$profile',status=2,role='3'");
					validation::valid("Berhasil Mendaftar, silahkan menunggu persetujuan dari admin!");
				} else {
					validation::invalid("Form Yang Bertanda * Wajib Diisi!");
				}
				
			} 
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["register-form"]["usn","pw","email","fullname","id_ekskul"].value;
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
						<td width="80%"><input type="text" name="usn" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Password *</td>
						<td width="80%"><input type="password" name="pw" class="form-txt" style="width:95%"></td>
					</tr>
					<tr>
						<td width="20%">Email *</td>
						<td width="80%"><input type="text" name="email" class="form-txt" style="width:95%"></td>
					</tr>
					<tr>
						<td width="20%">Fullname *</td>
						<td width="80%"><input type="text" name="fullname" class="form-txt" style="width:95%"></td>
					</tr>
					<tr>
						<td width="20%">Pilih Ekskul *</td>
						<td width="80%">
							<select name="id_ekskul" class="form-txt">
								<option value="">---- Pilih Ekskul ----</option>
								<?php
									$q_e=mysqli_query($db,"SELECT * FROM ekskul order by id asc");
									while($f_e=mysqli_fetch_array($q_e)) {
										echo '<option value="'.$f_e[id].'">'.$f_e[title].'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%">Profile</td>
						<td width="80%" height="100">
							<textarea name="profile" cols="70" rows="5"></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Register" name="register" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>