/**
 * Created by Adrian on 12/11/2014.
 */

var farmapp = angular.module('farmapp', ['ui.bootstrap', 'ngCookies']);

    //Create the farmapp module

farmapp.controller('CarouselCtrl', ['$scope', function($scope) {
    $scope.myInterval = 7500;
    var slides = $scope.slides = [];
    $scope.addSlide = function(i) {
        slides.push({
            image: 'http://virtualfarma.com.co/assets/images/slides/' + i + '.jpg',
            button: ['','http://virtualfarma.com.co/product/search_product/argel','http://virtualfarma.com.co/product/search_product/entrenador','http://virtualfarma.com.co/product/search_product/promelight'][slides.length % 4],
            class : ['hidden', 'argel-button', 'entrenador-vaginal-button', 'promelight-button'][slides.length % 4]
        });
    };
    for (var i=0; i<=3; i++) {
        $scope.addSlide(i);
    }

}]);

