<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .wrapper { background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; margin: -30px -30px 30px -30px; }
        .token-box { background-color: #f9f9f9; border: 2px dashed #4CAF50; padding: 20px; text-align: center; margin: 25px 0; border-radius: 10px; }
        .token-code { font-size: 32px; font-weight: bold; letter-spacing: 8px; color: #4CAF50; margin: 0; }
        .button { display: inline-block; padding: 12px 25px; background-color: #4CAF50; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 10px; }
        .footer { font-size: 12px; color: #999; margin-top: 30px; text-align: center; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1 style="margin: 0;">Market Hub</h1>
            </div>
            
            <p>Hi <strong><?= htmlspecialchars($name) ?></strong>,</p>
            
            <p>We're thrilled to have you join our community! To get started and secure your account, please verify your email address.</p>
            
            <div class="token-box">
                <p style="margin-top: 0; font-size: 14px; color: #666; text-transform: uppercase;">Your Verification Code</p>
                <div class="token-code"><?= $token ?></div>
            </div>

            <p>Simply enter this code in your browser</p>
            
            <!-- <div style="text-align: center;">
                <a href="<?= $_ENV['APP_URL'] ?>/verify?token=<?= $token ?>" class="button">Verify My Email</a>
            </div> -->

            <p style="margin-top: 30px;">If you didn't create an account with us, no further action is required.</p>
            
            <div class="footer">
                &copy; <?= date('Y') ?> Market Hub. All rights reserved.<br>
                Building the future of commerce.
            </div>
        </div>
    </div>
</body>
</html>