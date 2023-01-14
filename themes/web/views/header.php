<header class="site-header header-style-1  nav-wide">

    <div class="sticky-header main-bar-wraper">
        <div class="main-bar bg-white p-t10">
            <div class="container">
                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="<?= url("/"); ?>">
                            <img src="<?= url(CONF_ASSETS_DIR . "images/nbk-architects-logo.png") ?>" width="171" height="49" alt="" />
                        </a>
                    </div>
                </div>

                <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div id="top-menu" class="header-nav navbar-collapse collapse">
                    <ul class=" nav navbar-nav">
                        <li>
                            <a href="<?= url("/"); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= url("/about"); ?>">About</a>
                        </li>
                        <li>
                            <a href="<?= url("/people"); ?>">People</a>
                        </li>
                        <li>
                            <a href="<?= url("/projects"); ?>">Projects</a>
                        </li>
                        <li>
                            <a href="<?= url("/services"); ?>">Services</a>
                        </li>
                        <li>
                            <a href="<?= url("/contact") ?>">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</header>