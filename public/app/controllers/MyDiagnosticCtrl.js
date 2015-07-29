/**
 * Created by Adrian on 26/01/2015.
 */

farmapp.controller('MyDiagnosticCtrl' , ['$scope', '$http', '$rootScope', 'ConstantsService', '$filter', function( $scope, $http, $rootScope, ConstantsService, $filter ){

    'use strict';

    $scope.panelDirty = false;

    //$scope.infoStatusText = "No tienes antecedentes ni patologías registrádas";

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

        if( $scope.userPathologies == undefined )
            get_all_user_pathologies();

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

    };

    function get_all_user_pathologies () {

        $http.get("http://virtualfarma.com.co/user_pathology/get_all_pathologies")
            .success(function(data, status, headers, config) {

                $scope.userPathologiesCharged = false;

                if ( data != "EMPTY" ) {
                    if ( data != "JSON_ERROR" ) {
                        $scope.userPathologiesCharged = true;
                        $scope.pathologiesEmpty = false;
                        $scope.userPathologies = data;
                        console.info(data);
                    }else {
                        //notify error
                    }
                }else {
                    if ( data == "EMPTY" )
                        $scope.userPathologiesCharged = true;
                        $scope.pathologiesEmpty = true;
                }

                $scope.processingPathologyRequest = false;
            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });

    };

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
    };


    $scope.addPathology = function () {
        //add max num of pathologies for user
        var pathologyIdToAdd = arguments[0];

        var dataDoPost = { pathologyId : pathologyIdToAdd };

        $scope.panelDirty = true;
        $scope.processingPathologyRequest = true;
        $scope.infoStatusText = "Procesando...";
        $scope.typeOfinfo = "warning";

        $http.post("http://virtualfarma.com.co/user_pathology/add_pathology", dataDoPost)
            .success(function(data, status, headers, config) {

                if ( data == 'REGISTERED' ) {
                    $scope.typeOfinfo = "success";
                    $scope.infoStatusText = "Tu patología a sido agregada!";
                    get_all_user_pathologies();
                }

                if ( data == 'EXISTING' ) {
                    $scope.typeOfinfo = "info";
                    $scope.infoStatusText = "La patología que estás intentando agregar ya está en tu lista!";
                    $scope.processingPathologyRequest = false;
                }

            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    };


    $scope.removePathology = function () {

        var pathologyIdToRemove = arguments[0];

        var dataDoPost = { pathologyId : pathologyIdToRemove };

        $scope.panelDirty = true;
        $scope.processingPathologyRequest = true;
        $scope.infoStatusText = "Procesando...";
        $scope.typeOfinfo = "warning";

        $http.post("http://virtualfarma.com.co/user_pathology/remove_pathology", dataDoPost)
            .success(function(data, status, headers, config) {

                if ( data == 'REMOVED' ) {
                    $scope.typeOfinfo = "success";
                    $scope.infoStatusText = "Tu patología a sido removida!";
                    get_all_user_pathologies();
                }

                if ( data == 'ERROR' ) {
                    $scope.typeOfinfo = "danger";
                    $scope.infoStatusText = "Por favor intentalo de nuevo";
                    $scope.processingPathologyRequest = false;
                }

                if ( data == 'NO_REGISTERED' ) {
                    $scope.typeOfinfo = "danger";
                    $scope.infoStatusText = "La patología que estas intentando eliminar, no esta en tu lista";
                    $scope.processingPathologyRequest = false;
                }

            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    };


}]);