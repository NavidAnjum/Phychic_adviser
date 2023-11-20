<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins";
            color: #c7c7c7;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(67,153,255,1) 100%, rgba(0,212,255,1) 100%, rgba(9,114,115,1) 100%);

        }
        .register {
            position: relative;
            width: 700px;
            height:100%;
            background-color: #181A21;
            overflow: hidden;
            padding: 20px 30px;
        }
        .register__content-logo {
            text-align: start;
        }
        .register__logo {
            width: 200px;
            margin-left: -25px;
            cursor: pointer;
            pointer-events: none;
            user-select: none;
        }
        .register__container-log {
            display: flex;
            flex-direction: row;
        }
        .register__login-form {
            display: flex;
            flex-direction: column;
            width: 90%;
        }
        .login-form__input {
            height: 40px;
            border: none;
            outline: none;
            padding: 8px 10px;
            background-color: #32353C;
            box-shadow: 0px 0px 10px 2px #1e1e1f;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
        }
        .login-form__input:hover {
            background-color: #3c3e44;
        }
        .login-form__label {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
            user-select: none;
        }
        .login-form__label--one {
            color: #1999DB;
        }
        .login-form__label--two {
            text-align: start;
            color: #a3a3a5;
        }
        .login-form__checkbox-label {
            color: #a3a3a5;
            margin-left: 5px;
            user-select: none;
        }
        .btn--login {
            width: 70%;
            height: 45px;
            border-radius: 5px;
            border: none;
            outline: none;
            background-color: rgb(22, 152, 228);
            color: #fff;
            margin: 0 auto;
            margin-top: 20px;
            cursor: pointer;
            user-select: none;
            font-size: 16px;
            transition: all 200ms ease;
        }
        .btn--login:hover {
            background-color: rgb(43, 169, 241);
        }
        .register__qr-content {
            text-align: center;
            margin-top: 10px;
        }
        .qr-content__qr {
            width: 200px;
            border-radius: 10px;
            cursor: pointer;
            pointer-events: none;
            user-select: none;
        }
        .qr-content__title {
            color: #1999DB;
            user-select: none;
        }
        .qr-content__parr {
            font-size: 13px;
            user-select: none;
        }
        .register__links {
            display: flex;
            flex-direction: row;
            position: absolute;
            bottom: 15px;
            display: flex;
            font-size: 12px;
            user-select: none;
        }
        .links__option--help {
            margin-right: 85px;
        }
        .links__option--text {
            margin-right: 10px;
        }

        .links__option--create {
            text-align: end;
        }
        a:hover {
            color: #eeeeee;
        }
    </style>

    @vite('resources/css/app.css')

</head>
<body>


<div id="app"></div>

@vite('resources/js/app.js')

</body>
</html>
