<?php
	class validation {
		public function valid($text) {
			echo '<div class="valid">'.$text.'</div>';
		}
		
		public function invalid($text) {
			echo '<div class="invalid">'.$text.'</div>';
		}
	}
	//for ekskul name
	function ekskul_name($id) {
		global $db;
		$q=mysqli_query($db,"SELECT * FROM ekskul where id = '$id'");
		$f=mysqli_fetch_array($q);
		$title=$f[title];
		return $title;
	}
	
	//for user name
	function user_name($id) {
		global $db;
		$q=mysqli_query($db,"SELECT * FROM users where id = '$id'");
		$f=mysqli_fetch_array($q);
		$fullname=$f[fullname];
		return $fullname;
	}
	
	//for status name
	function status($id) {
		global $db;
		if($id==1) {
			$status='<span style="color:green">Aktif</span>';
		} else if($id==2) {
			$status='<span style="color:orange">Pending</span>';
		} else {
			$status='<span style="color:red">Inactive</span>';
		}
		return $status;
	}
?>