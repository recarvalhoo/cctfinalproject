$(function () {
    $("form").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var load = $(".ajax_load");

        load.fadeIn(200).css("display", "flex");

        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    load.fadeOut(200);
                }

                //Error
                if (response.message) {
                    console.log(response.message)
                    $(".ajax_response").html(`<div class='message ${response.message.class}'>${response.message.text}</div>`).effect("bounce");
                }
            },
            error: function (response) {
                load.fadeOut(200);
            }
        });
    });

    //Alert Flash
    let alertFlash = $(".ajax_response").html();
    $(".ajax_response").html("");
    if (alertFlash) {
        let alert = JSON.parse(alertFlash)
        ajaxMessage(alert, 8);
    }

    // AJAX RESPONSE
    function ajaxMessage(message, time) {

        let ajaxMessage = $("<div class='message text-center " + message.class + "'>" + message.text + "</div>");

        ajaxMessage.append("<div class='message_time'></div>");
        ajaxMessage.find(".message_time").animate({ "width": "100%" }, time * 1000, function () {
            $(this).parents(".message").fadeOut(200);
        });

        $(".ajax_response").append(ajaxMessage);
        ajaxMessage.effect("bounce");
    }
});