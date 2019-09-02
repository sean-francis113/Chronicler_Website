<div id="main_content" class="dfs">
	<?php
        
		if ($css_testing == false)
		{
		
			$searchRange = "---";
			$findKey = "...";
	    
			if($_GET["range"] == "atod")
			{
				$searchRange = "A to D";
				$findKey = "abcd";
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
			else if($_GET["range"] == "other")
			{
				
				$searchRange = "Symbols";
				$findKey = "\[\'\"\~\!\@\#\ \$\*\(\)\<\>\,\:\;\{\}\\\|\]";
				
			}
			else if($_GET["range"] == "numbers")
			{
				
				$searchRange = "Numbers";
				$findKey = "1234567890";
				
			}
			
			else if($_GET["range"] == "all")
			{
				$searchRange = "All";
				$findKey = ".";
			}
		
		}
    
	?>
	<h1 id="page_title">Chronicle Search</h1>
	<h2 id="page_subtitle">Search Range: <?php echo $searchRange; ?></h2>
    
	<h3 id="warning_note">NOTE: The Warning Lists are currently user made and may not coincide with the contents of the Chronicle! Reader Discretion is Advised!</h3>
    
	<table id='chronicle_table' class="dfs">
		<tr>
			<th id="chronicle_name_column">Name</th>
			<th id="chronicle_owner_column">Owner</th>
			<th id="warning_list_column">Warnings</th>
			<th id="link_column">Links</th>
			<th id="date_column">Last Modified</th>
		</tr>
	<?php
	
		if ($css_testing == false)
		{
    
			$chronicleNum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM chronicles_info WHERE is_blacklisted=false && is_private=false && channel_name REGEXP '^({$findKey})'"))['count'];
			$retval = '';
			$countInEachPage = 20;
			$search_start = 0;
			$search_end = 0;

			if($_GET['page'] == 1)
			{
	            
				$retval = mysqli_query($conn, "SELECT * FROM chronicles_info WHERE channel_name REGEXP '^({$findKey})' ORDER BY channel_name LIMIT 0, 20");
	            $search_end = 19;

			}
			else
			{
	            
				$search_start = 20 * ($_GET['page'] - 1);
				$retval = mysqli_query($conn, "SELECT * FROM chronicles_info WHERE channel_name REGEXP '^({$findKey})' ORDER BY channel_name LIMIT {$search_start}, 20");
				$search_end = $search_start + 19;

			}
	        
			$i = 0;
			$chroniclePageCollection = [ "" ];
	        
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
						if($chronicleRow['is_NSFW'])
						{
							
							$warningListStr = "<span class=\"bold\">NOT SAFE FOR WORK</span>, " . $chronicleRow['warning_list'];
							
						}
						else
						{
						
							$warningListStr = $chronicleRow['warning_list'];
						
						}
						
					}
					else
					{
						
						if($chronicleRow['is_NSFW'])
						{
							
							$warningListStr = "<span class=\"bold\">NOT SAFE FOR WORK</span>";
							
						}
						
					}
	                
					$date = date_format(date_create($chronicleRow['date_last_modified']), 'm-d-Y H:i:s e');
					
					$channel_name = $chronicleRow['channel_name'];
					
					$channel_name = str_replace("<", "&lsaquo;", $channel_name);
					$channel_name = str_replace(">", "&rsaquo;", $channel_name);
	                
					echo "<tr><td><span>{$channel_name} ({$openStatusStr})</span></td><td><span>{$chronicleRow['channel_owner']}</span></td><td><span>{$warningListStr}</span></td><td><span><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$chronicleRow['channel_id']}&page=1'>Read Chronicle</a></span></td><td><span>{$date}</span></td></tr>";              
	            
				}
	            
			}
		
		}
        
	?>
        
	</table>
        
	<?php
	
		if ($css_testing == false)
		{
        
			$current_page = $_GET['page'];
			$prev_page = $current_page - 1;
			$next_page = $current_page + 1;
	            
			if($chronicleNum > $countInEachPage)
			{

				echo "<ul id='page_list'>";

				$page_count = ceil($chronicleNum / $countInEachPage);

				if($page_count > 4)
				{

					if($current_page - 2 > 1)
					{
						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page=1'>First</a></li><li class='ellipses'>...</li>";
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

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$prev_page}'>Previous</a></li>";

					}

					for($i = $start_page; $i <= $end_page; $i++)
					{

						if($i != $current_page)
						{
								
							echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$i}'>{$i}</a></li>";

						}
						else{
							
							echo "<li class='page_list_num'><a id='current_page' href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$i}'>{$i}</a></li>";

						}

					}

					if($current_page != $page_count)
					{

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$next_page}'>Next</a></li>";

					}

					if($current_page + 2 < $page_count)
					{
						echo "<li class='ellipses'>...</li><li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$page_count}'>Last</a></li>";
					}

				}

				if($page_count <= 4)
				{

					for($i = 1; $i <= $page_count; $i++)
					{

						if($i != $current_page)
						{
						
							echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$i}'>{$i}</a></li>";
						
						}
						else {

							echo "<li class='page_list_num'><a id='current_page' href='http://chronicler.seanmfrancis.net/search.php?range={$_GET['range']}&page={$i}'>{$i}</a></li>";

						}

					}

				}

				echo "</ul>";

			}
		
		}      
        
	?>
</div>