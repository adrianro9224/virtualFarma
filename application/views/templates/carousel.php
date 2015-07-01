<div ng-controller="CarouselCtrl">
  	<div id="carousel-content">
    	<carousel interval="myInterval">
	      	<slide ng-repeat="slide in slides" active="slide.active">
	        	<img ng-src="{{slide.image}}" style="margin:auto;">
                <a href="{{slide.button}}" class="{{slide.class}}">Agregar</a>
	        	<div class="carousel-caption">
	        	</div>
	      	</slide>
    	</carousel>
  	</div>
</div>		
