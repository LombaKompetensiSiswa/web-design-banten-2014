<!-- banner section -->
<?php
	$q_b=mysqli_query($db,"SELECT * FROM banner where id_ekskul = '$id'");
	$f_b=mysqli_fetch_array($q_b);
	if($page=="ekskul" && $action=="view") {
		echo '<div id="banner"><img src="img/'.$f_b[path].'"></div>';
	} else if($page=="home" OR $page=="") { 
?>
<script>
	$(function(){
		$('.slide img:gt(0)').hide();
		setInterval(function(){$('.slide :first-child').fadeOut().next('img').fadeIn().end().appendTo('.slide');
		},3000);
	});
</script>
<section id="banner">
	<div class="wrapper">
		<style>
			.slide { position:relative; height:200px; }
			.slide img { position:absolute; left:0; top:0; }
		</style>
		<div class="slide">
			<img src="img/banner.jpg">
			<img src="img/banner/b1.jpg">
			<img src="img/banner/b2.jpg">
			<img src="img/banner/b3.jpg">
		</div>
	</div>
</section>
<?php
	} else {
		
	}
?>
<!-- /banner section -->