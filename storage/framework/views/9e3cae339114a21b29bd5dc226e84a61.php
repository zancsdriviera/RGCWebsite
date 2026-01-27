<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RGC Admin - Verify Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('<?php echo e(asset('images/HOME/Carousel/Home_Image_4.jpg')); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .verification-card {
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
            padding: 0;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45);
            animation: fadeIn 1s ease-in-out;
        }

        .verification-card .card-header {
            background: rgba(89, 157, 44, 0.85);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            font-family: "Baskervville SC", serif;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.8rem;
            padding: 1.3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .verification-card .card-body {
            padding: 2rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgb(189, 189, 189);
            border-color: #202123;
        }

        .btn-primary {
            background: #599D2C;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #467a23;
        }

        .btn-outline-secondary {
            border-color: #599D2C;
            color: #599D2C;
        }

        .btn-outline-secondary:hover {
            background: #599D2C;
            color: white;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .code-input {
            font-size: 1.5rem;
            letter-spacing: 0.5rem;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="verification-card">
        <div class="card-header">
            Two-Factor Verification
        </div>

        <div class="card-body p-4">
            <!-- Success message -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Display errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            <p class="text-center mb-4">
                We've sent a 6-digit verification code to your email.<br>
                Please enter it below:
            </p>

            <form action="<?php echo e(route('admin.verify-2fa')); ?>" method="POST" id="verifyForm" onsubmit="handleSubmit()">
                <?php echo csrf_field(); ?>

                <!-- Add this to prevent issues -->
                <?php if(session('_old_input')): ?>
                    <input type="hidden" name="_old_input" value="1">
                <?php endif; ?>

                <div class="mb-4">
                    <input type="text" name="code" class="form-control form-control-lg code-input"
                        placeholder="000000" maxlength="6" required autofocus autocomplete="one-time-code"
                        value="<?php echo e(old('code')); ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                        Verify Code
                    </button>
                </div>
            </form>

            <div class="text-center">
                <form action="<?php echo e(route('admin.resend-2fa')); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Resend Code
                    </button>
                </form>
                <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-link text-decoration-none">
                    <i class="bi bi-box-arrow-left"></i> Cancel Login
                </a>
            </div>

            <div class="mt-4 text-center text-muted small">
                <p class="mb-0">Code expires in 10 minutes</p>
                <p class="mb-0">Check your spam folder if you don't see the email</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let isSubmitting = false;

        function handleSubmit() {
            if (isSubmitting) {
                return false;
            }
            isSubmitting = true;
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Verifying...';
            return true;
        }

        // Auto-focus and select all text
        const codeInput = document.querySelector('.code-input');
        codeInput.focus();
        codeInput.select();
    </script>
    <script>
        // Auto-focus the input
        document.querySelector('.code-input').focus();

        // Auto-advance to next input (if you want 6 separate inputs, but we're using single input for simplicity)
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/verify-2fa.blade.php ENDPATH**/ ?>