<?php

    $atodExists = "false";
    $etohExists = "false";
    $itolExists = "false";
    $mtopExists = "false";
    $qtotExists = "false";
    $utoxExists = "false";
    $ytozExists = "false";
    $retval = mysqli_query($conn, 'SELECT is_blacklisted, is_private, channel_name FROM chronicles_info ORDER BY channel_name');

    if(!$retval)
    {

        die('Could Not Get Any Data: ' . mysqli_error($conn));

    }

    while($row = mysqli_fetch_array($retval))
    {

        if((strpos(lcfirst($row['channel_name']), 'a') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'b') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'c') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'd') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $atodExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'e') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'f') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'g') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'h') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $etohExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'i') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'j') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'k') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'l') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $itolExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'm') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'n') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'o') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'p') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $mtopExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'q') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'r') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 's') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 't') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $qtotExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'u') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'v') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'w') === 0 && !($row['is_blacklisted'] || $row['is_private'])) ||
           (strpos(lcfirst($row['channel_name']), 'x') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $utoxExists = "true";
        }
        else if((strpos(lcfirst($row['channel_name']), 'y') === 0 && !($row['is_blacklisted'] || $row['is_private'])) || 
           (strpos(lcfirst($row['channel_name']), 'z') === 0 && !($row['is_blacklisted'] || $row['is_private']))
          )
        {
            $ytozExists = "true";
        }

    }
?>

<div id="sidebar">
    <div id="sidebar_label">Chronicle List</div>
    <div id="sidebar_sublabel">(Sorted by Chronicle Name)</div>
    <ul id="sidebar_list">        
        <li class = "activated_link"><a href="http://chronicler.seanmfrancis.net/search.php?range=all&page=1">All Chronicles</a></li>
        
        <?php
        
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
    
        ?>
    </ul>
</div>