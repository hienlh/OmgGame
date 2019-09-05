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
    {{--    <div class="fb-login-button" data-width="300" data-size="large"--}}
    {{--         data-button-type="continue_with"--}}
    {{--         data-auto-logout-link="false" data-use-continue-as="true"></div>--}}
    <iframe name="f2e649b59937758" width="300px"
            height="1000px"
            title="fb:login_button Facebook Social Plugin"
            frameborder="0"
            allowtransparency="true"
            allowfullscreen="true" scrolling="no"
            allow="encrypted-media"
            src="https://www.facebook.com/v4.0/plugins/login_button.php?app_id=652516575208870&amp;auto_logout_link=false&amp;button_type=continue_with&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D44%23cb%3Df150803ea1a8f1c%26domain%3D127.0.0.1%26origin%3Dhttp%253A%252F%252F127.0.0.1%253A8000%252Ff26ce30575df5c%26relation%3Dparent.parent&amp;container_width=0&amp;locale=en_US&amp;sdk=joey&amp;size=large&amp;use_continue_as=true&amp;width=300"
            style="border: none; visibility: visible; width: 300px; height: 40px;"
            class="" id="iframe-button"></iframe>
</div>
<div class="click-div" id="wrapper"></div>
<script>
    let wrapper = document.getElementById('wrapper');
    wrapper.onclick = click;

    function click() {
        window.open("{{ url('/auth/redirect/facebook') }}");
    }
</script>
<style>
    html, body {
        height: 100%;
    }

    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .fb-login-button {
        position: absolute;
        top: 45%;
    }
    .click-div {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
</style>
</body>
</html>
