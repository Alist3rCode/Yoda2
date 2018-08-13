
<style>
body {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.roundedBallOuter {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  display: flex;
  justify-content: center;
  align-items: center;
}

.roundedBall {
  width: 200px;
  height: 200px;
  background: #ccc;
  border-radius: 100%;
  position: relative;
  transition: all 0.3s ease;
  cursor: pointer;
}

.roundedBall:hover {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -ms-transform: scale(1.1);
  -moz-transform: scale(1.1);
  box-shadow: 0 0 10px #555;
  transition: all 0.3s ease;
}

.subBall {
  width: 50px;
  height: 50px;
  background: #0077ab;
  border-radius: 100%;
  position: absolute;
  transition: all 0.5s ease;
  z-index: -1;

}

.bubble{
    margin: 15px;
    color:white;
}

.roundedBallOuter.clicked .subBall.linkedIn {
  transform: translate(-10em);

  transition: all 0.5s ease;
}

.roundedBallOuter.clicked .subBall.facebook {
  transform: rotate(-30deg) translate(-10em) rotate(30deg);

  transition: all 0.5s ease;
}

.roundedBallOuter.clicked .subBall.twitter {
  transform: rotate(-60deg) translate(-10em) rotate(60deg);
  transition: all 0.5s ease;
}

.roundedBallOuter.clicked .subBall.github {
  transform: rotate(-90deg) translate(-10em) rotate(90deg);

  transition: all 0.5s ease;
}

.more {
  font-size: 20px;
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.more > span {
  color: #0077ab;
  display: block;
  font-style: italic;
  font-size: 25px;
}

</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




<div class="roundedBallOuter">
  <div class="roundedBall">
    <span class="more"><span>Click</span> for more information</span>
  </div>
    <div class="linkedIn subBall">
        <i class="bubble fab fa-linkedin-in"></i>
    </div>
  <div class="facebook subBall">
      <i class="bubble fab fa-facebook-f"></i>
  </div>
    <div class="twitter subBall">
        <i class="bubble fab fa-twitter"></i>
    </div> 
    <div class="github subBall">
        <i class="bubble fab fa-github"></i>
    </div> 
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
<script>
$(".roundedBallOuter").click(function(e){
  
  $(this).toggleClass("clicked");
});


</script>
