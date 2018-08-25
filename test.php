<style>
    * {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  padding-top: 50px;
  padding-bottom: 20px;
  background: #F2F2F2;
}

.faint {
  color: #999;
}

.fa {
  font-size: 5em;
  text-align: center;
  padding: 20px;
}

.btn:hover {
  outline: 0 !important;
}
.btn:focus {
  outline: 0 !important;
}
.btn:active {
  outline: 0 !important;
}

.btn-download {
  height: 50px;
  text-align: center;
  margin-top: 40px;
  font-size: 1.7em;
}

.btn-flip-extend, .btn-flip:hover, .btn-flip:focus {
  background-color: transparent;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  opacity: 1;
}

.btn-flip {
  opacity: 0.8;
  color: #666666;
  background-color: transparent;
}
.btn-flip i {
  font-size: 16px;
}

.card-holder {
  margin-top: 50px;
}

.card-container {
  -moz-perspective: 800px;
  -webkit-perspective: 800px;
  perspective: 800px;
  -moz-transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  margin-bottom: 30px;
  width: 100%;
  height: 420px;
}
.card-container:not(.manual-flip):hover .front {
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  transform: rotateY(180deg);
}
.card-container:not(.manual-flip):hover .back {
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -webkit-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.card-container.hover.manual-flip .front {
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  transform: rotateY(180deg);
}
.card-container.hover.manual-flip .back {
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -webkit-transform: rotateY(0deg);
  transform: rotateY(0deg);
}

.card {
  -moz-transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -moz-transition: -moz-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-transition: -o-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-transition: -webkit-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition: transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  background: none repeat scroll 0 0 #fff;
  color: #444444;
  max-width: 320px;
  margin: 0 auto;
}
.card .cover {
  -moz-border-radius: 4px 4px 0 0;
  -webkit-border-radius: 4px;
  border-radius: 4px 4px 0 0;
  height: 105px;
  overflow: hidden;
  z-index: -2;
}
.card .cover img {
  width: 100%;
}
.card .branded {
  position: relative;
  background: #fff;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  display: block;
  height: 120px;
  margin: -55px auto 0;
  width: 120px;
  text-align: center;
}
.card .content {
  background-color: transparent;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  padding: 10px 20px 20px;
}
.card .content .main {
  min-height: 140px;
}
.card .use-for {
  font-size: 22px;
  text-align: center;
}
.card h5 {
  margin: 5px 0;
  font-weight: 400;
  line-height: 20px;
}
.card .footer {
  color: #999;
  padding: 10px 0 0;
  text-align: center;
}
.card .footer .btn-simple {
  margin-top: -6px;
}
.card .header {
  padding: 15px 20px;
  height: 90px;
}
.card .back .content .main {
  height: 215px;
}

.front {
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-transition: -moz-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-transition: -o-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-transition: -webkit-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition: transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -moz-transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -webkit-transform: rotateY(0deg);
  transform: rotateY(0deg);
  -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  position: absolute;
  background-color: #fff;
  width: 100%;
  height: 420px;
  top: 0;
  left: 0;
  z-index: 2;
}

.back {
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-transition: -moz-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-transition: -o-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-transition: -webkit-transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition: transform 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -moz-transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -moz-transform: rotateY(-180deg);
  -ms-transform: rotateY(-180deg);
  -webkit-transform: rotateY(-180deg);
  transform: rotateY(-180deg);
  -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.14);
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  position: absolute;
  background-color: #fff;
  width: 100%;
  height: 420px;
  top: 0;
  left: 0;
}
.back .btn-simple {
  position: absolute;
  left: 0;
  bottom: 4px;
}

.qr canvas {
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  margin: 0 auto;
}

.title {
  color: #506a85;
  text-align: center;
  font-weight: 300;
  font-size: 44px;
  margin-bottom: 90px;
  line-height: 90%;
}

</style>

<head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <link rel="stylesheet" href="public/css/bubble_alt.css">
        <link rel="stylesheet" href="public/css/modale.css">
        <link rel="stylesheet" href="public/css/tags.css">

    </head>

<div class="container">
  <div class="row">
    <section class="card-holder">
      <!-- Begin iOS -->
      <div class="col-md-4 col-sm-6">
        <div class="card-container manual-flip">
          <div class="card">
            <div class="front">
              <div class="cover">
                <img src="https://bilbo.surge.sh/codepen/download-cards/apple.png" />
              </div>
              <div class="branded">
                <span class="fa fa-apple"></span>
              </div>
              <div class="content">
                <div class="main">
                  <h3 class="use-for faint">Download For</h3>
                  <button type="button" class="btn btn-default btn-block btn-download">iOS</button>
                </div>
                <div class="footer">
                  <button class="btn btn-flip btn-qr" onclick="rotateCard(this)">
                    <i class="fa fa-mail-forward"></i> Get QR Code
                  </button>
                </div>
              </div>
            </div>
            <div class="back">
              <div class="header">
                <h3 class="use-for faint">QR Code</h3>
              </div>
              <div class="content">
                <div id="qrIos" class="qr text-center"></div>
              </div>
              <div class="footer">
                <button class="btn btn-flip" onclick="rotateCard(this)">
                  <i class="fa fa-reply"></i> Back
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End iOS -->
      <!-- Begin Android -->
      <div class="col-md-4 col-sm-6">
        <div class="card-container manual-flip">
          <div class="card">
            <div class="front">
              <div class="cover">
                <img src="https://bilbo.surge.sh/codepen/download-cards/android.png" />
              </div>
              <div class="branded">
                <span class="fa fa-android"></span>
              </div>
              <div class="content">
                <div class="main">
                  <h3 class="use-for faint">Download For</h3>
                  <button type="button" class="btn btn-default btn-block btn-download">Android</button>
                </div>
                <div class="footer">
                  <button class="btn btn-flip btn-qr" onclick="rotateCard(this)">
                    <i class="fa fa-mail-forward"></i> Get QR Code
                  </button>
                </div>
              </div>
            </div>
            <!-- end front panel -->
            <div class="back">
              <div class="header">
                <h3 class="use-for faint">QR Code</h3>
              </div>
              <div class="content">
                <div id="qrAndroid" class="qr text-center"></div>
              </div>
              <div class="footer">
                <button class="btn btn-flip" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                  <i class="fa fa-reply"></i> Back
                </button>
              </div>
            </div>
            <!-- end back panel -->
          </div>
        </div>
      </div>
      <!-- End Android -->
      <!-- Begin Web -->
      <div class="col-md-4 col-sm-6">
        <div class="card-container manual-flip">
          <div class="card">
            <div class="front">
              <div class="cover">
                <img src="https://bilbo.surge.sh/codepen/download-cards/web.png" />
              </div>
              <div class="branded">
                <span class="fa fa-windows"></span>
              </div>
              <div class="content">
                <div class="main">
                  <h3 class="use-for faint">Download For</h3>
                  <button type="button" class="btn btn-default btn-block btn-download">Windows</button>
                </div>
                <div class="footer">
                  <button class="btn btn-flip btn-qr" onclick="rotateCard(this)">
                    <i class="fa fa-mail-forward"></i> Get QR Code
                  </button>
                </div>
              </div>
            </div>
            <!-- end front panel -->
            <div class="back">
              <div class="header">
                <h3 class="use-for faint">QR Code</h3>
              </div>
              <div class="content">
                <div id="qrWeb" class="qr text-center"></div>
              </div>
              <div class="footer">
                <button class="btn btn-flip" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                  <i class="fa fa-reply"></i> Back
                </button>
              </div>
            </div>
            <!-- end back panel -->
          </div>
        </div>
      </div>
      <!-- End Web -->
    </section>
  </div>
</div>
    <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            
 $(document).ready(function() {
  $('#qrIos').qrcode({
    width: 200,
    height: 200,
    text: "iOS_URL_HERE"
  });
  $('#qrAndroid').qrcode({
    width: 200,
    height: 200,
    text: "DROID_URL_HERE"
  });
  $('#qrWeb').qrcode({
    width: 200,
    height: 200,
    text: "WINDOWS_URL_HERE"
  });
});

function rotateCard(btn) {
  var $card = $(btn).closest('.card-container');
  console.log($card);
  if ($card.hasClass('hover')) {
    $card.removeClass('hover');
  } else {
    $card.addClass('hover');
  }
}
</script>
        