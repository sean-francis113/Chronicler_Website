<script>

	function changeBackground(checkbox)
	{
	
		if(checkbox == null)
			return;
	
		var background_css = document.getElementById("main_content").style;
		var sidebar_css = document.getElementById("sidebar").style;
		var settings_bar_css = document.getElementById("settings_bar").style;
		var header_css = document.getElementById("site_header").style;
		var footer_css = document.getElementById("site_footer").style;
		
		if(checkbox.checked){
			
			background_css.backgroundImage = "none";
			background_css.backgroundColor = "white";
			
			sidebar_css.backgroundImage = "none";
			sidebar_css.backgroundColor = "white";
			
			settings_bar_css.backgroundImage = "none";
			settings_bar_css.backgroundColor = "white";
			
			header_css.backgroundImage = "none";
			header_css.backgroundColor = "white";
			
			footer_css.backgroundImage = "none";
			footer_css.backgroundColor = "white";
			
			setCookie("easyReadBG", "true", 365);
			
		}
		else
		{
			
			background_css.backgroundImage = "url('../img/seamless_paper.jpg')";
			background_css.backgroundColor = "none";
			
			sidebar_css.backgroundImage = "url('../img/seamless_paper.jpg')";
			sidebar_css.backgroundColor = "none";
			
			settings_bar_css.backgroundImage = "url('../img/seamless_paper.jpg')";
			settings_bar_css.backgroundColor = "none";
			
			header_css.backgroundImage = "url('../img/seamless_paper.jpg')";
			header_css.backgroundColor = "none";
			
			footer_css.backgroundImage = "url('../img/seamless_paper.jpg')";
			footer_css.backgroundColor = "none";
			
			setCookie("easyReadBG", "false", 365);
		
		}
		
	}
	
	function changeQuotes(checkbox)
	{
	
		if(checkbox == null)
			return;
	
		var main_content = document.getElementById("main_content");
		var original_string = main_content.innerHTML;
		var altered_string = original_string;
		
		if(checkbox.checked)
		{
		
			var lastPosChecked = 0;
			var ignoreNextDouble = false;
			var ignoreNextSingle = false;
			var tagLabels = ["href=", "class=", "id=", "style=", "src=", "download=", "hidden=", "alt="];
			
			while(altered_string.indexOf("\"", lastPosChecked) != -1) 
			{
				
				var startDQuote = altered_string.indexOf("\"", lastPosChecked);
				var withinTag = false;
				
				if(ignoreNextDouble)
				{
					
					ignoreNextDouble = false;
					lastPosChecked = startDQuote + 1;
					continue;
					
				}
				
				tagLabels.forEach(function(element){
				
					var offset = element.length;
					var pos = altered_string.indexOf(element, lastPosChecked);
				
					if(startDQuote - offset == pos)
					{
						
						withinTag = true;
						
					}
					
				});
				
				if(!withinTag)
				{
				
					var endDQuote = altered_string.indexOf("\"", startDQuote + 1);
					
					if(endDQuote > startDQuote)
					{	
					
						var endWithinTag = false;
					
						tagLabels.forEach(function(element){
				
							var offset = element.length;
							var pos = altered_string.indexOf(element, startDQuote + 1);
						
							if(endDQuote - offset == pos)
							{
								
								endWithinTag = true;
								
							}
							
						});
						
						if(!endWithinTag)
						{
					
							var before_quote = altered_string.substring(0, startDQuote);
							var between_quote = altered_string.substring(startDQuote + 1, endDQuote);
							var after_quote = altered_string.substring(endDQuote + 1);
						
							altered_string = before_quote.concat("&ldquo;", between_quote, "&rdquo;", after_quote);
							ignoreNextDouble = false;						
							replacedString = true;
						
						}
						
						lastPosChecked = endDQuote + 1;
						
					}
				
				}
				else
				{
					
					ignoreNextDouble = true;
					lastPosChecked = startDQuote + 1;
					
				}
				
				main_content.innerHTML = altered_string;
				
				if(lastPosChecked >= main_content.length)
				{
					
					break;
					
				}
				
			}
			
			lastPosChecked = 0;
			
			while(altered_string.indexOf("\'", lastPosChecked) > -1)
			{
			
				var singleQuote = altered_string.indexOf("\'", lastPosChecked);
				
				if(ignoreNextSingle)
				{
					
					ignoreNextSingle = false;
					lastPosChecked = singleQuote + 1;
					continue;	
					
				}
				
				tagLabels.forEach(function(element){
				
					var offset = element.length;
					var pos = altered_string.indexOf(element, singleQuote);
				
					if(startDQuote - offset == pos)
					{
						
						withinTag = true;
						
					}
					
				});				
				
				if (!withinTag)
				{
				
					var before_quote = altered_string.substring(0, singleQuote);
					var after_quote = altered_string.substring(singleQuote + 1);
					
					altered_string = before_quote.concat("&rsquo;", after_quote);
				
				}
				else
				{
					
					ignoreNextSingle = true;
					
				}
				
				lastPosChecked = singleQuote + 1;
				
				if(lastPosChecked >= altered_string.length)
				{
					
					break;
					
				}
				
				main_content.innerHTML = altered_string;
				
			}
			
			setCookie("curlyQuotes", "true", 365);
		
		}
		else
		{
			
			altered_string = altered_string.replace( /\u2018|\u2019|\u201A|\uFFFD/g, "\'" );
    		altered_string = altered_string.replace( /\u201c|\u201d|\u201e/g, "\"" );
			
			main_content.innerHTML = altered_string;
			
			setCookie("curlyQuotes", "false", 365);
			
		}
		
	}

	function changePins(checkbox)
	{
	
		if(checkbox == null)
			return;
	
		var pinnedLines = document.getElementsByClassName("pinned");
		
		if(checkbox.checked)
		{
			
			for(var i = 0; i < pinnedLines.length; i++)
			{
				
				pinnedLines[i].style.display = "block";
				
			}
			
			setCookie("disablePins", "true", 365);
			
		}
		else
		{
			
			for(var i = 0; i < pinnedLines.length; i++)
			{
				
				pinnedLines[i].style.display = "none";
				
			}
			
			setCookie("disablePins", "false", 365);
			
		}
		
	}

	function changeSpoilers(checkbox)
	{
	
		if(checkbox == null)
			return;
	
		var spoilerLines = document.getElementsByClassName("spoiler");
		
		if(checkbox.checked)
		{
			
			for(var i = 0; i < spoilerLines.length; i++)
			{
				
				spoilerLines[i].style.display = "block";
				
			}
			
			setCookie("disableSpoilers", "true", 365);
			
		}
		else
		{
			
			for(var i = 0; i < spoilerLines.length; i++)
			{
				
				spoilerLines[i].style.display = "none";
				
			}
			
			setCookie("disableSpoilers", "false", 365);
			
		}
		
	}

</script>