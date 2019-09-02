<div class="clearfix_left"></div>
<div id="settings_bar" class="dfs">
    <div id="settings_label">Site Settings</div>
    <ul id="settings_list">
		<li id="background_form">
			Easy Reading: <input type="checkbox" name="background_checkfield" id="background_check" onchange="changeBackground(this)"/>
		</li>
		<li id="curlyquote_form">
			Curly Quotes: <input type="checkbox" name="curlyquote_checkfield" id="curlyquote_check" onchange="changeQuotes(this)"/>
		</li>
		<?php
		
			if(basename($_SERVER["PHP_SELF"]) == "chronicle.php")
			{
				
				echo "<li id=\"disablepins_form\">
						Pins: <input type=\"checkbox\" name=\"disablepins_checkfield\" id=\"disablepins_check\" onchange=\"changePins(this)\"/>
					</li>";
				echo "<li id=\"disablespoilers_form\">
						Spoilers: <input type=\"checkbox\" name=\"disablespoilers_checkfield\" id=\"disablespoilers_check\" onchange=\"changeSpoilers(this)\"/>
					</li>";
									
			}
		
		?>
	
		
    </ul>
</div>