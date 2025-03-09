<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginSignUp - Jowley’s Crafts</title>
    
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
            height: 100vh;
            padding: 20px;
            flex-direction: column;
        }

        .header-bar, .footer-bar {
            width: 100%;
            height: 8px;
            background-color: #E32C89;
            position: fixed;
            left: 0;
        }

        .header-bar { top: 0; }
        .footer-bar { bottom: 0; }

        /* Header Styles */
        .header {
            position: absolute;
            top: 20px;
            left: 100px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-name {
            font-family: 'Oleo Script Swash Caps', cursive;
            font-size: 37px;
            color: #E32C89;
            margin-right: 70px
        }

        .login-text {
            font-family: 'Gabarito', sans-serif;
            font-size: 32px;
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
            width: 1300px;
            max-width: 90%;
            height: 550px;
        }

        .left-content img {
            width: 260px;
        }
        
        .left-content {
            width: 50%;
            text-align: left;
            padding-right: 10px;
            padding-left: 30px;
            font-family: 'Gabarito', sans-serif;
        }

        .login-message {
             color: #E32C89;
             font-family: 'Gabarito', sans-serif;
             font-size: 24px;
        }

        .welcome-text {
            font-size: 60px;
            font-weight: 500;
        }

        .right-content {
            width: 50%;
            text-align: left;
            padding-left: 90px;
            padding-right: 30px;
            font-family: 'Gabarito', sans-serif;
        }

        .right-content h2 {
            font-size: 37px;
            font-weight: 500;
            margin-bottom: 30px;
            color: #E32C89;
            text-align: center;
            width: 100%;
        }

        .right-content p {
            font-size: 32px;
            color: #666;
            margin-bottom: 20px;
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
            height: 60px;
            font-size: 15px;
            font-weight: 400;
            font-family: 'Gabarito', sans-serif;
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

        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 40px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        .forgot-login-container {
            display: flex;
            justify-content: space-between; 
            font-size: 15px;
            margin-bottom: 20px;
            font-family: 'Gabarito', sans-serif;
        }

        .forgot-password{
            text-decoration: none;
            color: #E32C89;
            
        }

        .login-with-phone {
            text-decoration: none;
            color: black;
            
        }

        .forgot-password:hover,
        .login-with-phone:hover {
            text-decoration: underline;
        }


        .btn {
            width: 100%;
            background: #E32C89;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            font-weight: 300;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .btn:hover {
            background: #c92473;
        }

        .social-login {
            display: flex;
            align-items: center;
            text-align: center;
            font-size: 16px;
            font-family: 'Gabarito', sans-serif;
            color: #666;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .social-login::before,
        .social-login::after {
            content: "";
            flex: 1;
            height: 1px; 
            background-color: #666; 
            margin: 0 10px; 
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icons i {
            font-size: 30px;
            color: #E32C89;
            cursor: pointer;
            transition: color 0.3s;
        }

        .social-icons i:hover {
            color: #c92473;
        }

        .register-link {
            text-align: center;
            font-family: 'Gabarito', sans-serif;
            font-size: 15px;
            margin-top: 20px;
        }

        .register-link a {
            color: #E32C89;
            font-weight: 500;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                padding: 30px;
            }

            .left-content img {
                width: 200px;
                margin-bottom: 20px;
            }

            .right-content {
                width: 100%;
                padding: 0;
            }

            .input-group input {
                padding: 12px 15px;
            }

            .password-container .toggle-password {
                right: 10px;
            }

            .forgot-password {
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="header-bar"></div>

    <!-- Header with "Jowley's Craft" and "Log In" -->
    <div class="header">
        <span class="brand-name">Jowley's Craft</span>
        <span class="login-text">Log In</span>
    </div>

    <div class="container">
        <div class="left-content">
            <h1 class="welcome-text">Welcome Back!</h1>
            <p class="login-message">Please log in to your account.</p>
            <img src="shopping-cart.png" alt="Shopping Illustration">
        </div>

        <div class="right-content">
        <h2>Log In</h2>
            <form action="#">
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Phone Number/Username/Email" required>
                </div>

                <div class="input-group password-container">
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" placeholder="Password" required>
                </div>
                <div class="forgot-login-container">
                    <a href="#" class="forgot-password">Forgot Password?</a>
                    <a href="#" class="login-with-phone">Log In with Phone Number</a>
                </div>


                <button class="btn">LOG IN</button>

                <div class="social-login">Or log in with</div>
                <div class="social-icons">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-tiktok"></i>
                </div>

                <div class="register-link">
                    Don't have an account? <a href="#">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <div class="footer-bar"></div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password");

            if (password.type === "password") {
                password.type = "text";
                toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                password.type = "password";
                toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

</body>
</html>
