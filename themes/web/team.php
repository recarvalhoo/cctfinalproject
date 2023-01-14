<?php $v->layout("_theme"); ?>

<div class="section-full bg-white  square_shape2">
    <div class="container-fluid">
        <div class="section-content">
            <div class="row">
                <div class="col-md-12 col-sm-12 bg-repeat" style="background-image:url(<?= url(CONF_ASSETS_DIR . "/images/background/ptn-1.png);"); ?>);">
                    <div class="container section-head text-left text-black p-t90">
                        <h2 class="text-uppercase font-36">Our team</h2>
                        <div class="wt-separator-outer">
                            <div class="wt-separator bg-black"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 bg-repeat" style="background-image:url(<?= url(CONF_ASSETS_DIR . "images/background/ptn-1.png);"); ?>);">
                    <div class="m-experts p-l90 p-b90 p-r90">

                        <!-- BOSS SESSION -->
                        <?php foreach ($expertsBoss as $boss) : ?>
                            <div class="col-md-6 wt-team-six large-pic">
                                <div class="wt-team-media wt-thum-bx wt-img-overlay1">
                                    <img src="<?= image($boss->photo, 1000, 1200); ?>" alt="">
                                    <div class="overlay-bx">
                                        <div class="overlay-icon">
                                            <a href="<?= url("/team/{$boss->id}") ?>" style="padding: 20px;">Show more...</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wt-team-info text-center p-lr10 p-tb20 bg-white">
                                    <h2 class="wt-team-title text-uppercase"><a href="<?= url("/team/{$boss->id}") ?>" class="text-black font-32 font-weight-500"><?= $boss->fullName(); ?></a></h2>
                                    <p class="font-22"><?= $boss->role ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- EXPERTS SESSION -->
                        <?php foreach ($experts as $expert) : ?>
                            <div class="col-md-3 col-sm-3 col-xs-3 col-xs-100pc m-tb15">
                                <div class="wt-team-six bg-white">
                                    <div class="wt-team-media wt-thum-bx wt-img-overlay1">
                                        <img src="<?= image($expert->photo, 600, 800); ?>" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <a href="<?= url("/team/{$expert->id}") ?>" style="padding: 10px;">Show more...</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-team-info text-center bg-white p-lr10 p-tb20">
                                        <h5 class="wt-team-title text-uppercase m-a0"><a href="<?= url("/team/{$expert->id}") ?>"><?= $expert->fullName() ?></a></h5>
                                        <p class="m-b0"><?= $expert->role; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>