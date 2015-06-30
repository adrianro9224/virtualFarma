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
            image: 'http://virtualfarma.com.co/assets/images/slides/' + i + '.png',
            text: ['Virtualfarma','<a href="http://virtualfarma.com.co/product/search_product/argel"></a>','Promelight','Entrenador'][slides.length % 4] + ' ' +
            ['', 'Flash', '','Vaginal'][slides.length % 4]
        });
    };
    for (var i=0; i<=3; i++) {
        $scope.addSlide(i);
    }

}]);

