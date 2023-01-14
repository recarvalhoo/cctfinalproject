<?php $v->layout("_theme"); ?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-parallax bg-top-center" data-stellar-background-ratio="0.5" style="background-image:url(<?= image($post->cover, 1400); ?>);">
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="text-white text-uppercase letter-spacing-5 font-18 font-weight-300">
                        <?= $post->title ?></h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div class="p-tb20">
                <div>
                    <ul class="wt-breadcrumb breadcrumb-style-2">
                        <li><a href="<?= url("/"); ?>">Home</a></li>
                        <li><a href="<?= url("/projects"); ?>">Projects</a></li>
                    </ul>
                </div>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<div class="section-full p-tb90 square_shape1 square_shape3">
    <div class="container">
        <div class="blog-post blog-lg date-style-1 text-black">
            <div class="wt-post-media">
                <div class="wt-post-info p-t30 bg-white">
                    <div class="wt-post-title ">
                        <h2 class="post-title"><a href="javascript:void(0);" class="text-black font-20 letter-spacing-2 font-weight-600"><?= $post->title ?></a></h2>
                    </div>
                    <div class="wt-post-text">
                        <?= $post->content ?>
                    </div>
                    <div class="widget widget_gallery mfp-gallery">
                        <h4 class="widget-title  text-uppercase">Gallery</h4>
                        <ul>
                            <?php foreach ($photos as $photo) : ?>
                                <li style="background-color: white;">
                                    <div class="wt-post-thum" style="background-color: white;">
                                        <a href="<?= url(CONF_UPLOAD_DIR . $photo); ?>" class="mfp-link m-a10"><img src="<?= image($photo, 400, 400); ?>" alt="<?= $post->title ?>"></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-content">
            <div class="text-left">
                <h2 class="text-uppercase font-36">Related projects</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator bg-black"></div>
                </div>
            </div>
            <div class="section-content">
                <div class="owl-carousel blog-related-slider  owl-btn-top-right">

                    <?php foreach ($related as $item) : ?>
                        <div class="item">
                            <div class="blog-post blog-grid date-style-1">
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                    <a href="<?= url("/jobs/" . $item->uri); ?>"><img src="<?= image($item->cover, 500, 700); ?>" alt=""></a>
                                </div>
                                <div class="wt-post-info p-a20 bg-gray text-black">
                                    <div class="wt-post-title ">
                                        <h2 class="post-title"><a href="<?= url("/jobs/" . $item->uri); ?>" class="text-black font-16 letter-spacing-2 font-weight-600"><?= $item->title ?></a></h2>
                                    </div>
                                    <a href="<?= url("/jobs/" . $item->uri); ?>" class="site-button black radius-no text-uppercase"><span class="font-12 letter-spacing-5"> Read More </span></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
</div>