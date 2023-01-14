<div id="menu-latest-projects" class="section-full p-t90 p-lr80 latest_project-outer square_shape3">

    <div class="section-head text-left">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-uppercase font-36">Latest Project</h2>
                <div class="wt-separator-outer">
                    <div class="wt-separator bg-black"></div>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="btn-filter-wrap">
                    <li class="btn-filter" data-filter="*"><a href="<?= url("/projects"); ?>">All Projects</a></li>
                    <li class="btn-filter btn-active" data-filter="*">Latest Projects</li>
                    <?php foreach ($categories as $category) : ?>
                        <li class="btn-filter" data-filter=".<?= $category->title ?>-col"><?= $category->title ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="owl-carousel owl-carousel-filter  owl-btn-bottom-left">

            <?php foreach ($latest as $item) : ?>
                <div class="item fadingcol <?= $item->category()->title ?>-col">
                    <div class="wt-img-effect ">
                        <img src="<?= image($item->cover, 500, 700) ?>" alt="">
                        <div class="overlay-bx-2 ">
                            <div class="line-amiation">
                                <div class="text-white font-weight-100 p-a25">
                                    <h2><a href="<?= url("/jobs/" . $item->uri); ?>" class="text-white font-14 text-uppercase"><?= $item->title ?></a></h2>
                                    <p><?= str_limit_chars($item->subtitle, 200) ?></p>
                                    <a href="<?= url("/jobs/" . $item->uri); ?>" class="v-button letter-spacing-2 font-12 text-uppercase p-l20">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="hilite-title p-lr20 m-tb20 text-right text-uppercase bdr-gray bdr-right">
        <strong>Awesome</strong>
        <span class="text-black">Designs</span>
    </div>
</div>