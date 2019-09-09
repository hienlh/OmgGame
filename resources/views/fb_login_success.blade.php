{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Facebook Login Success</title>
    <script>
        window.onload = () => {
            console.log('login success');
            // parent.WebviewManager.loadScene()
            document.location = 'omggame://loginsuccess';
        }
    </script>
</head>
<body>
</body>
</html> --}}

<html>
<body>
    <dev>
        <input type="button" value="Trigger" onclick="onClick()"/>
        <input type="button" value="Function" onclick="func()"/>
    </dev>
</body>
<script>
    function onClick () {
        // One of them sets up the URL scheme
        document.location = 'omggame://loginsuccess&a=1&b=2';
    }
    function func () {
        parent.loadScene();
    }
</script>
</html>
