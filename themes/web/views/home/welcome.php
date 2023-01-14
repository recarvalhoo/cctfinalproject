<div class="section-full p-t90 bg-gray">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-5 col-sm-12 text-uppercase text-black">
                    <span class="font-30 font-weight-300">Welcome</span>
                    <h2 class="font-40">
                        We help our clients <span class="text-yellow">create better</span> environments
                    </h2>
                    <p>BASED IN DUBLIN, OUR TEAM OFFERS CLIENTS A WIDE RANGE OF SERVICES
                        ACROSS IRELAND AND INTERNATIONALLY. WE RECOGNISE THAT OUR PRACTICE
                        OF DESIGN AND ARCHITECTURE IS A COLLABORATIVE PROCESS, WORKING WITH
                        OUR CLIENTS AND OTHER DISCIPLINES.</p>
                    <a href="<?= url("/about") ?>" class="btn-half site-button button-lg m-b15"><span>About Us</span><em></em></a>
                </div>

                <div class="col-md-7 col-sm-12">
                    <div class="m-carousel-1 m-l100">
                        <div class="owl-carousel home-carousel-1 owl-btn-vertical-center">

                            <?php foreach ($jobs as $job) : ?>
                                <div class="item">
                                    <div class="ow-img wt-img-effect zoom-slow">
                                        <a href="javascript:void(0);"><img src="<?= image($job->cover, 520, 520); ?>" alt=""></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="hilite-title p-lr20 m-tb20 text-right text-uppercase bdr-gray bdr-right">
                <strong>29 Year</strong>
                <span class="text-black">Experience Working</span>
            </div>
        </div>
    </div>
</div>