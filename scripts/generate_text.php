<script>

	(function () {
		var textFile = null,
		  makeTextFile = function (text) {
			var data = new Blob([text], {type: 'text/plain'});

			// If we are replacing a previously generated file we need to
			// manually revoke the object URL to avoid memory leaks.
			if (textFile !== null) {
			  window.URL.revokeObjectURL(textFile);
			}

			textFile = window.URL.createObjectURL(data);

			return textFile;
		  };


		  var text_download_spoiler = document.getElementById('text_download_spoiler');
		  var text_download_nospoiler = document.getElementById('text_download_nospoiler');

		  text_download_spoiler.addEventListener('click', function () {
			var link = document.getElementById('download_text_file');
			var story_arr = `<?php echo $story_content ?>`.split('\n');
			var final_story = "";

			for(var i = 0; i < story_arr.length; i++)
			{
			
				var temp_line = story_arr[i];
				
				while(temp_line.indexOf("<span class=\"spoiler\">") != -1) {
					
					var open_tag_start = temp_line.indexOf("<span class=\"spoiler\">");
					var open_tag_end = open_tag_start + "<span class=\"spoiler\">".length;
					var close_tag_start = temp_line.indexOf("</span>", open_tag_start);
					var close_tag_end = close_tag_start + "</span>". length;
					
					temp_line = temp_line.slice(0, open_tag_start) + "(SPOILER: " + temp_line.slice(open_tag_end, close_tag_start) + ")" + temp_line.slice(close_tag_end);			
					
				}
				
				temp_line.replace(/<span class="multilinecode">/g, "");
				temp_line.replace(/<span class="singlelinecode">/g, "");
				temp_line.replace(/<span class="italics_bold_underline">/g, "");
				temp_line.replace(/<span class="italics_bold">/g, "");
				temp_line.replace(/<span class="bold_underline">/g, "");
				temp_line.replace(/<span class="bold">/g, "");
				temp_line.replace(/<span class="italics_underline">/g, "");
				temp_line.replace(/<span class="strikeout">/g, "");
				temp_line.replace(/<span class="italics">/g, "");
				temp_line.replace(/<span class="underline">/g, "");
				temp_line.replace(/<\/span>/g, "");
								
				final_story += "\t" + temp_line + "\n\n";
				
			}

			link.href = makeTextFile(final_story);
			link.click();
		  }, false);
		  
		  text_download_nospoiler.addEventListener('click', function () {
			var link = document.getElementById('download_text_file');
			var story_arr = `<?php echo $story_content ?>`.split('\n');
			var final_story = "";

			for(var i = 0; i < story_arr.length; i++)
			{
			
				var temp_line = story_arr[i];
				
				while(temp_line.indexOf("<span class=\"spoiler\">") != -1) {
					
					var open_tag_start = temp_line.indexOf("<span class=\"spoiler\">");
					var close_tag_end = temp_line.indexOf("</span>", open_tag_start); + "</span>". length;
					
					temp_line = temp_line.slice(0, open_tag_start) + temp_line.slice(close_tag_end);			
					
				}
				
				temp_line.replace(/<span class="multilinecode">/g, "");
				temp_line.replace(/<span class="singlelinecode">/g, "");
				temp_line.replace(/<span class="italics_bold_underline">/g, "");
				temp_line.replace(/<span class="italics_bold">/g, "");
				temp_line.replace(/<span class="bold_underline">/g, "");
				temp_line.replace(/<span class="bold">/g, "");
				temp_line.replace(/<span class="italics_underline">/g, "");
				temp_line.replace(/<span class="strikeout">/g, "");
				temp_line.replace(/<span class="italics">/g, "");
				temp_line.replace(/<span class="underline">/g, "");
				temp_line.replace(/<\/span>/g, "");
								
				final_story += "\t" + temp_line + "\n\n";
				
			}

			link.href = makeTextFile(final_story);
			link.click();
		  }, false);
	})();

</script>