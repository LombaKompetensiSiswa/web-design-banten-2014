<?php
	session_start();
	if($_SESSION[role]=="" || $_SESSION[role]!=2) { 
		header('location:index.php');
	}
?>
<?php
	$q_s_b=mysqli_query($db,"SELECT * FROM users where id='$id' and id_ekskul='$_SESSION[id_ekskul]'");
	$f_s_b=mysqli_fetch_array($q_s_b);
	if(mysqli_num_rows($q_s_b) == 0) {
		header('location:index.php');
	} else {
		$q_d_b=mysqli_query($db,"DELETE FROM users where id='$id' and id_ekskul='$_SESSION[id_ekskul]'");
		header('location:index.php?page=siswa&action=list');
	}
?>