/**
 * Created by Adrian on 26/01/2015.
 */

farmapp.controller('MyDiagnosticCtrl' , ['$scope', '$http', '$rootScope', 'ConstantsService', '$filter', function( $scope, $http, $rootScope, ConstantsService, $filter ){

    'use strict';


    function selectPlaceHolder () {

        if ($scope.pathologiesCharged)
            $scope.searchPathologyPlaceHolder = "Buscar patología";
        else
            $scope.searchPathologyPlaceHolder = "Cargando patologías...";

    }


    selectPlaceHolder();

    $scope.showPhatologyDescription = function( pathologyDescriptionId) {

        var el  = document.getElementById( pathologyDescriptionId );

        angular.element(el).removeClass("hidden");
    }

    $scope.closePhatologyDescription = function( pathologyDescriptionId) {

        var el  = document.getElementById( pathologyDescriptionId );

        angular.element(el).addClass("hidden");
    }


    $rootScope.$on( ConstantsService.CHARGE_ALL_VF_PATHOLOGIES, function( event, data ){

        if ( $scope.pathologies == undefined )
            get_all_vf_pathologies();

    });


    $scope.search = function( textToSearch, isValid ) {

        if ( isValid && textToSearch.length > 2 ) {

            var result = $filter('filter')($scope.pathologies, textToSearch, undefined);

            if ( result.length > 0 ) {

                    $scope.results = result;

            }else
                $scope.results = false;
                $scope.results = result;
                console.info();
        } else {
            $scope.results = false;
        }

    }



    function get_all_vf_pathologies() {

        $http.get("http://virtualfarma.com.co/pathology/get_all_pathologies")
            .success(function(data, status, headers, config) {

                $scope.pathologiesCharged = false;

                if ( data != "NULL" ) {
                    $scope.pathologiesCharged = true;

                    $scope.pathologies = data;

                    selectPlaceHolder();

                }else {
                    $scope.reload = true;
                }

            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    }


    $scope.addPathology = function () {

        var pathologyIdToAdd = arguments[0];

        var dataDoPost = { pathologyId : pathologyIdToAdd };

        $http.post("http://virtualfarma.com.co/user_pathology/add_pathology", dataDoPost)
            .success(function(data, status, headers, config) {


            console.info(data);

            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    };




}]);