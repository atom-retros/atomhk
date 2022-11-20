<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="icon" type="image/gif" sizes="18x17" href="{{ asset('assets/images/home_icon.gif') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container" style="height: 100vh;">
        <div class="d-flex flex-column gap- justify-content-center align-items-center h-100">
            <img src="{{ setting('hk_logo') }}" alt="">

            <div class="card w-50 mt-3">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    <form action="/two-factor-challenge" method="POST">
                        @csrf

                        <div class="form-group" id="twoFactorCode">
                            <label for="username">{{ __('Code') }}</label>
                            <input id="code" type="text" name="code" class="form-control"  placeholder="{{ __('Enter your 2FA code') }}">
                            <small onclick="toggleRecoveryCodeField()" style="cursor: pointer;" class="cursor-pointer italic text-gray-600 hover:underline hover:cursor-pointer">Lost access to your 2FA codes? Click here to use a recovery code</small>
                        </div>

                        <div class="form-group" id="recoveryCode">
                            <label for="recovery_code">{{ __('Recovery code') }}</label>
                            <input id="recovery_code" name="recovery_code" type="text" class="form-control" placeholder="{{ __('Enter your recovery code') }}">
                            <small onclick="toggleRecoveryCodeField()" style="cursor: pointer;" class="mt-4 italic text-gray-600 hover:underline hover:cursor-pointer">{{ __('Regained access to your 2FA codes? Click here to use your authentication app ') }}</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Confirm 2FA') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#recoveryCode').style.display = 'none';
        let showRecoveryCodeField = false;

        function toggleRecoveryCodeField() {
            if(!showRecoveryCodeField) {
                document.querySelector('#twoFactorCode').style.display = 'none';
                document.querySelector('#recoveryCode').style.display = 'block';

                showRecoveryCodeField = true;

                return;
            }

            document.querySelector('#twoFactorCode').style.display = 'block';
            document.querySelector('#recoveryCode').style.display = 'none';

            showRecoveryCodeField = false;
        }
    </script>
</body>
</html>
