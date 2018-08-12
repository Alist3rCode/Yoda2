
<style>
* {
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
}
body {
  background: #2196f3;
}
.menu {
  border-radius: 50%;
  position: relative;
  display: inline-block;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  cursor: pointer;
  transition: box-shadow ease-in .2s;
}
.trigger {
  background: none;
  width: 45px;
  height: 45px;
  padding: 0;
  margin: 0;
  border: none;
  outline: none;
  text-align: center;
  color: #fff;
  position: relative;
  z-index: 1000;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
  /* For some Androids */
}
.trigger::before,
.trigger::after,
.trigger span {
	background: #FFF;
}

.trigger::before,
.trigger::after {
	content: '';
  display: block;
	height: 2px;
  margin: 0 auto;
	width: 50%;
	-webkit-transform-origin: 38% 38%;
	transform-origin: 38% 38%;
	-webkit-transition: -webkit-transform 0.25s;
	transition: transform 0.25s;
}

.trigger span {
  display: block;
	width: 50%;
	height: 2px;
  margin: 0 auto;
	overflow: hidden;
	text-indent: 200%;
	-webkit-transition: opacity 0.25s;
	transition: opacity 0.25s;
}

.trigger::before {
	-webkit-transform: translate3d(0, -5px, 0);
	transform: translate3d(0, -5px, 0);
}

.trigger::after {
	-webkit-transform: translate3d(0, 5px, 0);
	transform: translate3d(0, 5px, 0);
}

.menu--open {
  box-shadow: 0 0 100px 100px rgba(0, 0, 0, .5);
}
.menu--open .trigger span {
	opacity: 0;
}

.menu--open .trigger::before {
	-webkit-transform: rotate3d(0, 0, 1, 45deg);
	transform: rotate3d(0, 0, 1, 45deg);
}

.menu--open .trigger::after {
	-webkit-transform: rotate3d(0, 0, 1, -45deg);
	transform: rotate3d(0, 0, 1, -45deg);
}

.menu__items {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  padding: 0;
  margin: 0;
  list-style-type: none;
  z-index: 5;
}

.menu__items li {
  width: 80%;
  height: 80%;
  top: 10%;
  left: 10%;
  line-height: 1.5;
  font-size: 1.5em;
  position: absolute;
  z-index: -1;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transform: scale3d(0.5, 0.5, 1);
  transform: scale3d(0.5, 0.5, 1);
  -webkit-transition: -webkit-transform 0.25s ease-out;
  transition: transform 0.25s ease-out;
}

.menu.menu--open .menu__items li:first-child {
  -webkit-transform: scale3d(1, 1, 1) translate3d(80px, 0, 0);
  transform: scale3d(1, 1, 1) translate3d(80px, 0, 0);
}

.menu.menu--open .menu__items li:nth-child(2) {
  -webkit-transform: scale3d(1, 1, 1) translate3d(56px, 56px, 0);
  transform: scale3d(1, 1, 1) translate3d(56px, 56px, 0);
}

.menu.menu--open .menu__items li:last-child {
  -webkit-transform: scale3d(1, 1, 1) translate3d(0, 80px, 0);
  transform: scale3d(1, 1, 1) translate3d(0, 80px, 0);
}

.menu__items li a {
  display: block;
  /*background: #4caf50;*/
  color: #FFF;
  border-radius: 50%;
  outline: none;
  overflow: hidden;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
  text-align: center;
}

.menu__items li a:hover,
.menu__items li a:focus {
  background: #1976d2;
  color: #FFF;
}

.menu__items li a span {
  position: absolute;
  color: transparent;
  top: 100%;
  pointer-events: none;
}

.morph-shape {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100;
}

.morph-shape svg path {
  fill: #1976d2;
  -webkit-transition: fill 0.3s;
  transition: fill 0.3s;
}

.menu--open .morph-shape svg path {
  fill: #4caf50;
}

</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">




<nav id="menu" class="menu">
  <span class="morph-shape" data-morph-active="M251,150c0,93.5-29.203,143-101,143S49,243.5,49,150C49,52.5,78.203,7,150,7S251,51.5,251,150z">
						<svg width="100%" height="100%" viewBox="20 20 260 260" preserveAspectRatio="none">
							<path d="M281,150C281,221.797,221.797,281,150,281C78.203,281,19,221.797,19,150C19,78.203,78.203,19,150,19C221.797,19,281,78.203,281,150C281,150,281,150,281,150"></path>
						<desc>Created with Snap</desc><defs></defs></svg>
					</span>
  <button class="trigger">
    <span>Menu</span>
  </button>
  <ul class="menu__items">
    <li>
      <a href="https://www.twitter.com/eaglejs14" target="_blank">
        <i class="fab fa-fw fa-twitter"></i>
        <span>eaglejs on Twitter</span>
      </a>
    </li>
    
    
    <li>
      <a href="https://plus.google.com/u/0/+JoshuaEagle14" target="_blank">
        <i class="fab fa-fw fa-google-plus"></i>
        <span>eaglejs on Google+</span>
      </a>
    </li>
    <li>
      <a href="https://github.com/eaglejs" target="_blank">
        <i class="fab fa-fw fa-github"></i>
        
        <span>eaglejs on GitHub</span>
      </a>
    </li>
  </ul>
</nav>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
<script>
(function() {

  function SVGMenu(el, options) {
    this.el = el;
    this.init();
  }

  SVGMenu.prototype.init = function() {
    this.trigger = this.el.querySelector('button.trigger');
    this.shapeEl = this.el.querySelector('span.morph-shape');

    var s = Snap(this.shapeEl.querySelector('svg'));
    this.pathEl = s.select('path');
    this.paths = {
      reset: this.pathEl.attr('d'),
      active: this.shapeEl.getAttribute('data-morph-active')
    };

    this.isOpen = false;

    this.initEvents();
  };

  SVGMenu.prototype.initEvents = function() {
    this.trigger.addEventListener('click', this.toggle.bind(this));
  };

  SVGMenu.prototype.toggle = function() {
    var self = this;

    if (this.isOpen) {
      $('.menu').removeClass('menu--open');
    } else {
      setTimeout(function() {
        $('.menu').addClass('menu--open');
      }, 175);
    }

    this.pathEl.stop().animate({
      'path': this.paths.active
    }, 150, mina.easein, function() {
      self.pathEl.stop().animate({
        'path': self.paths.reset
      }, 800, mina.elastic);
    });

    this.isOpen = !this.isOpen;
  };

  new SVGMenu(document.getElementById('menu'));

})();

</script>
