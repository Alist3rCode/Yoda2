<html>
    <script>
        var pressTimer;

        function upHandler(ev) {
            console.log(ev);
            clearTimeout(pressTimer);
            return false;

        }
        function downHandler(ev) {
            pressTimer = window.setTimeout(function () {
                alert('ok fine...');
            }, 1000);
            return false;

        }
        function init() {
            var el = document.getElementById("target1");
            el.onpointerup = upHandler;
            el.onpointerdown = downHandler;
        }
    </script>
    <body onload="init();">
        <div id="target1"> Touch me ... </div>
        
    </body>
</html>