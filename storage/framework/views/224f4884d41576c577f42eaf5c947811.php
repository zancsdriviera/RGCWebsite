<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RGC Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            /* NEW: Full background image */
            background-image: url('<?php echo e(asset('images/HOME/Carousel/Home_Image_4.jpg')); ?>');
            /* Change the path */
            background-size: cover;
            /* Makes it fill the screen */
            background-position: center;
            /* Always centered */
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Optional: parallax effect */
        }

        .login-page-title {
            position: absolute;
            top: 100px;
            /* adjust distance from top */
            left: 50%;
            font-family: "Baskervville SC", serif;
            transform: translateX(-50%);
            font-size: 5rem;
            color: #16b65b;
            font-weight: bold;
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.6);
            letter-spacing: 4px;
            z-index: 10;
        }

        .login-card {
            max-width: 350px;
            width: 100%;
            border-radius: 1rem;
            padding: 0;
            overflow: hidden;

            /* ✨ Transparent glass effect */
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45);

            animation: fadeIn 1s ease-in-out;
        }

        /* Header also glass-style */
        .login-card .card-header {
            background: rgba(89, 157, 44, 0.85);
            /* same green, but transparent */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            font-family: "Baskervville SC", serif;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 2rem;
            padding: 1.3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }


        .login-card .card-body {
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

        .login-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .login-footer a {
            color: #764ba2;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }


        /* Large laptops (~1366px) */
        @media (max-width: 1366px) {
            .login-page-title {
                font-size: 4.5rem;
            }
        }

        /* Standard laptops (~1280px) */
        @media (max-width: 1280px) {
            .login-page-title {
                font-size: 4rem;
                top: 60px;
            }
        }

        /* Small laptops / large tablets (~1024px) */
        @media (max-width: 1024px) {
            .login-page-title {
                font-size: 3.5rem;
            }
        }

        /* Tablets (~768px) */
        @media (max-width: 768px) {
            .login-page-title {
                font-size: 3rem;
            }
        }

        /* Mobile devices (~576px) */
        @media (max-width: 576px) {
            .login-page-title {
                font-size: 2.2rem;
                top: 60px;
                /* adjust spacing for smaller screens */
            }
        }
    </style>
</head>

<body>
    <h1 class="login-page-title">Riviera Golf Club</h1>

    <div class="login-card">
        <div class="card-header">
            Admin Login
        </div>

        <div class="card-body p-4">
            <!-- Display errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                        required>

                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;"
                        onclick="togglePassword()">
                        <i id="toggleIcon" class="bi bi-eye-fill"></i>
                    </span>
                </div>
                <!--done-->
                <div class="d-grid mb-3">
                    <button class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (pwd.type === "password") {
                pwd.type = "text";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            } else {
                pwd.type = "password";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            }
        }
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/index.blade.php ENDPATH**/ ?>