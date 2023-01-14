<div id="welcome_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="goodnews-header" data-source="gallery" style="background:#eeeeee;padding:0px;">
    <div id="welcome" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.3.1">
        <ul>
        <?php foreach ($slider as $key => $job) : ?>
                <!-- SLIDE 1 -->
                <li data-index="rs-<?= $key ?>" data-transition="fadethroughdark" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?= image($job->cover, 500) ?>" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="300" data-fsslotamount="7" data-saveperformance="off" data-title="" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="<?= image($job->cover, 2500) ?>" alt="" data-lazyload="<?= image($job->cover, 2500) ?>" data-bgposition="center center" data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>
                    <!-- LAYERS -->

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  " id="slide-901-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" data-width="full" data-height="['400','400','400','550']" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":100,"to":"o:1;","delay":0,"ease":"Power2.easeInOut"},{"delay":"wait","speed":0,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;text-transform:left;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);
                                border-width:0px;background:linear-gradient(to top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 100%);cursor:default;">
                    </div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  " id="slide-901-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" data-width="full" data-height="['400','400','400','550']" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":0,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;text-transform:left;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);
                                border-width:0px;background:linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);cursor:default;">
                    </div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption BigBold-Title   tp-resizeme" id="slide-901-layer-3" data-x="['left','left','left','left']" data-hoffset="['120','120','30','30']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['180','180','160','160']" data-fontsize="['60','60','50','30']" data-lineheight="['100','90','60','60']" data-fontweight="['800','800','800','800']" data-width="['none','none','none','400']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-type="text" data-basealign="slide" data-responsive_offset="off" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},
                                {"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 6; 
                                text-transform:uppercase;
                                color:#fff;"><?= $job->title ?></div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption BigBold-SubTitle  " id="slide-901-layer-4" data-x="['left','left','left','left']" data-hoffset="['120','120','30','30']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['100','65','60','60']" data-fontsize="['15','15','15','13']" data-lineheight="['24','24','24','20']" data-width="['410','410','410','280']" data-height="['60','100','100','100']" data-whitespace="normal" data-type="text" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1800,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"y:50px;opacity:0;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; 
                                color:#fff;
                                "><?= $job->subtitle ?>
                    </div>

                    <!-- LAYER NR. 5 -->
                    <div class="tp-caption BigBold-Button rev-btn " id="slide-901-layer-5" data-x="['left','left','left','left']" data-hoffset="['480','480','30','30']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['100','100','30','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":2500,"ease":"Power3.easeInOut"},
                                {"delay":"wait","speed":1000,"to":"y:50px;opacity:0;","ease":"Power2.easeInOut"},
                                {"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);bw:1px 1px 1px 1px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[15,15,15,15]" data-paddingright="[50,50,50,50]" data-paddingbottom="[15,15,15,15]" data-paddingleft="[50,50,0,0]" style="z-index: 11; "><a href="<?= url("jobs/" . $job->uri); ?>" class="site-button outline white">READ MORE</a> </div>

                    <!-- Border Part -->
                    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-901-layer-8" data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-visibility="['on','on','off','off']" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":50,"speed":100,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeIn"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(0, 0, 0, 0);border-color:rgb(255,255,255);border-style:solid;border-width:0px 80px 80px 80px;">
                    </div>

                </li>
            <?php endforeach; ?>

        </ul>
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
    </div>
</div>