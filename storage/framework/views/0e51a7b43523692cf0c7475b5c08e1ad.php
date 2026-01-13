<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Riviera Golf Club'); ?></title>

    <!-- Global CSS -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('public/favicon.png')); ?>">

    <link href="<?php echo e(asset('css/m_body.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/footer.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/header.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/fonts.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?> 

    <style>
        body {
            display: flex;
            flex-direction: column;
        }

        main.m_body {
            flex: 1;
            /* pushes footer down */
        }

        .lang-box {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 120px;
            z-index: 99999;
            background: #ffffff;
            border-radius: 8px;
            padding: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        /* Completely hide Google Translate banner */
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0 !important;
        }

        iframe.goog-te-menu-frame.skiptranslate {
            display: none !important;
        }
    </style>

</head>

<body>
    <div id="google_translate_element" style="display:none;"></div>
    
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- Floating Language Selector -->
    <div id="language-switcher" class="lang-box">
        <select id="lang-select" class="form-select form-select-sm">
            <option value="en">English</option>
            <option value="ja">日本語</option>
            <option value="ko">한국어</option>
        </select>
    </div>

    
    <main class="m_body">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Global JS -->
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?> 

    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ja,ko',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>

    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function changeLanguage(lang) {
            let translateCombo = document.querySelector(".goog-te-combo");
            if (translateCombo) {
                translateCombo.value = lang;
                translateCombo.dispatchEvent(new Event("change"));
            }
        }

        document.getElementById("lang-select").addEventListener("change", function() {
            changeLanguage(this.value);
        });
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views\layouts\app.blade.php ENDPATH**/ ?>