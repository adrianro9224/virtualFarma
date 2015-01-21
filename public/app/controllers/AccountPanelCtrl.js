/**
 * Created by Adrian on 01/12/2014.
 */



farmapp.controller('AccountPanelCtrl', ['$scope', function($scope) {

    $scope.myAccountSelected = true;
    $scope.myPurchasesSelected = false;
    $scope.myDiagnosticSelected = false;

    $scope.openSection = function ( panelSelection) {

        switch (panelSelection) {
            case 'myAccount':
                if(!$scope.myAccountSelected) {
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
                alert('asdasd');
                if(!$scope.myDiagnosticSelected) {
                    $scope.myDiagnosticSelected = true;
                    $scope.myPurchasesSelected = false;
                    $scope.myAccountSelected = false;
                }
            break;
        }

    }


}]);