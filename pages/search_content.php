<div id="main_content" class="dfs">
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
    
	<table id='chronicle_table' class="dfs">
		<tr>
			<th id="chronicle_status_column">Chronicle Status</th>
			<th id="chronicle_name_column">Chronicle Name</th>
			<th id="chronicle_owner_column">Chronicle Owner</th>
			<th id="warning_list_column">Warnings</th>
			<th id="link_column">Link to Chronicle</th>
			<th id="date_column">Date Last Modified</th>
		</tr>
	<?php
    
		$chronicleNum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM chronicles_info WHERE is_blacklisted=false && is_private=false"))['count'];
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
                
				echo "<tr><td><span>{$openStatusStr}</span></td><td><span>{$chronicleRow['channel_name']}</span></td><td><span>{$chronicleRow['channel_owner']}</span></td><td><span>{$warningListStr}</span></td><td><span><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$chronicleRow['channel_id']}&page=1'>Link To Chronicle</a></span></td><td><span>{$date}</span></td></tr>";              
            
			}
            
		}
        
	?>
        
	</table>
        
	<?php
        
		$current_page = $_GET['page'];
		$prev_page = $current_page - 1;
		$next_page = $current_page + 1;
            
		if($chronicleNum > 20)
		{

			echo "<ul id='page_list'>";

			$page_count = round(($chronicleNum / 20), 0, PHP_ROUND_HALF_UP);

			if($page_count > 4)
			{

				if($current_page - 2 > 1)
				{
					echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page=1'>First</a></li><li class='ellipses'>...</li>";
					$start_page = $current_page - 2;
				}
				else{
					$start_page = 1;
				}

				if($current_page + 2 < $page_count)
				{
					$end_page = $current_page + 2;
				}
				else{
					$end_page = $page_count;
				}

				if($current_page != 1)
				{

					echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$prev_page}'>Previous</a></li>";

				}

				for($i = $start_page; $i <= $end_page; $i++)
				{

					if($i != $current_page)
					{
							
						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

					}
					else{
						
						echo "<li class='page_list_num'><a id='current_page' href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

					}

				}

				if($current_page != $page_count)
				{

					echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$next_page}'>Next</a></li>";

				}

				if($current_page + 2 < $page_count)
				{
					echo "<li class='ellipses'>...</li><li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$page_count}'>Last</a></li>";
				}

			}

			if($page_count <= 4)
			{

				for($i = 1; $i <= $page_count; $i++)
				{

					echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

				}

			}

			echo "</ul>";

		}      
        
	?>
</div>