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
	} else {
		if($_SESSION[role]==1) {
			$q_d_b=mysqli_query($db,"DELETE FROM berita where id='$id'");
		} else if($_SESSION[role]==2) {
			$q_s_b=mysqli_query($db,"DELETE FROM berita where id='$id' and id_ekskul='$_SESSION[id_ekskul]'");
		}
		unlink("img/$f_s_b[photo]");
		header('location:index.php?page=berita&action=list');
	}
?>