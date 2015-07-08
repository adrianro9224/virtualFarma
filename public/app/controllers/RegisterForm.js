/**
 * Created by Adrian on 10/12/2014.
 */


farmapp.controller('RegisterForm', ['$scope', function($scope) {

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    };

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    };



    $scope.isEqual = function ( secondInput, typeInputToCompare ) {

        switch ( typeInputToCompare ) {
            case 'e':
                compareEmails( secondInput );
                break;
            case 'p':
                comparePasswords( secondInput );
                break;

        }
    };

    function compareEmails( emailInputConfirmation ) {

        if ( $scope.userEmail != emailInputConfirmation ) {
            $scope.emailComparation = false;
        }else {
            $scope.emailComparation = true;
        }

    }

    function comparePasswords( passwordInputConfirmation ) {

        if ( $scope.userPassword != passwordInputConfirmation ) {
            $scope.passwordComparation = false;
        }else {
            $scope.passwordComparation = true;
        }

    }


    document.onkeydown = function (e) {
        e = e || window.event;//Get event
        if (e.ctrlKey) {
            var c = e.which || e.keyCode;//Get key code

            console.info(e.keyCode);
            switch (c) {
                case 67://Block Ctrl+S
                    e.preventDefault();
                    e.stopPropagation();
                    break;
                case 86://Block Ctrl+W --Not work in Chrome
                    e.preventDefault();
                    e.stopPropagation();
                    break;
            }
        }
    };
}]);