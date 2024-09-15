<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
    <style>
        /* Inline styles for better email client compatibility */
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica', 'Arial', sans-serif;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            text-align: center;
        }
        .card {
            background-color: #fff;
            max-width: 80%;
            text-align: left;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8c58ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #6b37df;
        }
        .text-muted {
            color: #6c757d;
        }
        .fw-700 {
            font-weight: 700;
        }
        .mt-10 {
            margin-top: 10px;
        }
        .my-6 {
            margin-top: 6px;
            margin-bottom: 6px;
        }
        .h3 {
            font-size: 1.75rem;
        }
        .text-center {
            text-align: center;
        }
        .content {
            text-align: left;
            margin: auto 109px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">

        <header class="header">
          <!-- Logo or branding image -->
          <img class="w-24 my-10" src="{{ asset('assets/img/favicon/logo.png') }}" alt="Knotnetworks" style="width: 250px; display: block; margin: 0 auto;" />
        </header>

        <main>
            <div class="card">
              <h1 class="h3 fw-700">Your OTP Code</h1>
              <div class="content">
                <p>Dear user,</p>
                <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
                <p>This code will expire in 10 minutes. Please do not share this code with anyone.</p>
              </div>
            </div>
        </main>

        <!-- Footer section -->
        <footer class="footer">
            <div class="my-6 text-muted" style="margin-top: 10px;">
              <a class="btn" href="{{ route('home') }}" >Go to Website</a>
              <p>Copyright ©2020-{{ date('Y') }} Knotnetworks LLC. All Rights Reserved.</p>
          </div>
        </div>
    </div>
</body>
</html>
