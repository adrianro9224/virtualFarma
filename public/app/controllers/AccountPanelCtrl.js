/**
 * Created by Adrian on 01/12/2014.
 */



farmapp.controller('AccountPanelCtrl', ['$scope', '$rootScope', 'ConstantsService', function( $scope, $rootScope, ConstantsService ) {

    "use strict";

    $scope.myAccountSelected = false;
    $scope.myPurchasesSelected = true;
    $scope.myDiagnosticSelected = false;

    $scope.openSection = function ( panelSelection ) {

        switch (panelSelection) {
            case 'myAccount':
                if(!$scope.myAccountSelected) {

                    $rootScope.$broadcast(ConstantsService.CHARGE_EVERY_USER_ADDRESSES);

                    $scope.myAccountSelected = true;
                    $scope.myPurchasesSelected = false;
                    $scope.myDiagnosticSelected = false;
                }
            break;
            case 'myPurchases':
                if(!$scope.myPurchasesSelected) {
                    $scope.myPurchasesSelected = true;
                    $scope.myAccountSelected = false;
                    $scope.myDiagnosticSelected = false;
                }
            break;
            case 'myDiagnostic':
                if(!$scope.myDiagnosticSelected) {

                    $rootScope.$broadcast(ConstantsService.CHARGE_ALL_VF_PATHOLOGIES);

                    $scope.myDiagnosticSelected = true;
                    $scope.myPurchasesSelected = false;
                    $scope.myAccountSelected = false;
                }
            break;
        }

    }
    
}]);