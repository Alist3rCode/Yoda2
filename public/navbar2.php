<nav class=" menu navbar navbar-expand-lg">
    <span class="logo col-1">
        <img src="public/img/yoda.png">
    </span>
    <div class="collapse navbar-collapse col-11" id="navbarSupportedContent">
        
       <div class="dateTime ">
        <div class="date" id="date">
            <div id="startDate" class="startDate h3 text-center"></div>
            <div class="year display-1 text-center" id="year"></div>
        </div>
        <div class="time text-center" id="time"></div>
        
        
    </div>
    </div>
</nav>
<script>
    var d = new Date();
    var options = {weekday: "long", month: "long", day: "numeric"};
    var n = d.toLocaleDateString("fr-FR", options);
    // var y = d.getFullYear();
    document.getElementById("startDate").innerHTML = n;
    // document.getElementById("year").innerHTML = y;
    
    var clockDiv = document.getElementById("time");
    
    function Clock() {
    	var date = new Date(),
    		hr = date.getHours(),
    		min = date.getMinutes(),
    		sec = date.getSeconds();
    	
    	// hr > 12 ? hr = hr - 12 : hr = hr;
    	hr < 10 ? (hr = "0" + hr) : (hr = hr);
    	min <= 9 ? (min = "0" + min) : (min = min);
    	sec <= 9 ? (sec = "0" + sec) : (sec = sec);
    	clockDiv.innerHTML = hr + ":" + min + ":" + sec;
    }
    window.onload = function() {
    	setInterval(Clock, 400);
    };

    
   
    </script>