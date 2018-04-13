<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<?php
	$q=mysqli_query($db,"SELECT * FROM prestasi where id = '$id' and id_ekskul='$_SESSION[id_ekskul]'");
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
			Edit Prestasi Ekskul <?=ekskul_name($_SESSION[id_ekskul])?>.
		</div>
			
		<div class="box-content">
		<?php
			$title=addslashes(strip_tags($_POST['title']));
			$content=addslashes(strip_tags($_POST['content']));
			
			if($_POST[edit_prestasi]) {
				if($title!="" && $content!=""){
					$q_i=mysqli_query($db,"UPDATE prestasi SET title = '$title',content='$content',id_ekskul='$_SESSION[id_ekskul]',date=now() where id = '$id' and id_ekskul='$_SESSION[id_ekskul]' ");
					header('location:index.php?page=prestasi&action=list');
				} else {
					validation::invalid("Form Yang Bertanda * Wajib Diisi!");
				}
				
			} 
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["register-form"]["title","content"].value;
				if(f=="" || f==null) {
					alert("Form Yang Bertanda * Wajib Diisi!");
					return false;
				}
			}
		</script>
			<form action="" method="post" name="register-form">
				<table width="100%">
					<tr>
						<td width="20%">Title *</td>
						<td width="80%"><input type="text" name="title" value="<?=$f[title]?>" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Content *</td>
						<td width="80%" height="100">
							<textarea name="content" cols="70" rows="5"><?=$f[title]?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Add!" name="edit_prestasi" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>
<?php } ?>