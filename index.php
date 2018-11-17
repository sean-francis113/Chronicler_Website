<html>

<?php
    
    date_default_timezone_set('UCT');

    $conn = mysqli_connect('', '', '', '');
   
    if(! $conn ) {
        die('Could not connect: ' . mysqli_connect_error());
    }    
    
    
    $pageTitle = "Chronicler Database";
    $css = "wiki.css";

    include("pages/header.php");
    include("pages/sidebar.php");
    include("pages/index_content.php");
    include("pages/footer.php");
    
    mysqli_close($conn);

?>
    
</html>