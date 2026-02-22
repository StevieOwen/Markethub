<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        /* Using a different color for security/account alerts */
        .header { background-color: #2c3e50; color: white; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
        .button { display: inline-block; padding: 10px 20px; background-color: #2c3e50; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { font-size: 12px; color: #777; margin-top: 20px; text-align: center; }
        .warning { font-size: 13px; background-color: #f9f9f9; padding: 10px; border-left: 4px solid #f39c12; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        <p>Hi <strong><?= htmlspecialchars($name) ?></strong>,</p>
        <p>We received a request to reset the password for your Market Hub account. No problem! You can use the code below to complete the process:</p>
        
        <h2 style="letter-spacing: 5px; color: #2c3e50; text-align: center;"><?= $token ?></h2>

        <p>Alternatively, you can click the button below to set a new password directly:</p>
        <div style="text-align: center;">
            <a href="<?= $_ENV['APP_URL'] ?>/reset-password?token=<?= $token ?>" class="button" style="color: #ffffff;">Reset My Password</a>
        </div>

        <div class="warning">
            <p><strong>Did you not request this?</strong> If you didn't ask to reset your password, you can safely ignore this email. Your password will stay the same, but you might want to check your account security settings.</p>
        </div>
        
        <div class="footer">
            &copy; <?= date('Y') ?> Market Hub. All rights reserved.
        </div>
    </div>
</body>
</html>