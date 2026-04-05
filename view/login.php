<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taghazout Surf Expo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #ede5d9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 48px 32px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-tag {
            font-size: 12px;
            font-weight: 600;
            color: #0891b2;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 12px;
        }

        .logo-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #6b7280;
            font-weight: 400;
            letter-spacing: 0.2px;
        }

        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .success-message {
            background-color: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            font-size: 18px;
            color: #9ca3af;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
        }

        .input-icon svg {
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #1f2937;
            background-color: #f9fafb;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #0891b2;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .submit-button {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 12px;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(8, 145, 178, 0.3);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .footer-text {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
        }

        .footer-link {
            color: #0891b2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #0e7490;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 32px 20px;
            }

            .logo-title {
                font-size: 20px;
            }

            .form-input {
                padding: 12px 14px 12px 44px;
                font-size: 16px;
            }

            .input-icon {
                left: 12px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <div class="logo-tag">Taghazout Surf Expo</div>
            <div class="logo-title">Welcome back</div>
            <div class="form-subtitle">Log in to your account</div>
        </div>

        <!-- Error Message -->
        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if(isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?= htmlspecialchars($_SESSION['success']); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="../index.php?action=login" method="POST">
            <!-- Email Address Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                    </span>
                    <input 
                        type="email" 
                        class="form-input" 
                        name="email" 
                        placeholder="Email Address" 
                        required
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        class="form-input" 
                        name="password" 
                        placeholder="Password" 
                        required
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Log In</button>
        </form>

        <!-- Form Footer -->
        <div class="form-footer">
            <span class="footer-text">
                Don't have an account? 
                <a href="Register.php" class="footer-link">Create one</a>
            </span>
        </div>
    </div>
</body>
</html>
        
    
