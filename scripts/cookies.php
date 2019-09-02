<script>

	function setCookie(cname, cvalue, exdays) {
	  var d = new Date();
	  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	  var expires = "expires="+d.toUTCString();
	  var domain = "chronicler.seanmfrancis.net";
	  document.cookie = cname + "=" + cvalue + ";" + expires + ";" + domain + ";path=/";
	}

	function getCookie(cname) {
	  var name = cname + "=";
	  var ca = document.cookie.split(';');
	  for(var i = 0; i < ca.length; i++) {
	    var c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1);
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length);
	    }
	  }
	  return "";
	}

	function checkCookies() {
	  var easyBG = getCookie("easyReadBG");
	  if (easyBG != "") {
	    bg = document.getElementById("background_check");
		if(bg != null)
		{	
			if (easyBG.toLowerCase() == "true")
			{
				bg.checked = true;
			}
			else{
				bg.checked = false;
			}
		}
	  } 
	  else {
	    setCookie("easyReadBG", "false", 365);
		bg = document.getElementById("background_check");
		if(bg != null)
		{
			bg.checked = false;
		}
	  }
	  
	  var curlyQuotes = getCookie("curlyQuotes");
	  if (curlyQuotes != "") {
	    cq = document.getElementById("curlyquote_check");
		if(cq != null)
		{
			if (curlyQuotes.toLowerCase() == "true")
			{
				cq.checked = true;
			}
			else{
				cq.checked = false;
			}
		}
	  } 
	  else {
	    setCookie("curlyQuotes", "false", 365);
		cq = document.getElementById("curlyquote_check");
		if(cq != null)
		{
			cq.checked = false;
		}
	  }
	  
	  var disablePins = getCookie("disablePins");
	  if (disablePins != "") {
	    dp = document.getElementById("disablepins_check");
		if(dp != null)
		{
			if (disablePins.toLowerCase() == "true")
			{
				dp.checked = true;
			}
			else{
				dp.checked = false;
			}
		}
	  } 
	  else {
	    setCookie("disablePins", "true", 365);
		dp = document.getElementById("disablepins_check");
		if(dp != null)
		{
			dp.checked = true;
		}
	  }
	
	var disableSpoilers = getCookie("disableSpoilers");
	  if (disableSpoilers != "") {
	    ds = document.getElementById("disablespoilers_check");
		if(ds != null)
		{
			if (disableSpoilers.toLowerCase() == "true")
			{
				ds.checked = true;
			}
			else{
				ds.checked = false;
			}
		}
	  } 
	  else {
	    setCookie("disableSpoilers", "true", 365);
		ds = document.getElementById("disablespoilers_check");
		if(ds != null)
		{
			ds.checked = true;
		}
	  }
	}

</script>