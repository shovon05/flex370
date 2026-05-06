<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Failed</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e1e2f, #34345a);
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;

            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            animation: pop 0.4s ease-in-out;
        }

        @keyframes pop {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .icon {
            font-size: 50px;
            color: red;
            margin-bottom: 10px;
        }

        h2 {
            color: #1e1e2f;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background: #1e1e2f;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }

        a:hover {
            background: #34345a;
        }
    </style>
</head>

<body>

<div class="box">
    <div class="icon">❌</div>

    <h2>Invalid Login</h2>

    <p>Username or Password is incorrect.<br>Please try again.</p>

    <a href="logInSignUp.html">Go Back to Login</a>
</div>

</body>
</html>