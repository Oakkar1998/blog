<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Future Light</title>
    <link rel="stylesheet" href="{{ asset('sign-up-login-form/dist/style.css/') }}">

</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html>

    <head>
        <title>Slide Navbar</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('sign-up-login-form/src/style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="name" placeholder="Name" required="">
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required="">
                    <button type="submit">Sign up</button>
                </form>
            </div>

            <div class="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required="">
                    <input type="password" name="password" placeholder="Password" required="">
                    <button type="submit">Login</button>

                </form>
                <a href="{{ url('auth/google') }}" style="text-decoration: none;">
                    <button type="submit">Google Login</button>
                </a>

            </div>
        </div>
    </body>

    </html>
    <!-- partial -->

</body>

</html>
