/**
 * Created by Adrian on 12/08/2015.
 */

farmapp.controller('ManageAddressesCtrl', ['$scope', '$http', '$rootScope', 'ConstantsService', function( $scope, $http, $rootScope, ConstantsService ){

    'use strict';

    $scope.savingAddress = false;
    $scope.panelDirty = false;
    $scope.loadingAddresses = false;
    $scope.addressesCharged = false;
    $scope.updatingAddress = false;
    $scope.deletingAddress = false;
    $scope.addressesEmpty = false;

    selectTextForButtonToSave();
    selectTextForButtonToUpdate();
    selectTextForButtonToDelete();

    $rootScope.$on(ConstantsService.CHARGE_EVERY_USER_ADDRESSES, function(event, data){
        loadAddresses();
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
                    loadAddresses();
                }

                if ( data == 'RETRY' ) {
                    $scope.infoStatusText = "Por favor intentalo de nuevo!";
                }

                if ( data == 'SESSION_EXPIRED' ) {
                    window.location = "/account";
                }
                    console.info(data);


            }).
            error(function (data, status, headers, config) {
               // $window.location.reload();
                console.info(data + ":(");
            });
    };

    $scope.updateAddress = function ( newAddress, internalAddressData ) {

        var addressToSend = create_new_address( newAddress, internalAddressData );

        $scope.panelDirty = true;
        $scope.updatingAddress = true;
        $scope.infoStatusText = "Actualizando!";

        $http.post("http://virtualfarma.com.co/address/update_address", {data: addressToSend})
            .success(function(data, status, headers, config){

                $scope.updatingAddress = false;
                selectTextForButtonToUpdate();

                if( data == 'UPDATED' ) {
                    $scope.infoStatusText = "Tu dirección a sido actualizada!";
                    loadAddresses();
                }

                if( data == 'RETRY' )
                    $scope.infoStatusText = "Por favor intentalo de nuevo!";
                
                if( data == 'SESSION_EXPIRED' )
                    window.location = "/account";

            }).
            error(function(data, status, headers, config){
                console.info(data + ":(");

            });
    };

    $scope.deleteAddress = function ( addressIdToDelete ) {

        $scope.panelDirty = true;
        $scope.deletingAddress = true;
        $scope.infoStatusText = "Borrando!";

        $http.post("http://virtualfarma.com.co/address/delete_address", {data: addressIdToDelete})
            .success(function(data, status, headers, config){

                $scope.deletingAddress = false;
                selectTextForButtonToDelete();

                if( data == 'DELETED' ) {
                    $scope.infoStatusText = "Tu dirección a sido borrada!";
                    loadAddresses();
                }

                if( data == 'RETRY' )
                    $scope.infoStatusText = "Por favor intentalo de nuevo!";

                if( data == 'SESSION_EXPIRED' )
                    window.location = "/account";

            }).
            error(function(data, status, headers, config){
                console.info(data + ":(");

            });

    };

    function create_new_address( newAddress, internalAddressData ) {

        var address = {
            id: internalAddressData.id,
            from: internalAddressData.from,
            address_line: newAddress.line1, name: newAddress.name
        };

        return address;

    }

    function selectTextForButtonToDelete() {

        if( $scope.deletingAddress )
            $scope.buttonDeleteText = "Borrando";
        else
            $scope.buttonDeleteText = "Borrar";

    }

    function selectTextForButtonToUpdate() {

        if( $scope.updatingAddress )
            $scope.buttonUpdateText = "Actualizando";
        else
            $scope.buttonUpdateText = "Actualizar";

    }

    function selectTextForButtonToSave() {

        if ( $scope.savingAddress )
            $scope.buttonText = "Guardando";
        else
            $scope.buttonText = "Guardar";
    }

    function loadAddresses() {

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

                if ( result.status == 'EMPTY' ) {
                    $scope.addressesEmpty = true;
                }

                if ( result.status == 'SESSION_EXPIRED' ) {
                    window.location = "/account";
                }


            }).
            error(function (data, status, headers, config) {
                //$window.location.reload();
                console.info(data + ":(");
            });
    }

}]);
