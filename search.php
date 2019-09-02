<html>

<?php

    date_default_timezone_set('GMT');
    
    include("connect.php");

    include("pages/header.php");
?>

<ul id="sideblocks">
	<li><?php include("pages/sidebar.php"); ?></li>
	<li><?php include("pages/settings_bar.php"); ?></li>
</ul>

<?php    include("pages/search_content.php");
    include("pages/footer.php");
	include("scripts/dynamic_adjust.php");
	include("scripts/cookies.php");
	include("scripts/alter_page.php");
	include("scripts/final_checks.php");
	
	mysqli_close($conn);

?>
    
</html>