<!DOCTYPE html>

<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">
    <title>LOGIN DOCC.SPACE</title>

    <style type="text/css">


        body {
            background: linear-gradient(to top left, #36394c, #2b2d3c);
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Gilroy, sans-serif;
            font-weight: 400;
        }

        .centre-block {
            width: 365px;
            height: 295px;
            border-radius: 5px 5px 5px 5px;
            background: linear-gradient(to top left, #2c2e3d, #3f4055);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15%;
            text-align: center;
            padding-top: 10px;
            display: flex;
            justify-content: center;
        }

        .fm {
            margin-top: 15px;
        }

        .label {
            color: white;
        }

        .m40 {
            margin-top: 40px;
        }

        .sub {
            background-color: #2d2f3e;
            color: grey;
            width: 240px;
            height: 45px;
            box-shadow: 1px 3px rgb(35, 37, 51);
            border: none;
            margin-top: 30px;
            border-radius: 6px 6px 6px 6px;
            font-family: Gilroy, sans-serif;
            font-weight: 500;
            cursor: pointer;

        }
        .sub:hover{
            background-color: #282a39;
            color: white;
        }

        .inp-form {
            background-color: #2b2d3c;
            width: 225px;
            height: 40px;
            text-align: center;
            display: flex;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 6px 6px 6px 6px;
            box-shadow: inset 0 2px #232533, 0 0 6px 2px #44455a;
        }

        .in {
            padding-top: 6px;
            margin-top: 6px;
            font-size: 12px;
            color: #5a5d73;
            border-right: 1px solid;
            height: 20px;
            font-weight: 500;

        }
        .fm{
            margin-left: -13px;
        }

        .ic {
            transform: translate(280px);
        }
        .field {
            background-color: transparent;
            border: none;
            color: white;
            padding-left: 7px;
        }

        .lab1 {
            padding-right: 10px;
        }

        .lab2 {
            padding-right: 15px;
            padding-left: 5px;
        }

        .ic {
            font-size: 15px;
            color: grey;
            transform: translate(285px);

        }
    </style>

</head>

<body>


<div class="centre-block">
    <i class="material-icons ic">close</i>

    <form class="fm" action="{{route('login')}}" method="POST">
        @csrf
        <p><span class="label">Введите данные для входа:</span></p>
        <div class="m40">
            @if (session('error'))
                <span style="color: red">{{session('error')}}</span>

            @endif
            <div class="inp-form">
                <label class="in" for="loginField"><span class="lab1">LOGIN</span></label>
                <input class="field" id="loginField" type="text" name="login" required>
            </div>


            <br>

            <div class="inp-form">
                <label class="in" for="passwordField"><span class="lab2">PASS</span></label>
                <input class="field" id="passwordField" type="password" name="password" required>
            </div>
        </div>
        <input type="submit" class="sub" value="Войти">
    </form>
</div>

</body>

</html>