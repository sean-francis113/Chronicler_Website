<script type="text/javascript" src="scripts/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() { 
	
		$("span.spoiler").click(function(){
			$(this).parents("p").children("span.spoiler").css("background-color", "transparent");
		});

	});
    
</script>