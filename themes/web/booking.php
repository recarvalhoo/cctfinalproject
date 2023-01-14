<?php $v->layout("_theme"); ?>

<div class="section-full p-tb80">
    <div class="container">
        <div class="section-head text-left text-black">
            <h2 class="text-uppercase font-36">Book a Consultation </h2>
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
        </div>

        <div class="section-content">
            <div class="wt-box">
                <div class="ajax_response"></div>
                <form class="contact-form cons-contact-form" method="post" action="<?= url("/booking") ?>">
                    <?= csrf_input(); ?>
                    <div class="contact-one p-a40 p-r150">
                        <div class="form-group">
                            <input name="name" type="text" required class="form-control" placeholder="Full Name">
                        </div>

                        <div class="form-group">
                            <input name="email" type="text" class="form-control" required placeholder="E-mail">
                        </div>

                        <div class="form-group">
                            <input name="phone" type="text" class="form-control" required placeholder="Phone Number">
                        </div>

                        <div class="form-group">
                            <label>Type of project</label>
                            <select name="projectType" class="form-control">
                                <option>Commercial</option>
                                <option>Residential</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input name="budget" type="text" class="form-control" required placeholder="Budget">
                        </div>

                        <div class="form-group">
                            <textarea name="message" rows="3" class="form-control " required placeholder="Tell us a little about what you intend"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="dateTime" class="flatpickr form-control" placeholder="Select a date and time" readonly="readonly">
                        </div>

                        <button name="submit" type="submit" value="Submit" class="site-button black radius-no text-uppercase">
                            <span class="font-12 letter-spacing-5">Submit</span>
                        </button>

                        <div class="contact-info bg-black text-white p-a30">
                            <p>THIS FORM WILL SERVE AS A MERE CONSULTATION REQUEST AND WILL ONLY BE VALID WHEN CONFIRMED THROUGH SUBSEQUENT CONTACT.</p>
                            <p>IT'S A ONE HOUR CONSULTATION!!</p>
                            <p>MON | WED | FRI - FROM 2PM UNTIL 6PM</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php $v->start("scripts"); ?>
<script>
    /**
     * flatpickr
     */
    flatpickr(".flatpickr", {
        enableTime: true,
        minDate: new Date().fp_incr(3),
        minTime: "14:00",
        maxTime: "17:00",
        time_24hr: true,
        minuteIncrement: "60",
        "disable": [
            function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 2 || date.getDay() === 4 || date.getDay() === 6);

            }
        ],
    });

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