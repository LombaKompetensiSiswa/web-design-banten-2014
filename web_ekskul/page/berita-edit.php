<?php
	session_start();
	if($_SESSION[role]=="" || ($_SESSION[role]!=1 && $_SESSION[role]!=2)) { 
		header('location:index.php');
	}
?>
<?php
	if($_SESSION[role]==1) {
		$q_s_b=mysqli_query($db,"SELECT * FROM berita where id='$id'");
	} else if($_SESSION[role]==2) {
		$q_s_b=mysqli_query($db,"SELECT * FROM berita where id='$id' and id_ekskul='$_SESSION[id_ekskul]'");
	}
	
	$f_s_b=mysqli_fetch_array($q_s_b);
	if(mysqli_num_rows($q_s_b) == 0) {
		header('location:index.php');
	}
?>
<div id="right">

	<!-- box section -->
	<div class="box">
		<div class="box-head">
			Edit Berita
		</div>
			
		<div class="box-content">
		<?php
			$title=addslashes(strip_tags($_POST['title']));
			$content=addslashes(strip_tags($_POST['content']));
			$id_ekskul=addslashes(strip_tags($_POST['id_ekskul']));
			
			if($_POST[edit_berita]) {
				//img
				$img_name=$_FILES[photo][name];
				$img_type=$_FILES[photo][type];
				$img_tmp=$_FILES[photo][tmp_name];
				$img_size=$_FILES[photo][size];
				$img_ext=end(explode(".",$_FILES[photo][name]));

				$allow_ext=array("jpg","jpeg","png","gif");
				$allow_type=array("image/jpg","image/jpeg","image/png","image/gif");
				
				$path="img/";
				
				if($title!="" && $content!="" && $id_ekskul!=""){
					if($img_tmp!="") {
						if(in_array($img_ext,$allow_ext) && in_array($img_type,$allow_type) && $img_size <= 1000000) {
							move_uploaded_file("$img_tmp",$path.$img_name);
							$photo=$img_name;
						}
					} else {
						$photo=$f_s_b[photo];
					}
					$q_i=mysqli_query($db,"UPDATE berita SET title = '$title',content='$content',id_ekskul='$id_ekskul', photo='$photo',status=1 where id='$id' ");
					validation::valid("Berhasil Mengedit berita<br>");
				}
				
			} 
		?>
		<?php
			if($_SESSION[role]==1) {
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["add-form"]["title","content"].value;
				if(f=="" || f==null) {
					alert("Form Yang Bertanda * Wajib Diisi!");
					return false;
				}
			}
		</script>
		<?php
			} else {
		?>
		<script type="text/javascript">
			function validate() {
				var f = document.forms["add-form"]["title","content","id_ekskul"].value;
				if(f=="" || f==null) {
					alert("Form Yang Bertanda * Wajib Diisi!");
					return false;
				}
			}
		</script>
		<?php } ?>
			<form action="" method="post" name="add-form" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td width="20%">Title *</td>
						<td width="80%"><input type="text" name="title" value="<?=$f_s_b[title]?>" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%">Content *</td>
						<td width="80%" height="100">
							<textarea name="content" cols="70" rows="5"><?=$f_s_b[content]?></textarea>
						</td>
					</tr>
					<?php
						if($_SESSION[role]==1) {
					?>
					<tr>
						<td width="20%">Kategori *</td>
						<td width="80%">
							<select name="id_ekskul" class="form-txt">
								<option value="0">Berita Umum</option>
							</select>
						</td>
					</tr>
					<?php
						} else if($_SESSION[role]==2) {
					?>
					<tr>
						<td width="20%">Pilih Ekskul *</td>
						<td width="80%">
							<select name="id_ekskul" class="form-txt">
								<option value="<?=$_SESSION[id_ekskul]?>"><?=ekskul_name($_SESSION[id_ekskul])?></option>
							</select>
						</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td width="20%">Photo</td>
						<td width="80%"><img src="img/<?=$f_s_b[photo]?>" width="200" height="200"><input type="file" name="photo" class="form-txt" style="width:95%" autocomplete="off"></td>
					</tr>
					<tr>
						<td width="20%"></td>
						<td width="80%">
							<input type="submit" value="Save" name="edit_berita" onclick="return validate();" class="form-btn">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
		
</div>