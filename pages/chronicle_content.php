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
            
			if($word_count > 1000 && $word_count > 1250)
			{

				echo "<ul id=\'page_list\'>";

				$pageCount = round(($char_count / 3000), 0, PHP_ROUND_HALF_UP);

				if($pageCount > 4 && $_GET['page'] >= 4)
				{

					echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>First</a></li><li class='ellipses'>...</li>";

					for($i = $_GET['page'] - 2; $i < $_GET['page'] + 2; $i++)
					{

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

					}

				}

				if($pageCount <= 4)
				{

					for($i = 1; $i <= $pageCount; $i++)
					{

						echo "<li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}'>{$i}</a></li>";

					}

				}

				if($pageCount > 4 && $_GET['page'] <= $pageCount - 4)
				{

					echo "<li class='ellipses'>...</li><li class='page_list_num'><a href='http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$pageCount}'>Last</a></li>";

				}

				echo "</ul>";

			}
            
		}        
        
	?>
</div>