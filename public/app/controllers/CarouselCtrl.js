/**
 * Created by Adrian on 12/11/2014.
 */

var farmapp = angular.module('farmapp', ['ui.bootstrap', 'ngCookies']);

    //Create the farmapp module

farmapp.controller('CarouselCtrl', ['$scope', function($scope) {
    $scope.myInterval = 7500;
    var slides = $scope.slides = [];
    $scope.addSlide = function(i) {
        var format = '.jpg';
           /* if( i == 0 )
                format = '.png';*/
        slides.push({
            image: 'http://virtualfarma.com.co/assets/images/slides/' + i + format,
            button: ['', 'http://virtualfarma.com.co/product/search_product/entrenador','http://virtualfarma.com.co/product/search_product/argel','http://virtualfarma.com.co/product/search_product/promelight'][slides.length % 4],
            class : ['hidden', 'entrenador-vaginal-button', 'argel-button', 'promelight-button'][slides.length % 4]
        });
    };
    for (var i=0; i<=3; i++) {

        //if ( i != 2 )
            $scope.addSlide(i);

    }

}]);

