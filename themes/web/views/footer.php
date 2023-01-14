<footer class="site-footer   footer-dark footer-wide relative overflow-hide">
    <div class="footer-bottom overlay-wraper">
        <div class="overlay-main bg-black" style="opacity:0;"></div>
        <div class="container p-t30">
            <div class="row">

                <div class="col-md-4 wt-footer-bot-left">
                    <a href="#"><img src="<?= url(CONF_ASSETS_DIR . "images/nbk-architects-logo-white.png") ?>" width="140" height="58" alt=""></a>
                </div>

                <div class="col-md-4 text-center copyright-block p-t15">
                    <span class="copyrights-text">© <?= date("Y") . " " . CONF_SITE_NAME ?>. Developed By RC</span>
                </div>

                <div class="col-md-4 wt-footer-bot-right p-t15">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="<?= url("/contact"); ?>">Contact Us</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div id="particles-dark" class="particles-canvas"></div>
</footer>