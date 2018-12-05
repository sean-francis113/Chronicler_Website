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


		  var text_download = document.getElementById('text_download');

		  text_download.addEventListener('click', function (id) {
			var link = document.getElementById('download_text_file');
			var story_arr = `<?php echo $story_content ?>`.split('\n');
			var final_story = "";

			for(var i = 0; i < story_arr.length; i++)
			{
				final_story += "\t" + story_arr[i] + "\n\n";
			}

			link.href = makeTextFile(final_story);
			link.click();
		  }, false);
	})();

</script>