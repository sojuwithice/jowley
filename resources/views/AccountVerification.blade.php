<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccountVerification - Jowley’s Crafts</title>
    
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

        .Verification-text {
            font-family: 'Gabarito', sans-serif;
            font-size: 32px;
            color: black;
            font-weight: 400;
        }

        .container {
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: center;
            background: white;
            padding: 40px;
            border-radius: 30px;
            border: 1px solid black; 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 900px;
            max-width: 90%;
            height: 500px; 
            text-align: center; 
        }

        .Verify {
            font-size: 48px;
            margin-bottom: 10px;
            font-family: 'Gabarito', sans-serif;
            color: black;
            font-weight: 500;
        }

        .code-message {
            font-size: 20px;
            margin-bottom: 20px;
            color: #E32C89;
        }

        .input-group input {
            width: 600px;
            padding: 12px 15px 12px 40px;
            border-radius: 20px;
            border: 1px solid black;
            height: 70px;
            font-size: 20px;
            font-weight: 400;
            font-family: 'Gabarito', sans-serif;
            outline: none;
            transition: all 0.3s ease;
            margin-top:30px;
            margin-bottom:100px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px; 
            width: 100%;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-btn {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .cancel-btn:hover {
            background-color: #f0f0f0;
        }

        .confirm-btn {
            background-color: #E32C89;
            color: white;
            border: 1px solid black;
        }

        .confirm-btn:hover {
            background-color: #c12572;
        }


    </style>
</head>
<body>

    <div class="header-bar"></div>

    <!-- Header with "Jowley's Craft" and "Log In" -->
    <div class="header">
        <span class="brand-name">Jowley's Craft</span>
        <span class="Verification-text">Account Verification</span>
    </div>

    <div class="container">
        <div>
            <h1 class="Verify">Verify your Identity</h1>
            <p class="code-message">Please enter the OTP via SMS to continue</p>
        </div>

        <div>
            <form action="#">
                <div class="input-group">
                    <input type="text" placeholder="Enter the code" required>
                </div>
                    <div class="button-group">
                        <button class="btn cancel-btn">Cancel</button>
                        <button class="btn confirm-btn">Confirm</button>
                    </div>
            </form>
        </div>
    </div>

    <div class="footer-bar"></div>


</body>
</html>
