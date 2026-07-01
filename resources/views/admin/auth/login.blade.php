<!-- admin-login.html -->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

</head>

<body class="admin-login-page">

<!-- LOGIN WRAPPER -->

<div class="admin-login-wrapper">

    <!-- LEFT SIDE -->

    <div class="admin-login-left">

        <div class="admin-overlay"></div>

        <div class="admin-login-content">

            <img src="https://mtechinstitute.com/wp-content/uploads/2025/03/weblogoblue.png">

            <h1>
                Examination Management System
            </h1>

            <p>
                Professional Computer Based Testing Platform
                for Institutes & Training Centers.
            </p>

        </div>

    </div>

    <!-- RIGHT SIDE -->

    <div class="admin-login-right">

        <div class="admin-login-box">

            <div class="admin-login-header">

                <h2>Admin / Teacher Login</h2>

                <p>
                    Login to continue
                </p>

            </div>

            <!-- FORM -->
@if($errors->any())

    <div style="color:red">

        {{ $errors->first() }}

    </div>

@endif

@if(session('error'))

<p style="color:red">

    {{ session('error') }}

</p>

@endif
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="admin-form-group">

                    <label>Email</label>

                    <input type="text" class="admin-input" name="email" placeholder="Email" value="{{ old('email') }}">

                </div>

                <div class="admin-form-group">

                    <label>Password</label>

                    <input type="password" class="admin-input" name="password" placeholder="Enter Password">

                </div>

                <button type="submit" class="admin-btn">

                    Login

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>