<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | MyPG</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f8ef7;
            --primary-pressed: #3b7de8;
            --bg: #f8faff;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #94a3b8;
            --input-bg: #f8fafc;
            --input-border: #e2e8f0;
            --error: #dc2626;
            --success-light: #eef4ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 550px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            background: var(--success-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .back-btn:hover {
            transform: scale(1.05);
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
        }

        .welcome-section {
            margin-bottom: 24px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .welcome-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .section-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px -5px rgba(147, 197, 253, 0.15);
            border: 1px solid rgba(226, 232, 240, 0.5);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .section-header i {
            color: var(--primary);
            font-size: 14px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 24px;
        }

        .avatar-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .avatar-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--success-light);
            border: 2px dashed #bfdbfe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.3s;
            overflow: hidden;
        }

        .avatar-placeholder i {
            font-size: 40px;
        }

        .avatar-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder.error {
            border-color: #fca5a5;
            background: #fff8f8;
        }

        .avatar-edit-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 32px;
            height: 32px;
            background: var(--primary);
            border: 3px solid var(--bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .avatar-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .avatar-sublabel {
            font-size: 11px;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        label .required {
            color: var(--error);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
            font-size: 16px;
        }

        input {
            width: 100%;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            padding: 13px 44px;
            font-size: 15px;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s;
        }

        input:focus {
            border-color: var(--primary);
            background: white;
        }

        input::placeholder {
            color: #c0ccda;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .info-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--success-light);
            border: 1px solid #bfdbfe;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 24px;
        }

        .info-icon-wrap {
            width: 36px;
            height: 36px;
            background: #dbeafe;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .info-text {
            font-size: 13px;
            color: #1e40af;
            line-height: 20px;
        }

        .info-highlight {
            font-weight: 700;
            color: #1d4ed8;
        }

        .register-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(79, 142, 247, 0.35);
        }

        .register-btn:hover {
            background: var(--primary-pressed);
            transform: translateY(-1px);
        }

        .register-btn:disabled {
            background: #93c5fd;
            cursor: not-allowed;
            box-shadow: none;
        }

        .login-row {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .login-link {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .loader {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 500px) {
            .container { padding: 0; }
            .section-card { padding: 18px; }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="/" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            <div class="header-title">Create Account</div>
            <div style="width: 40px;"></div>
        </div>

        <div class="welcome-section">
            <h1 class="welcome-title">Start Your Journey 🚀</h1>
            <p class="welcome-subtitle">Join MyPG and simplify your property management</p>
        </div>

        <form id="registerForm">
            <!-- Profile Image -->
            <div class="avatar-section">
                <div class="avatar-wrapper" onclick="document.getElementById('profile_image').click()">
                    <div class="avatar-placeholder" id="avatarPreview">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="avatar-edit-badge">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="avatar-label" id="avatarLabel">Add profile photo</div>
                <div class="avatar-sublabel">Required • JPG or PNG • Max 10MB</div>
                <input type="file" id="profile_image" name="profile_image" accept="image/*" style="display: none;" onchange="handlePreview(event)">
            </div>

            <!-- PG INFO -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-building"></i>
                    <span class="section-title">PG / Hostel Info</span>
                </div>

                <div class="form-group">
                    <label>PG / Hostel Name <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-hotel input-icon"></i>
                        <input type="text" name="pg_name" placeholder="e.g. Sunrise Hostel, Happy PG" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Bed Capacity <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-bed input-icon"></i>
                        <input type="number" name="available_beds" placeholder="Total number of beds (e.g. 20)" required>
                    </div>
                </div>
            </div>

            <!-- PERSONAL INFO -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-user"></i>
                    <span class="section-title">Personal Info</span>
                </div>

                <div class="form-group">
                    <label>First Name <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-id-card input-icon"></i>
                        <input type="text" name="first_name" placeholder="Your first name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Last Name <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-id-card input-icon"></i>
                        <input type="text" name="last_name" placeholder="Your last name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Phone Number <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" name="phone" placeholder="+91 98765 43210" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>City <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-location-dot input-icon"></i>
                        <input type="text" name="city" placeholder="Your city" required>
                    </div>
                </div>
            </div>

            <!-- ACCOUNT CREDENTIALS -->
            <div class="section-card">
                <div class="section-header">
                    <i class="fas fa-shield-halved"></i>
                    <span class="section-title">Account Credentials</span>
                </div>

                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="you@example.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="password" placeholder="Min. 6 characters" required minlength="6">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword()"></i>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon-wrap">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="info-text">
                    After registration, get <span class="info-highlight">1 Year access for just ₹799!</span>
                </div>
            </div>

            <button type="submit" class="register-btn" id="submitBtn">
                <div class="loader" id="loader"></div>
                <span id="btnText">Create Account</span>
                <i class="fas fa-arrow-circle-right" id="btnIcon"></i>
            </button>
        </form>

        <!-- <div class="login-row">
            Already have an account? <a href="/login" class="login-link">Login here →</a>
        </div> -->

        <div style="height: 40px;"></div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.querySelector('.password-toggle');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                pwd.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        function handlePreview(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');
            const label = document.getElementById('avatarLabel');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    label.innerText = 'Tap to change photo';
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            // Loading state
            btn.disabled = true;
            loader.style.display = 'block';
            btnText.innerText = 'Creating Account...';
            btnIcon.style.display = 'none';

            try {
                const formData = new FormData(this);
                const response = await fetch('/api/register', {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                const data = await response.json();

                if (data.status) {
                    const email = formData.get('email');
                    const pass = formData.get('password');
                    
                    // Save to session storage for next screens
                    sessionStorage.setItem('mypg_email', email);
                    sessionStorage.setItem('mypg_pass', pass);
                    
                    window.location.href = `/payment?user_id=${data.user_id}`;
                } else {
                    let errorMsg = 'Failed: ';
                    if (typeof data.message === 'object') {
                        errorMsg += Object.values(data.message).flat().join(' ');
                    } else {
                        errorMsg += data.message;
                    }
                    alert(errorMsg);
                    resetButton();
                }
            } catch (error) {
                console.error(error);
                alert('Something went wrong. Check your connection.');
                resetButton();
            }
        });

        function resetButton() {
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');
            
            btn.disabled = false;
            loader.style.display = 'none';
            btnText.innerText = 'Create Account';
            btnIcon.style.display = 'block';
        }
    </script>
</body>
</html>