<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jowley’s Crafts</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
            padding: 90px;
            flex-direction: column;
        }

        .header-bar, .footer-bar {
            width: 100%;
            height: 35px;
            background-color: #E32C89;
            position: fixed;
        }

        .header-bar { top: 0; height: 1px; }
        .footer-bar { bottom: 0; }

        .header {
            position: fixed;
            top: 20px;
            left: 100px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-name {
            font-family: 'Oleo Script Swash Caps', cursive;
            font-size: 1.6rem;
            color: #E32C89;
            margin-right: 55px;
        }

        .signin-text {
            font-family: 'Gabarito', sans-serif;
            font-size: 1.2rem;
            color: black;
            font-weight: 400;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 40px;
            border-radius: 30px;
            border: 1px solid black;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 90%;
            height: 500px;
        }

        .left-content {
            width: 50%;
            text-align: left;
            padding: 0 20px;
            font-family: 'Gabarito', sans-serif;
        }

        .signin-message { color: #E32C89; font-size: 17px; }
        .new-text { font-size: 45px; font-weight: 500; }

        .right-content {
            width: 60%;
            text-align: left;
            padding: 0 30px;
            font-family: 'Gabarito', sans-serif;
        }

        .right-content h2 {
            font-size: 23px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #E32C89;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border-radius: 8px;
            border: 1px solid black;
            height: 40px;
            font-size: 13px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #E32C89;
            box-shadow: 0 0 5px rgba(227, 44, 137, 0.3);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .btn {
            width: 100%;
            background: #E32C89;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            font-weight: 300;
            transition: background 0.3s;
            margin-top: 8px;
        }

        .btn:hover { background: #c92473; }

        .social-signin {
            display: flex;
            align-items: center;
            text-align: center;
            font-size: 13px;
            font-family: 'Gabarito', sans-serif;
            color: #666;
            margin: 20px 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 10px;
        }

        .social-icons i {
            font-size: 22px;
            color: #E32C89;
            cursor: pointer;
            transition: color 0.3s;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
}

        .register-link, .terms-container {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }
        .error {
            border-color: red;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.5); /* Red shadow for better visibility */
        
      
}

    </style>
</head>
<body>
    <div class="header-bar"></div>
    <div class="header">
        <span class="brand-name">Jowley's Craft</span>
        <span class="signin-text">Sign Up</span>
    </div>

    <div class="container">
        <div class="left-content">
            <h1 class="new-text">Are you new here?</h1>
            <p class="signin-message">Create an account to start.</p>
        </div>

        <div class="right-content">
        <form action="{{ url('/register') }}" method="POST">
    @csrf
    <h2>Sign Up</h2>
    <div class="input-group">
    <i class="fa fa-user"></i>
    <input type="text" name="username" placeholder="Enter your Username" required 
        value="{{ old('username') }}" class="{{ $errors->has('username') ? 'error' : '' }}">
    @error('username')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="input-group">
    <i class="fa fa-envelope"></i>
    <input type="email" name="email" placeholder="Enter your Email" required 
        value="{{ old('email') }}" class="{{ $errors->has('email') ? 'error' : '' }}">
    @error('email')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="input-group">
    <i class="fa fa-phone"></i>
    <input type="tel" name="phone" placeholder="Enter your Phone Number" required 
        value="{{ old('phone') }}" class="{{ $errors->has('phone') ? 'error' : '' }}">
    @error('phone')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="input-group">
    <i class="fa fa-lock"></i>
    <input type="password" name="password" placeholder="Enter your Password" required 
        class="{{ $errors->has('password') ? 'error' : '' }}">
    @error('password')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="input-group">
    <i class="fa fa-lock"></i>
    <input type="password" name="password_confirmation" placeholder="Confirm your Password" required 
        class="{{ $errors->has('password_confirmation') ? 'error' : '' }}">
    @error('password_confirmation')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>


    <button type="submit" class="btn">Register</button>
    <div class="register-link">
        Already have an account? <a href="{{ url('/LoginSignUp') }}">Log in</a>
    </div>
</form>

        </div>
    </div>
    <div class="footer-bar"></div>
</body>
</html>
