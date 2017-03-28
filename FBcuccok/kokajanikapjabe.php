<!DOCTYPE html>
<html>
<head>
    <title>Facebook Login JavaScript Example</title>
    <meta charset="UTF-8">
</head>
<body>
<script>
    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);

        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            document.getElementById('status').innerHTML = 'Be vagyunk jelentkezve';
            document.getElementById('post').style.visibility = 'visible';
            document.getElementById('login').style.visibility = 'hidden';

            var access_token =   FB.getAuthResponse()['accessToken'];
            acc_token = FB.getAuthResponse()['accessToken'];
            console.log('Access Token = '+ access_token);
            // Logged into your app and Facebook.
            //testAPI();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Jelentkezz be az appunkba a bejelentkezés gombbal, ha szeretnél megosztani! :)';
            document.getElementById('post').style.visibility = 'hidden';
            document.getElementById('login').style.visibility = 'visible';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Jelentkezz be a Facebookba a bejelentkezés gombbal, ha szeretnéd megosztani az eseményt! :)';
            document.getElementById('post').style.visibility = 'hidden';
            document.getElementById('login').style.visibility = 'visible';
        }

        FB.api('/me/permissions', function(response) {
            var declined = [];
            for (i = 0; i < response.data.length; i++) {
                if (response.data[i].status == 'declined') {
                    declined.push(response.data[i].permission)
                    FB.api("/me/permissions","DELETE",function(response){
                        console.log(response); //gives true on app delete success
                    });
                    window.location.reload(true);
                    alert("Ha nem fogadod el a megosztást nem léphetsz be az appba");
                }
            }

        });
        
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
            appId      : '227215211017694',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.8'
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
        js.src = "//connect.facebook.net/en_EN/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.

    function post() {
        var szoveg = document.getElementById("Name1").value;
        FB.api('/me/feed', 'post', {message: szoveg, link: "http://napiforras.hu/talalkozo/"}, function(response) {
            document.getElementById('status').innerHTML = response.id;
            if (!response || response.error) {
                alert('Hiba történt');
            } else {
                alert('Sikeres megosztás');
            }
        });
    }

    function login() {
        FB.init({
            appId      : '227215211017694',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.8'
        });
        FB.login(function(response) {
            statusChangeCallback(response);
        }, {scope: 'public_profile,email,publish_actions'});


    }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<div onclick="login()" id="login"> <img src="http://napiforras.hu/login.png"/> </div>
<br>
<div id="post">
<div onclick="post()"> <img src="http://napiforras.hu/fb-share.png"/> </div>
    Ide írd le mit tudnál hozni! :) : <input type="text" name="fname" id="Name1"><br>
</div>

<div id="status">
</div>

</body>
</html>