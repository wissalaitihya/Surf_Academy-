<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Taghazout Surf Expo</title>
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

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin: 24px 0;
            gap: 10px;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: #0891b2;
            flex-shrink: 0;
            border-radius: 4px;
        }

        .checkbox-label {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.5;
            cursor: pointer;
            flex: 1;
        }

        .checkbox-label a {
            color: #0891b2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .checkbox-label a:hover {
            color: #0e7490;
            text-decoration: underline;
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

            .form-input,
            .form-select {
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
            <div class="logo-title">Create your account</div>
            <div class="form-subtitle">Join our community of surfers</div>
        </div>

        <!-- Error Message -->
        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="../index.php?action=register" method="POST">
            <!-- Full Name Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        class="form-input" 
                        name="name" 
                        placeholder="Full Name" 
                        required
                    >
                </div>
            </div>

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
                        placeholder="Password (min 6 characters)" 
                        required
                    >
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <input 
                        type="password" 
                        class="form-input" 
                        name="confirm_password" 
                        placeholder="Confirm Password" 
                        required
                    >
                </div>
            </div>


            <!-- Terms and Policy Checkbox -->
            <div class="checkbox-group">
                <input type="checkbox" id="terms" class="checkbox-input" name="agree_terms" required>
                <label for="terms" class="checkbox-label">
                    I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Join the Expo</button>
        </form>

        <!-- Form Footer -->
        <div class="form-footer">
            <span class="footer-text">
                Already have an account? 
                <a href="login.php" class="footer-link">Log in</a>
            </span>
        </div>
    </div>
</body>
</html>