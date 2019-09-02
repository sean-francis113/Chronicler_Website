<table id="update_table" class="dfs">

	<tr>
	
		<th colspan="2">Latest News</th>
	
	</tr>

	<?php

		if($css_testing == false)
		{
		
			$update_retval = mysqli_query($conn, "SELECT * FROM chronicler_news ORDER BY news_time DESC");
			$MAX_ROW_COUNT = 5;
			
			for($i = 0; $i < $MAX_ROW_COUNT; $i+=1){
			
				$update_row = mysqli_fetch_array($update_retval);
				
				if($update_row){
			
					$date = date_format(date_create($update_row['news_time']), 'm-d-Y H:i:s e');
					$update = (string)$update_row['news_description'];
					
					echo "<tr><td id=\"update_time\"><span>{$date}</span></td><td id=\"update_description\"><span>{$update}</span></td></tr>";
					
				}	
				
			}
			
		}

	?>

</table>