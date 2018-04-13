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
				Data dari siswa <?=$f[fullname]?>.
			</div>
			
			<div class="box-content">
				<table width="100%">
					<tr>
						<td width="20%">Username</td>
						<td width="80%">: <?=$f[username]?></td>
					</tr>
					<tr>
						<td width="20%">Email</td>
						<td width="80%">: <?=$f[email]?></td>
					</tr>
					<tr>
						<td width="20%">Fullname</td>
						<td width="80%">: <?=$f[fullname]?></td>
					</tr>
					<tr>
						<td width="20%">Ekskul</td>
						<td width="80%">: <a href="index.php?page=ekskul&action=view&id=<?=$f[id_ekskul]?>" class="link"><?=ekskul_name($f[id_ekskul])?></a></td>
					</tr>
					<tr>
						<td width="20%">Profile</td>
						<td width="80%" height="100">: <?=$f[profile]?></td>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
<?php	
	}
?>