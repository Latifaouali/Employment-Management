<!DOCTYPE html>
<html>

<head>
    <style>
        #login_bg {
            background: #cbdce5;
            padding: 15px 28px;
            height: 100vh;
        }

        .container {
            margin-top: 4%
        }

        .btn {
            margin-top: 12%;
            margin-left: 26%;
            border-radius: 92px;
            width: 42%;
            padding: 10px;
            background: #D61C4E !important;
            color: white;
            transition: box-shadow 0.3s;
        }

        .btn:hover {
            box-shadow: 0 0 2px 2px #d61c4e6a;
        }

        #blue {
            color: #293462
        }

        #pink {
            color: #D61C4E;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/content.css') }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main id="login_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center" id="blue">Login</h3>
                        @if ($message = Session::get('success'))
                        <p class="text-center" style="color:green">{{ $message }}</p>
                        @endif
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control"
                                        name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn text-white">Signin</button>
                                </div>
                            </form>
                            <p>Don't have an account ?<a href={{route('users.create')}}> rgister now !</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
