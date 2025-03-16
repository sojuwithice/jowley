<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccountRecovery - Jowley’s Crafts</title>
    
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

        .header-bar {
            margin-top: 65px;
            width: 100%;
            height: 1px;
            background-color: #E32C89;
            position: fixed;
            left: 0;
        }

        .footer-bar{
            margin-top: 65px;
            width: 100%;
            height: 35px;
            background-color: #E32C89;
            position: fixed;
        }
        .header-bar { top: 0; }
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
            margin-right: 55px
        }

        .recovery-text {
            font-family: 'Gabarito', sans-serif;
            font-size: 1.3rem;
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
            width: 60%;
            max-width: 600px;
            height: auto;
            text-align: center;
}

        .forgot {
            font-size: 35px;
            margin-bottom: 10px;
            font-family: 'Gabarito', sans-serif;
            color: black;
            font-weight: 500;
        }

        .code-message {
            font-size: 13px;
            margin-bottom: 30px;
            color: #E32C89;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
            width: 100%; 
            text-align: center;
            padding-right: 235px;
            padding-bottom: 70px;
        }

 
        .input-group input {
                width: 220%;
                padding: 12px 15px 12px 40px;
                border-radius: 8px;
                border: 1px solid black;
                height: 40px;
                font-size: 13px;
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


        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px; 
            width: 100%;
        }

        .btn {
            padding: 8px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-btn {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .cancel-btn:hover {
            background-color:rgb(255, 255, 255);
            color: #E32C89;
            border: 1px solid #E32C89;
        }

        .confirm-btn {
           background-color: #E32C89;
           color: white;
           border: 0;
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
        <span class="recovery-text">Account Recovery</span>
    </div>

    <div class="container">
        <div>
            <h1 class="forgot">Forgot Password</h1>
            <p class="code-message">Please enter the account for which you want to reset the password</p>
        </div>
        <div>
            <form action="#">
            <div class="input-group">
                <p class="Mobile" style="text-align: left; font-size: 13.6px; font-weight: 500; color: black; font-family: 'Gabarito', sans-serif; margin-bottom: 5px;">Mobile Number or Email</p>
                <input type="text" placeholder="Please enter your Phone Number or Email" required style="margin-top: 0;">
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
