<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>M-TECH Examination Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

</head>

<body>

<div class="overlay"></div>

<!-- HEADER -->

<div class="top-header">

    <img src="https://mtechinstitute.com/wp-content/uploads/2025/03/weblogoblue.png" alt="MTECH Logo">

</div>

<!-- LOGIN -->

<div class="login-wrapper">

    <div class="login-box">

        <!-- HEADER -->

        <div class="login-header">
            <h2>Login Here</h2>
        </div>

        <!-- BODY -->

        <div class="login-body">

            <form action="{{ route('student.login.submit') }}" method="POST">
                @csrf
                @if(session('error'))
                    <div class="alert alert-danger mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="input-group">

                    <label>Student ID</label>

                    <input
                        type="text"
                        name="roll_no"
                        value="{{ old('roll_no') }}"
                        placeholder="Enter Student ID">

                    @error('roll_no')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter Password">

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <button type="submit" class="login-btn">

                    Login

                </button>

            </form>

            <div class="footer">
                © 2026 M-TECH Institute Examination System
            </div>

        </div>

    </div>

</div>

</body>
</html>