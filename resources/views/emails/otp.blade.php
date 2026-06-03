<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Reset Password</title>
    <style>
        body {
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            background-color: #F8FAF5;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #EFF3EA;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }
        .header {
            background-color: #1B4332;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 40px 30px;
            color: #1A1A2E;
            line-height: 1.6;
        }
        .content p {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 15px;
            color: #555555;
        }
        .greeting {
            font-size: 18px !important;
            font-weight: 700;
            color: #1A1A2E !important;
            margin-bottom: 15px !important;
        }
        .otp-container {
            background-color: #F8FAF5;
            border: 2px dashed #52B788;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 6px;
            color: #1B4332;
            margin: 0;
        }
        .footer {
            background-color: #EFF3EA;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
            border-top: 1px solid #EFF3EA;
        }
        .warning-text {
            font-size: 13px !important;
            color: #C41E3A !important;
            margin-top: 25px !important;
            border-left: 3px solid #C41E3A;
            padding-left: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CV. BENIH RAKYAT</h1>
        </div>
        <div class="content">
            <p class="greeting">Halo, {{ $nama }}!</p>
            <p>Kami menerima permintaan untuk menyetel ulang password akun Anda. Silakan gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
            
            <div class="otp-container">
                <p style="margin: 0 0 10px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #52B788; font-weight: 700;">Kode OTP Anda</p>
                <h2 class="otp-code">{{ $otp }}</h2>
            </div>
            
            <p>Kode OTP ini berlaku selama <strong>10 menit</strong> sejak email ini dikirimkan.</p>
            
            <p class="warning-text">Jika Anda tidak meminta perubahan ini, abaikan email ini dengan aman. Jangan berikan kode OTP ini kepada siapa pun untuk keamanan akun Anda.</p>
        </div>
        <div class="footer">
            <p>&copy; 2026 CV. Benih Rakyat. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>
