/**
 * Created by Adrian on 12/11/2014.
 */

var farmapp = angular.module('farmapp', ['ui.bootstrap', 'ngCookies']);

    //Create the farmapp module

farmapp.controller('CarouselCtrl', ['$scope', function($scope) {
    $scope.myInterval = 5000;
    var slides = $scope.slides = [];
    $scope.addSlide = function(i) {
        slides.push({
            image: 'http://virtualfarma.com.co/assets/images/' + i + '.jpg',
            text: ['Argel','Promelight','Lots of','Surplus'][slides.length % 4] + ' ' +
            ['Flash', '', 'Felines', 'Cutes', ''][slides.length % 4]
        });
    };
    for (var i=0; i<=4; i++) {
        $scope.addSlide(i);
    }

}]);

