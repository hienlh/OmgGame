<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Facebook Login</title>
</head>
<body>
<div class="wrapper">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=652516575208870&autoLogAppEvents=1"></script>
    <div class="fb-login-button" data-width="" data-size="large"
         data-button-type="continue_with"
         data-auto-logout-link="false" data-use-continue-as="true"></div>
</div>
<style>
    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fb-login-button {
        position: absolute;
        top: 45%;
    }
</style>
</body>
</html>
