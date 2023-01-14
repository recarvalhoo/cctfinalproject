<?php $v->layout("_theme"); ?>

<div class="section-full p-tb90">
    <div class="container">
        <div class="filter-wrap p-tb50">
            <ul class="masonry-filter link-style  text-uppercase">
                <li class="active"><a data-filter="*" href="#">All</a></li>
                <?php foreach ($categories as $category) : ?>
                    <li><a data-filter=".<?= $category->title ?>" href="#"><?= $category->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="portfolio-wrap mfp-gallery projects-grid clearfix">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($projects as $project) : ?>
                    <div class="masonry-item <?= $project->category()->title ?> col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="wt-img-effect ">
                            <img src="<?= image($project->cover, 500, 700); ?>" alt="">
                            <div class="overlay-bx-2 ">
                                <div class="line-amiation">
                                    <div class="text-white font-weight-300 p-a40">
                                        <h2><a href="<?= url("/jobs/" . $project->uri); ?>" class="text-white font-20 letter-spacing-4 text-uppercase"><?= $project->title ?></a></h2>
                                        <p><?= $project->subtitle ?></p>
                                        <a href="<?= url("/jobs/" . $project->uri); ?>" class="v-button letter-spacing-4 font-12 text-uppercase p-l20">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>