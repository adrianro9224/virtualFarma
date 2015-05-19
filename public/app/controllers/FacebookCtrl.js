/**
 * Created by Adrian on 14/05/2015.
 */

farmapp.controller('FacebookCtrl', ['$scope', '$http', function( $scope, $http) {
    'use strict';

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            testAPI();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Inicia session ' +
            'con nuestra aplicación.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Inicia sesión ' +
            'en Facebook.';
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '919021711482493',
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.3' // use version 2.2
        });

        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {

        var user = {};
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
            console.log(response);

            user.public_profile = response;

            FB.api( '/' + response.id + '/permissions', function( permissions ) {
                console.log( permissions );

                user.permissions = permissions;
            });

            FB.api( '/' + response.id + '/friends', function( friends ) {
                console.log(friends);

                user.friends = friends;
            });
            console.info(user);

            document.getElementById('status').innerHTML = 'Gracias por iniciar sesión , ' + response.name + '!';

            $http.post("http://virtualfarma.com.co/account/facebook_login" , { data : user} )
                .success(function(data, status, headers, config) {

                    console.info(data);
                    if ( data == 'just_logued' || data == 'sing_up')
                        window.location = '/account/log_in';

                }).
                error(function(data, status, headers, config) {
                    $location.reload();
                    console.info(data + ":(");
                });

        });

    }

}]);
