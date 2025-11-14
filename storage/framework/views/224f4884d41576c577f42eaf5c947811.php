<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #107039;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            background: #fff;
            animation: fadeIn 1s ease-in-out;
        }

        .login-card .card-header {
            background: #599D2C;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            padding: 1.5rem;
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
    </style>
</head>

<body>

    <div class="login-card">
        <div class="card-header">
            Admin Login
        </div>

        <div class="card p-4 shadow">
            <!-- Display errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <!--done-->
                <div class="d-grid mb-3">
                    <button class="btn btn-primary btn-lg">Login</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/index.blade.php ENDPATH**/ ?>