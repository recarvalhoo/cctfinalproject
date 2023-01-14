<!DOCTYPE html>
<html lang="en">


<head>

    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $head; ?>

    <!-- FAVICONS ICON -->
    <link rel="icon" href="<?= url(CONF_ASSETS_DIR); ?>images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= url(CONF_ASSETS_DIR); ?>images/favicon.png" />

    <!-- [if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif] -->

    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/bootstrap.min.css">
    <!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/fontawesome/css/font-awesome.min.css" />

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/owl.carousel.min.css">

    <!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/magnific-popup.min.css">
    <!-- LOADER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/loader.min.css">
    <!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/style.css">
    <!-- REVOLUTION SLIDER 4 STYLE -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>css/rev-slider-4.css">


    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>plugins/revolution/revolution/css/settings.css">
    <!-- REVOLUTION NAVIGATION STYLE -->
    <link rel="stylesheet" type="text/css" href="<?= url(CONF_ASSETS_DIR); ?>plugins/revolution/revolution/css/navigation.css">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,800,800i,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet">

</head>

<body class="footer-fixed">

    <div class="page-wraper">

        <!-- HEADER -->
        <?= $v->insert("views/header"); ?>

        <!-- CONTENT START -->
        <div class="page-content">

            <?= $v->section("content"); ?>


        </div>
        <!-- CONTENT END -->

        <!-- FOOTER -->
        <?= $v->insert("views/footer"); ?>

        <!-- BUTTON TOP -->
        <button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

    </div>

    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <svg id="triangle" width="140px" height="140px" viewBox="-3 -4 39 39">
                <polygon fill="#fff" stroke="#000" stroke-width="2" points="16,0 32,32 0,32"></polygon>
            </svg>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->

    <!-- JAVASCRIPT  FILES ========================================= -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/jquery-1.12.4.min.js"></script><!-- JQUERY.MIN JS -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/counterup.min.js"></script><!-- COUNTERUP JS -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/owl.carousel.min.js"></script><!-- OWL SLIDER  -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/jquery.owl-filter.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/stellar.min.js"></script><!-- PARALLAX BG IMAGE   -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/particles.js"></script><!-- CANVAS EFFECT   -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/app.js"></script><!-- CANVAS EFFECT   -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/shortcode.js"></script><!-- SHORTCODE FUCTIONS  -->
    <!-- REVOLUTION JS FILES -->

    <script src="<?= url(CONF_ASSETS_DIR); ?>plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= url(CONF_ASSETS_DIR); ?>plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>plugins/revolution/revolution/js/extensions/revolution-plugin.js"></script>

    <!-- REVOLUTION SLIDER SCRIPT FILES -->
    <script src="<?= url(CONF_ASSETS_DIR); ?>js/rev-script-1.js"></script>

    <script>
        //Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <?= $v->section("scripts"); ?>


</body>


</html>