<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<?php
	$q_s_b=mysqli_query($db,"SELECT * FROM gallery where id='$id' and id_ekskul='$_SESSION[id_ekskul]'");
	
	$f_s_b=mysqli_fetch_array($q_s_b);
	if(mysqli_num_rows($q_s_b) == 0) {
		header('location:index.php');
	}
?>
<div id="right">

	<!-- box section -->
	<div class="box">
		<div class="box-head">
			Edit Gallery Ekskul <?=ekskul_name($_SESSION[id_ekskul])?>
		</div>
			
		<div class="box-content">
		<?php
			$title=addslashes(strip_tags($_POST['title']));
			$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
			
			if($_POST[edit_gallery]) {
				//img
				$img_name=$_FILES[photo][name];
				$img_type=$_FILES[photo][type];
				$img_tmp=$_FILES[photo][tmp_name];
				$img_size=$_FILES[photo][size];
				$img_ext=end(explode(".",$_FILES[photo][name]));

				$allow_ext=array("jpg","jpeg","png","gif");
				$allow_type=array("image/jpg","image/jpeg","image/png","image/gif");
				
				$path="img/";
				
				if($title!=""){
					$photo=$f_s_b[photo];
					if($img_tmp!="") {
						if(in_array($img_ext,$allow_ext) && in_array($img_type,$allow_type) && $img_size <= 1000000) {
							move_uploaded_file("$img_tmp",$path.$img_name);
							$photo=$img_name;
						}
					}
					$q_i=mysqli_query($db,"UPDATE gallery SET title = '$title',path_photo='$photo',date=now() where id='$id' AND id_ekskul='$_SESSION[id_ekskul]'");
					header('location:index.php?page=gallery&action=list');
				} else {
					validation::invalid("Form Yang Bertanda * Wajib Diisi!<br>");
				}
				
			} 
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["add-form"]["title"].value;
				if(f=="" || f==null) {
					alert("Form Yang Bertanda * Wajib Diisi!");
					return false;
				}
			}
		</script>
			<form action="" method="post" name="add-form" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td width="20%">Title *</td>
						<td width="80%"><input type="text" value="<?=$f_s_b[title]?>" name="title" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Photo</td>
						<td width="80%"><img src="img/<?=$f_s_b[path_photo]?>" width="200" height="200"><input type="file" name="photo" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Save" name="edit_gallery" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>