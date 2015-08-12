/**
 * Created by Adrian on 12/08/2015.
 */

farmapp.controller('ManageAddressesCtrl', ['$scope', '$http', '$rootScope', 'ConstantsService', function( $scope, $http, $rootScope, ConstantsService ){

    'use strict';

    $scope.savingAddress = false;
    $scope.panelDirty = false;
    $scope.loadingAddresses = false;
    $scope.addressesCharged = false;

    selectTextForButtonToSave();

    $rootScope.$on(ConstantsService.CHARGE_EVERY_USER_ADDRESSES, function(event, data){
        load_addresses();
    });

    $scope.saveAddress = function( address ) {

        $scope.savingAddress = true;
        $scope.panelDirty = true;

        $scope.infoStatusText = "Cargando ...";

        selectTextForButtonToSave();

        $http.post("http://virtualfarma.com.co/address/create_address", {data: address})
            .success(function (data, status, headers, config) {

                $scope.savingAddress = false;
                selectTextForButtonToSave();

                if ( data == 'SAVED' ) {
                    $scope.infoStatusText = "Tu dirección a sido agregada!";
                    load_addresses();
                }

                if ( data == 'RETRY' ) {
                    $scope.infoStatusText = "Por favor intentalo de nuevo!";
                }

                if ( data == 'SESSION_EXPIRED' ) {
                    //TODO
                }
                    console.info(data);


            }).
            error(function (data, status, headers, config) {
               // $window.location.reload();
                console.info(data + ":(");
            });
    };

    function selectTextForButtonToSave() {

        if ( $scope.savingAddress )
            $scope.buttonText = "Guardando";
        else
            $scope.buttonText = "Guardar";
    }

    function load_addresses() {

        $scope.loadingAddresses = true;

        $http.get("http://virtualfarma.com.co/address/get_all")
            .success(function (data, status, headers, config) {

                $scope.loadingAddresses = false;

                var result = angular.fromJson(data);

                if ( result.status == 'CHARGED' ) {
                    $scope.addressesCharged = true;

                    //var addresses = [];

                    //addresses[] = angular.fromJson(result.addresses);
                    $scope.addresses = angular.fromJson(result.addresses);

                    console.info($scope.addresses);
                }

                if ( data == 'EMPTY' ) {
                    //
                }

                if ( data == 'SESSION_EXPIRED' ) {
                    //TODO
                }


            }).
            error(function (data, status, headers, config) {
                $window.location.reload();
                console.info(data + ":(");
            });
    }

}]);
