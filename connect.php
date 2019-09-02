<?php

	$css_testing = false;

	if ($css_testing == false)
	{

		$conn = mysqli_connect('localhost', 'smfranci_chronicler_reader', '2MR3WmqQPjqwwh9', 'smfranci_chronicler_collection');
	    #$conn = mysqli_connect('localhost', 'root', '', 'smfranci_chronicler_collection');
	   
	    if(!$conn ) {
	        die('Could not connect: ' . mysqli_connect_error());
	    }
	
	}

?>