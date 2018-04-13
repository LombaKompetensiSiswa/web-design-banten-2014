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
			Tambah Prestasi Ekskul <?=ekskul_name($_SESSION[id_ekskul])?>.
		</div>
			
		<div class="box-content">
		<?php
			$title=addslashes(strip_tags($_POST['title']));
			$content=addslashes(strip_tags($_POST['content']));
			
			if($_POST[add_prestasi]) {
				if($title!="" && $content!=""){
					$q_i=mysqli_query($db,"INSERT into prestasi SET title = '$title',content='$content',id_ekskul='$_SESSION[id_ekskul]',date=now();");
					validation::valid("Berhasil Menambahkan Prestasi Ekskul ".ekskul_name($_SESSION[id_ekskul]));
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
						<td width="80%"><input type="text" name="title" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Content *</td>
						<td width="80%" height="100">
							<textarea name="content" cols="70" rows="5"></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Add!" name="add_prestasi" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>