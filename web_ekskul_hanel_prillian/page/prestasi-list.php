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
			Data Prestasi Ekskul <?=ekskul_name($_SESSION[id_ekskul])?>. <a href="index.php?page=prestasi&action=add"><u>Tambah Prestasi</u></a>
		</div>
	</div>
	<div class="box">
		<div class="box-content">
			<!-- while_post section -->
			
			<table class="table_data" width="100%">
				<tr>
					<th width="5%">No</th>
					<th width="39%">Title</th>
					<th width="15%">Date</th>
					<th width="15%">Kategory</th>
					<th width="10%">Action</th>
				</tr>
				<?php
					$q=mysqli_query($db,"SELECT * FROM prestasi where id_ekskul = '$_SESSION[id_ekskul]' order by id desc");
					if(mysqli_num_rows($q) > 0) {
						$x=0;
						while($f=mysqli_fetch_array($q)) {
						$x++;
				?>
				<tr>
					<td width="5%"><?=$x?></td>
					<td width="30%"><?=$f[title]?></td>
					<td width="15%"><?=$f[date]?></td>
					<td width="25%">
						<?php
							if($f[id_ekskul]==0) {
								echo "Tidak ada! (prestasi Umum)";
							} else {
								echo ekskul_name($f[id_ekskul]);
							}
						?>
					</td>
					<td width="25%">
						<a class="link" target="_blank" href="index.php?page=prestasi&action=view&id=<?=$f[id]?>" title="View">V</a> | 
						<a class="link" href="index.php?page=prestasi&action=edit&id=<?=$f[id]?>" title="Edit">E</a> | 
						<a class="link" onclick="return confirm('Yakin mau menghapus prestasi <?=$f[title]?> ?');" style="color:red" href="index.php?page=prestasi&action=delete&id=<?=$f[id]?>" title="Delete">D</a>
					</td>
				</tr>
				<?php
						}
					} else {
						echo "Data prestasi kosong";
					}
				?>
			</table>

			<!-- /while_post section -->
			
		</div>
	</div>
	<!-- /box section -->
	
</div>