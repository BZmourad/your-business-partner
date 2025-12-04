<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --text-color: #2b2d42;
        --light-color: #f8f9fa;
        --border-radius: 12px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        color: var(--text-color);
        padding: 20px;
    }
    .login-container {
        max-width: 450px;
        width: 100%;
        margin: 0 auto;
        padding: 2.5rem;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
    }
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }
    .logo-container {
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
    }
    .logo {
        width: 90px;
        height: 90px;
        object-fit: contain;
        margin-bottom: 1rem;
        transition: var(--transition);
        border-radius: 50%;
        padding: 8px;
        background: var(--primary-light);
        box-shadow: 0 4px 6px rgba(67, 97, 238, 0.1);
    }
    .logo:hover {
        transform: scale(1.05) rotate(-5deg);
    }
    .login-title {
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .login-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        line-height: 1.5;
    }
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius);
        border: 1px solid #e0e0e0;
        transition: var(--transition);
        font-size: 0.95rem;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }
    .input-group-text {
        background-color: var(--primary-light);
        border-radius: var(--border-radius) 0 0 var(--border-radius) !important;
        border-right: none;
        color: var(--primary-color);
        transition: var(--transition);
    }
    .input-group:focus-within .input-group-text {
        background-color: var(--primary-color);
        color: white;
    }
    .input-group .form-control {
        border-left: none;
    }
    .input-group .form-control:focus {
        box-shadow: none;
    }
    .password-input-group {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #adb5bd;
        z-index: 5;
        background: white;
        padding: 0.5rem;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .password-toggle:hover {
        color: var(--primary-color);
        background: var(--primary-light);
        transform: translateY(-50%) scale(1.1);
    }
    .password-toggle-new {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #adb5bd;
        z-index: 5;
        background: white;
        padding: 0.5rem;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .password-toggle-new:hover {
        color: var(--primary-color);
        background: var(--primary-light);
        transform: translateY(-50%) scale(1.1);
    }
    .btn-login {
        width: 100%;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: var(--border-radius);
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border: none;
        letter-spacing: 0.5px;
        transition: var(--transition);
        margin-top: 1rem;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        transition: var(--transition);
        z-index: -1;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    }
    .btn-login:hover::before {
        left: 0;
    }
    .form-check-input {
        width: 1.1em;
        height: 1.1em;
        margin-top: 0.15em;
        border: 1px solid #dee2e6;
        transition: var(--transition);
    }
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    .form-check-label {
        margin-left: 0.5rem;
        color: #495057;
        font-size: 0.9rem;
    }
    .forgot-password {
        text-align: center;
        margin-top: 1.5rem;
    }
    .forgot-password a {
        color: #6c757d;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s;
        font-weight: 500;
    }
    .forgot-password a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }
    .divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        color: #adb5bd;
        font-size: 0.8rem;
    }
    .divider::before, .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #e0e0e0;
    }
    .divider::before {
        margin-right: 1rem;
    }
    .divider::after {
        margin-left: 1rem;
    }
    .social-login {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: var(--transition);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .social-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .social-btn.google {
        background: #DB4437;
    }
    .social-btn.facebook {
        background: #4267B2;
    }
    .social-btn.twitter {
        background: #1DA1F2;
    }
    .register-link {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.9rem;
    }
    .register-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .login-container {
        animation: fadeIn 0.6s ease-out forwards;
    }
    .logo {
        animation: float 4s ease-in-out infinite;
    }
    .form-group {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease-out forwards;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @media (max-width: 576px) {
        .login-container {
            padding: 1.8rem;
            margin: 0;
        }
        .logo {
            width: 80px;
            height: 80px;
        }
        .login-title {
            font-size: 1.5rem;
        }
    }
    @media (max-width: 576px) {
        body {
            padding: 0;
            background: #fff; 
        }
        .container {
            padding: 0;
            margin: 0;
            width: 100%;
        }
        .login-container {
            max-width: 100%;
            height: 100vh;
            border-radius: 0;
            padding: 1.5rem;
            box-shadow: none;
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .logo {
            width: 70px;
            height: 70px;
        }
    }
    .back-to-home {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }
    .back-to-home a {
        display: inline-flex;
        align-items: center;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        background: var(--primary-light);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    .back-to-home a:hover {
        color: white;
        background: var(--primary-color);
        transform: translateX(-3px);
    }
    .back-to-home i {
        margin-right: 0.5rem;
        transition: var(--transition);
    }
    .back-to-home a:hover i {
        transform: translateX(-3px);
    }
    @media (max-width: 576px) {
        .back-to-home {
            top: 15px;
            left: 15px;
        }
        
        .back-to-home a {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
    }
</style>