<style>
.flip-container {
    -webkit-perspective: 1000;
    perspective: 1000;
}
  
.flip-container.clicked .flipper {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.flip-container, .front, .back {
    width: 320px;
    height: 427px;
}

.flipper {
    -webkit-transition: 0.6s;
    -webkit-transform-style: preserve-3d;
    /* transition: 0.2s; */
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transform-style: preserve-3d;
    position: relative;
}

.front, .back {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    position: absolute;
}

.front {
	background: red;
	z-index: 2;
}

.back {
	-webkit-transform: rotateY(180deg);
	transform: rotateY(180deg);
	background: black;
}






</style>
<div class="flip-container" onclick="this.classList.toggle('clicked');">
  <div class="flipper">
    <div class="front">
      
    </div>
    <div class="back">
      
    </div>
  </div>
</div>
