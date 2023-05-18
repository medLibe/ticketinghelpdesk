<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Helpdesk Ticket System | Login</title>

    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="/assets/vendors/nprogress/nprogress.css" rel="stylesheet">

    <link href="/assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <link href="/assets/build/css/custom.min.css" rel="stylesheet">
    <meta name="robots" content="noindex, follow">
</head>

<body class="login">
    @include('sweetalert::alert')
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="/auth" method="POST" id="loginForm">
                        @csrf
                        <h1>Login Here</h1>
                        <div>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                value="{{ old('username') }}" required title="This field is required" autofocus />
                            @error('username')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                value="{{ old('password') }}" required title="This field is required" />
                            @error('password')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-info submit">Log in</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').validate();
        });
    </script>
</body>

</html>
