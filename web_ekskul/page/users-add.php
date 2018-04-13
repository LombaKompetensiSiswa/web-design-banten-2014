<?php
	
?>
	<div id="right">

		<!-- box section -->
		<div class="box">
			<div class="box-head">
				Register<?=$f[fullname]?>.
			</div>
			
			<div class="box-content">
				<form action="" method="post">
					<table width="100%">
						<tr>
							<td width="20%">Username</td>
							<td width="80%"><input type="text" name="usn" class="form-txt" style="width:95%" autocomplete="off"></td>
						</tr>
						<tr>
							<td width="20%">Password</td>
							<td width="80%"><input type="password" name="pw" class="form-txt" style="width:95%"></td>
						</tr>
						<tr>
							<td width="20%">Email</td>
							<td width="80%"><input type="text" name="email" class="form-txt" style="width:95%"></td>
						</tr>
						<tr>
							<td width="20%">Fullname</td>
							<td width="80%"><input type="text" name="fullname" class="form-txt" style="width:95%"></td>
						</tr>
						<tr>
							<td width="20%">Pilih Ekskul</td>
							<td width="80%">
								
							</td>
						</tr>
						<tr>
							<td width="20%">Profile</td>
							<td width="80%" height="100">: <?=$f[profile]?></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
	</div>