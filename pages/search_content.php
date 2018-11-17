<div id="main_content">
    <?php
        
        $searchRange = "---";
        $findKey = "...";
    
        if($_GET["range"] == "atod")
        {
            $searchRange = "A to D";
            $findKey = "abc";
        }
        else if($_GET["range"] == "etoh")
        {
            $searchRange = "E to H";
            $findKey = "efgh";
        }
        else if($_GET["range"] == "itol")
        {
            $searchRange = "I to L";
            $findKey = "ijkl";
        }
        else if($_GET["range"] == "mtop")
        {
            $searchRange = "M to P";
            $findKey = "mnop";
        }
        else if($_GET["range"] == "qtot")
        {
            $searchRange = "Q to T";
            $findKey = "qrst";
        }
        else if($_GET["range"] == "utox")
        {
            $searchRange = "U to X";
            $findKey = "uvwx";
        }
        else if($_GET["range"] == "ytoz")
        {
            $searchRange = "Y to Z";
            $findKey = "yz";
        }
        else if($_GET["range"] == "all")
        {
            $searchRange = "All";
            $findKey = "abcdefghijklmnopqrstuvwxyz";
        }
    
    ?>
    <h1 id="page_title">Chronicle Search</h1>
    <h2 id="page_subtitle">Search Range: <?php echo $searchRange; ?></h2>
    
    <h3 id="warning_note">NOTE: The Warning Lists are currently user made and may not coincide with the contents of the Chronicle! Reader Discretion is Advised!</h3>
    
    <table id='chronicle_table'>
        <tr>
            <th>Chronicle Status</th>
            <th>Chronicle Name</th>
            <th>Chronicle Owner</th>
            <th>Warnings</th>
            <th>Link to Chronicle</th>
            <th>Date Last Modified</th>
        </tr>
    <?php
    
        $chronicleNum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM chronicles_info"))['count'];
        $retval = '';
        if($_GET['page'] == 1)
        {
            
            $retval = mysqli_query($conn, "SELECT * FROM chronicles_info WHERE channel_name REGEXP '^[{$findKey}]' LIMIT 0, 20");
            
        }
        else
        {
            
            $retval = mysqli_query($conn, "SELECT * FROM chronicles_info WHERE channel_name REGEXP '^[{$findKey}]' LIMIT (20*({$_GET['page']})), 20");
        
        }
        
        $i = 0;
        $chroniclePageCollection = [ "" ];
        $countInEachPage = 20;
        
        while($chronicleRow = mysqli_fetch_array($retval))
        {
            
            $warningListStr = "No Warnings Listed";
            $openStatusStr = "Open";
                
            if(!$chronicleRow['is_private'] && !$chronicleRow['is_blacklisted'])
            {
                
                if($chronicleRow['is_closed'])
                {
                    $openStatusStr = "Closed";                    
                }
            
                if($chronicleRow['has_warnings'])
                {
                    $warningListStr = $chronicleRow['warning_list'];
                }
                
                $date = date_format(date_create($chronicleRow['date_last_modified']), 'm-d-Y H:i:s e');
                
                echo "<tr class='data_row'><td class='channel_status_data'>{$openStatusStr}</td><td class='channel_name_data'>{$chronicleRow['channel_name']}</td><td class='channel_owner_data'>{$chronicleRow['channel_owner']}</td><td class='warning_list_data'>{$warningListStr}</td><td class='link_data'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$chronicleRow['channel_id']}&page=1'>Link To Chronicle</a></td><td class='date_data'>{$date}</td></tr>";              
            
            }
            
        }
        
    ?>
        
    </table>
        
    <?php
    
        if($chronicleNum > 20)
        {
            
            echo "<ul id=\'pageList\'>";
                
            $pageCount = round(($chronicleNum / 20), 0, PHP_ROUND_HALF_UP);
            
            if($pageCount > 4 && $_GET['page'] >= 4)
            {
                
                echo "<li class=\'pageListNum\'><a href=\'http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page=1\'>First</a></li><li class=\'ellipses\'>...</li>";
                
                for($i = $_GET['page'] - 2; $i < $_GET['page'] + 2; $i++)
                {
                    
                    echo "<li class=\'pageListNum\'><a href=\'http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page=1\'>{$i}</a></li>";
                    
                }
                
            }
            
            if($pageCount <= 4)
            {
                
                for($i = 1; $i <= $pageCount; $i++)
                {
                    
                    echo "<li class=\'pageListNum\'><a href=\'http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page=1\'>{$i}</a></li>";
                    
                }
                
            }
            
            if($pageCount > 4 && $_GET['page'] <= $pageCount - 4)
            {
                
                echo "<li class=\'\ellipses'>...</li><li class=\'pageListNum\'><a href=\'http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$pageCount}\'>Last</a></li>";
                
            }
            
            echo "</ul>";
            
        }
    
    ?>
    
    
</div>