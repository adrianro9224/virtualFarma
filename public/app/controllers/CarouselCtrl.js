/**
 * Created by Adrian on 12/11/2014.
 */

var farmapp = angular.module('farmapp', ['ui.bootstrap']);//Create the farmapp module

farmapp.controller('CarouselCtrl', ['$scope', function($scope) {
    $scope.myInterval = 5000;
    var slides = $scope.slides = [];
    $scope.addSlide = function(i) {
        slides.push({
            image: 'http://virtualfarma.com.co/assets/images/' + i + '.jpg',
            text: ['Carlos','Romero','Lots of','Surplus'][slides.length % 4] + ' ' +
            ['Adrian', 'Gomez', 'Felines', 'Cutes'][slides.length % 4]
        });
    };
    for (var i=0; i<=4; i++) {
        $scope.addSlide(i);
    }
}]);

