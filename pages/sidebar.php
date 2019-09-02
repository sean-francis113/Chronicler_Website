<?php
	
	$atodExists = "false";
    $etohExists = "false";
    $itolExists = "false";
    $mtopExists = "false";
    $qtotExists = "false";
    $utoxExists = "false";
    $ytozExists = "false";
	$numbersExists = "false";
	$symbolsExists = "false";

	if ($css_testing == false)
	{

	    $retval = mysqli_query($conn, 'SELECT is_blacklisted, is_private, channel_name FROM chronicles_info ORDER BY channel_name');

	    if(!$retval)
	    {

	        die('Could Not Get Any Data: ' . mysqli_error($conn));

	    }

	    while($row = mysqli_fetch_array($retval))
	    {

	        if(eregi ("[a-d]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $atodExists = "true";
	        }
	        else if(preg_match ("[e-h]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $etohExists = "true";
	        }
	        else if(preg_match ("[i-l]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $itolExists = "true";
	        }
	        else if(preg_match ("[m-p]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $mtopExists = "true";
	        }
	        else if(preg_match ("[q-t]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $qtotExists = "true";
	        }
	        else if(preg_match ("[u-x]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $utoxExists = "true";
	        }
	        else if(preg_match ("[yz]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
	        {
	            $ytozExists = "true";
	        }
			else if (preg_match ("[[:digit:]]", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
			{
				
				$numbersExists = "true";
				
			}
			else if(preg_match ("/[`'\"\^~!@# $*()<>,:;{}\|]/", $row['channel_name'][0]) && !($row['is_blacklisted'] || $row['is_private']))
			{
				
				$symbolsExists = "true";
				
			}
		
		}

    }
?>

<div id="sidebar" class="dfs">
    <div id="sidebar_label">Chronicle List</div>
    <div id="sidebar_sublabel">(Sorted by Name)</div>
    <ul id="sidebar_list">
	
		<?php
		
		    if(!$atodExists && !$etohExists && !$itolExists && !$mtopExists && !$qtotExists && !$utoxExists && !$ytozExists)
			{    
        		
				echo "<li class=\"deactivated_link\">All Chronicles</li>";
				
        	}
			else{
				
				echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=all&page=1\">All Chronicles</a></li>";
				
			}
			
			
            if($atodExists == "true")
            {
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=atod&page=1\">A-D</a></li>";
            }
            else{
                echo "<li class=\"deactivated_link\">A-D</li>";
            }
        
            if($etohExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=etoh&page=1\">E-H</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">E-H</li>";
            
            }
        
            if($itolExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=itol&page=1\">I-L</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">I-L</li>";
            
            }
        
            if($mtopExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=mtop&page=1\">M-P</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">M-P</li>";
            
            }
        
            if($qtotExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=qtot&page=1\">Q-T</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">Q-T</li>";
            
            }
        
            if($utoxExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=utox&page=1\">U-X</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">U-X</li>";
            
            }
        
            if($ytozExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=ytoz&page=1\">Y-Z</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">Y-Z</li>";
            
            }
			
			if($numbersExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=ytoz&page=1\">0-9</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">0-9</li>";
            
            }
			
			if($symbolsExists == "true")
            {
                
                echo "<li class=\"activated_link\"><a href=\"http://chronicler.seanmfrancis.net/search.php?range=other&page=1\">Symbols</a></li>";
            }
            else{
                
                echo "<li class=\"deactivated_link\">Symbols</li>";
            
            }
    
        ?>
    </ul>
</div>