<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyProfileEdit</title>
    </head>
    <body>
        @guest
            <form method="POST" action="{{ route('login') }}">@csfr</form>
        @endguest
        
        <h1>Myプロフィール編集画面</h1>
    </body>
</html>