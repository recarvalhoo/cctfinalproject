<?php $v->layout("_theme"); ?>

<div class="section-full p-tb90 bg-gray square_shape2">
    <div class="container">
        <div class="section-content ">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <div class="m-about m-l50 m-r50">
                        <div class="item">
                            <a href="javascript:void(0);"><img src="<?= image($expert->photo, 1000, 1200); ?>" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="m-about-containt text-uppercase text-black p-t30">
                        <span class="text-uppercase font-36"><b><?= $expert->fullName(); ?></b></span>
                        <h2 class="font-5 font-weight-300"><?= $expert->role ?></h2>
                        <p style="text-align:justify; margin-bottom: 16px;" class="text-uppercase"><?= $expert->bio ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>