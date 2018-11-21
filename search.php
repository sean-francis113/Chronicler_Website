<html>

<?php

    date_default_timezone_set('UCT');
    
    $conn = mysqli_connect('', '', '', '');

    if(! $conn ) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    include("pages/header.php");
    include("pages/sidebar.php");
    include("pages/search_content.php");
    include("pages/footer.php");
	include("scripts/dynamic_adjust.php");
	
	mysqli_close($conn);

?>
    
</html>