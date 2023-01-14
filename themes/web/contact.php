<?php $v->layout("_theme"); ?>

<div class="section-full p-tb80">
    <div class="container">
        <div class="section-head text-left text-black">
            <h2 class="text-uppercase font-36">Where to Find us </h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>

        <div class="section-content">
            <div class="wt-box">
                <div class="ajax_response"></div>
                <form class="contact-form cons-contact-form" method="post" action="<?= url("/contact") ?>">
                    <?= csrf_input(); ?>
                    <div class="contact-one p-a40 p-r150">
                        <div class="form-group">
                            <input name="name" type="text" required class="form-control" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input name="email" type="text" class="form-control" required placeholder="Email">
                        </div>

                        <div class="form-group">
                            <textarea name="message" rows="3" class="form-control " required placeholder="Message"></textarea>
                        </div>

                        <button name="submit" type="submit" value="Submit" class="site-button black radius-no text-uppercase">
                            <span class="font-12 letter-spacing-5">Submit</span>
                        </button>

                        <div class="contact-info bg-black text-white p-a30">
                            <div class="wt-icon-box-wraper left p-b30">
                                <div class="icon-sm"><i class="iconmoon-smartphone-1"></i></div>
                                <div class="icon-content text-white ">
                                    <h5 class="m-t0 text-uppercase">Phone number</h5>
                                    <p>+353 1 552 5706</p>
                                </div>
                            </div>

                            <div class="wt-icon-box-wraper left p-b30">
                                <div class="icon-sm"><i class="iconmoon-email"></i></div>
                                <div class="icon-content text-white">
                                    <h5 class="m-t0  text-uppercase">Email address</h5>
                                    <p>infonbkarchitects@gmail.com</p>
                                </div>
                            </div>

                            <div class="wt-icon-box-wraper left">
                                <div class="icon-sm"><i class="iconmoon-travel"></i></div>
                                <div class="icon-content text-white">
                                    <h5 class="m-t0  text-uppercase">Address info</h5>
                                    <p>61 Merrion Square S, Dublin 2, D02 EW25, Ireland</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-head text-left text-black p-t90">
            <h2 class="text-uppercase font-36">Or...</h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>

        <div class="section-content">
            <a href="<?= url("/booking"); ?>" class="btn-half site-button button-lg m-b15" style="padding-right: 90px;"><span>click here to book a consultation.</span><em></em></a>
        </div>

    </div>
</div>

<div class="section-full">
    <div class="gmap-outline">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.267365904834!2d-6.2511768842172275!3d53.338469983002334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670e96fd07f2b7%3A0xb614fcc42e652e1c!2sNBK%20Architects!5e0!3m2!1spt-BR!2sbr!4v1671462587989!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?php $v->start("scripts"); ?>
<script>
    /**
     * submit form
     */
    jQuery(document).on('submit', 'form.cons-contact-form', function(e) {
        e.preventDefault();
        var form = jQuery(this);
        /* sending message */
        jQuery.ajax({
            url: form.attr('action'),
            data: form.serialize() + "&action=contactform",
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function() {
                jQuery('.loading-area').show();
            },

            success: function(data) {
                jQuery('.loading-area').hide();
                jQuery('.alert').hide();

                //redirect
                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }

                //reload
                if (data.reload) {
                    window.location.reload();
                    return;
                }

                //message
                if (data.message.class === "success") {
                    jQuery("<div class='alert alert-success'>" + data.message.text + "</div>").insertBefore('form.cons-contact-form');
                }

                if (data.message.class !== "success") {
                    jQuery("<div class='alert alert-danger'>" + data.message.text + "</div>").insertBefore('form.cons-contact-form');
                }
            }
        });
        return false;
    });
</script>
<?php $v->end(); ?>