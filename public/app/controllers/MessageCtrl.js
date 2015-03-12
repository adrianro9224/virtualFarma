/**
 * Created by Adrian on 06/01/2015.
 */

farmapp.controller('MessageCtrl', ['$scope', '$window', '$http', '$location', '$rootScope', '$timeout', function($scope, $window, $http, $location, $rootScope, $timeout) {

    "use strict";

    $scope.open = false;
    $scope.sentActived = false;
    $scope.receivedActived = true;


    $scope.openCreateMessage = function() {

        if($scope.open)
            $scope.open = false;
        else
            $scope.open = true;

    };


    $scope.closeMessage = function ( messageId ) {

        var el = document.getElementById( "message_" + messageId );
        angular.element(el).addClass("hidden");

    };

    $scope.openMessageSingle = function( messageId ) {
        removeClassHiddenToMessageBox( messageId );
    };

    $scope.openMessage = function( messageId, account_id_view ) {

        $http.get('http://virtualfarma.com.co/message/mark_as_read/' + messageId + '/' + account_id_view + '/' )
            .success(function(data, status, headers, config) {

                $rootScope.$broadcast("MESSAGE_READED");

                removeClassHiddenToMessageBox( messageId );

                changueMessageIcon( messageId );

            }).
            error(function(data, status, headers, config) {
                console.info(data + ":(");
            });
    };

    $scope.deleteMessage = function( messageId , account_id_view, typeOfdelete) {

        $http.get('http://virtualfarma.com.co/message/mark_as_delete/' + messageId + '/' + account_id_view + '/' + typeOfdelete + '/')
            .success(function(data, status, headers, config) {

                $rootScope.$broadcast("MESSAGE_DELETED");

                var el = document.getElementById( "tr-" + messageId );
                angular.element(el).addClass("hidden");

                $window.location.reload();

            }).
            error(function(data, status, headers, config) {
                console.info(data + ":(");
            });
    };

    function removeClassHiddenToMessageBox( messageId ) {

        var el = document.getElementById( "message_" + messageId );
        angular.element(el).removeClass("hidden");

    }

    function changueMessageIcon( messageId ) {

        var el = document.getElementById( "icon-message-" + messageId );
        angular.element(el).removeClass("glyphicon");
        angular.element(el).removeClass("glyphicon-envelope");

        angular.element(el).addClass("glyphicon");
        angular.element(el).addClass("glyphicon glyphicon-ok");

    };

    $scope.activeReceivedMessages = function() {
        $scope.receivedActived = true;
        $scope.sentActived = false;
    }

    $scope.activeSentMessages = function() {
        $scope.sentActived = true;
        $scope.receivedActived = false;
    }
}]);