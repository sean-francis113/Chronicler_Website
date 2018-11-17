<div id="main_content">
    <?php
    
        $page_title = "Chronicle Title";
        $page_content = "Chronicle Content";
    
        $info_retval = mysqli_query($conn, "SELECT is_blacklisted,channel_name,has_warnings,warning_list FROM chronicles_info WHERE channel_id=\"{$_GET['id']}\"");
        $content_retval = mysqli_query($conn, "SELECT char_count,story_content FROM {$_GET['id']}_contents");
        
        $info_row = mysqli_fetch_array($info_retval);
        $content_row = mysqli_fetch_array($content_retval);
            
        if($info_row['is_blacklisted'] == false)
        {
    
            $story_content = $content_row['story_content'];
            $char_count = $content_row['char_count'];
            $page_title = $info_row['channel_name'];

            #Create a threshold for extra pages. If the story is greater than 3000 characters, but less than 4000, then just add it to the same page, otherwise, add it to a new page.
            if($char_count > 3000 && $char_count > 4000)
            {

                if($_GET['page'] > 1)
                {
                    $start_position = 3000 * ($_GET['page'] - 1);
                }
                else
                {
                    $start_position = 1;
                }

                $page_content = substr($story_content, $start_position, 3000);

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
            
            $page_content .= "<p>" . $page_content_arr[$i] . "</p>";
            
        }
    
    ?>
    <h1 id="page_title"><?php echo $page_title; ?></h1>
    <div id="page_content"><?php echo $page_content; ?></div>
    <?php
        
        if($info_row['is_blacklisted'] == false)
        {
            
            if($char_count > 3000 && $char_count > 4000)
            {

                echo "<ul id=\'page_list\'>";

                $pageCount = round(($char_count / 3000), 0, PHP_ROUND_HALF_UP);

                if($pageCount > 4 && $_GET['page'] >= 4)
                {

                    echo "<li class=\'page_list_num\'><a href=\'http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}\'>First</a></li><li class=\'ellipses\'>...</li>";

                    for($i = $_GET['page'] - 2; $i < $_GET['page'] + 2; $i++)
                    {

                        echo "<li class=\'page_list_num\'><a href=\'http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}\'>{$i}</a></li>";

                    }

                }

                if($pageCount <= 4)
                {

                    for($i = 1; $i <= $pageCount; $i++)
                    {

                        echo "<li class=\'page_list_num\'><a href=\'http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$i}\'>{$i}</a></li>";

                    }

                }

                if($pageCount > 4 && $_GET['page'] <= $pageCount - 4)
                {

                    echo "<li class=\'ellipses\'>...</li><li class=\'page_list_num\'><a href=\'http://chronicler.seanmfrancis.net/chronicle.php?id={$_GET['id']}&page={$pageCount}\'>Last</a></li>";

                }

                echo "</ul>";

            }
            
        }        
        
    ?>
</div>