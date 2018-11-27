<div id="main_content" class="dfs">
	<?php
    
		$page_title = "Chronicle Title";
		$page_content = "Chronicle Content";
    
		$info_retval = mysqli_query($conn, "SELECT is_blacklisted,channel_name,has_warnings,warning_list FROM chronicles_info WHERE channel_id=\"{$_GET['id']}\"");
		$content_retval = mysqli_query($conn, "SELECT * FROM {$_GET['id']}_contents");
        
		$info_row = mysqli_fetch_array($info_retval);
		$content_row = mysqli_fetch_array($content_retval);
            
		if($info_row['is_blacklisted'] == false)
		{
    
			$story_content = $content_row['story_content'];
			$char_count = $content_row['char_count'];
			$word_count = $content_row['word_count'];
			$page_title = $info_row['channel_name'];

			#Create a threshold for extra pages. If the story is greater than 1000 words, but less than 1250, then just add it to the same page, otherwise, add it to a new page.
			if($word_count > 1000 && $word_count > 1250)
			{
				
				$word_arr = preg_split('/ /', $story_content);

				if($_GET['page'] > 1)
				{

					$start_position = 1000 * ($_GET['page'] - 1);

				}
				else
				{

					$start_position = 0;
				
				}

				if($start_position + 1000 < (count($word_arr) - 1))
				{
					
					$end_position = $start_position + 1000;

				}
				else{
					
					$end_position = count($word_arr) - 1;

				}

				$page_content = "";

				for($i = $start_position; $i <= $end_position; $i++)
				{
					if($i != $end_position)
					{

						$page_content .= $word_arr[$i] . " ";

					}
					else
					{
					
						$page_content .= $word_arr[$i];

					}
				}

			}
			else
			{

				$page_content = $story_content;

			}
            
		}
		else
		{
        
			$page_title = "Unavailable";
			$page_content = "This Chronicle has been blacklisted, never to be read again.";
        
		}
    
		$page_content_arr = preg_split('/\r\n|\r|\n/', $page_content);
		$page_content = "";
        
		for($i = 0; $i < count($page_content_arr); $i++)
		{
            
			$page_content .= "<p class='dfs'>" . $page_content_arr[$i] . "</p>";
            
		}
    
	?>
	<h1 id="page_title"><span><?php echo $page_title; ?></span></h1>
	<div id="page_content"><?php echo $page_content; ?></div>
	<?php
        
		if($info_row['is_blacklisted'] == false)
		{

			$current_page = $_GET['page'];
			$prev_page = $current_page - 1;
			$next_page = $current_page + 1;
            
			if($word_count > 1000 && $word_count > 1250)
			{

				echo "<ul id='page_list'>";

				$page_count = round(($word_count / 1000), 0, PHP_ROUND_HALF_UP);

				if($page_count > 4)
				{

					if($current_page - 2 > 1)
					{
						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page=1'>First</a></li><li class='ellipses'>...</li>";
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

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$prev_page}'>Previous</a></li>";

					}

					for($i = $start_page; $i <= $end_page; $i++)
					{

						if($i != $current_page)
						{
							
							echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

						}
						else{
						
							echo "<li class='page_list_num'><a id='current_page' href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

						}

					}

					if($current_page != $page_count)
					{

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$next_page}'>Next</a></li>";

					}

					if($current_page + 2 < $page_count)
					{
						echo "<li class='ellipses'>...</li><li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$page_count}'>Last</a></li>";
					}

				}

				if($page_count <= 4)
				{

					for($i = 1; $i <= $page_count; $i++)
					{

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

					}

				}

				echo "</ul>";

			}
            
		}        
        
	?>
</div>