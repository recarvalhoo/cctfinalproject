// JQUERY INIT

$(function () {
    var ajaxResponseBaseTime = 3;
    var ajaxResponseRequestError = "<div class='message danger icon-warning'>Sorry, we were unable to process your request...</div>";

    // MOBILE MENU

    $(".mobile_menu").click(function (e) {
        e.preventDefault();

        var menu = $(".dash_sidebar");
        menu.animate({ right: 0 }, 200, function (e) {
            $("body").css("overflow", "hidden");
        });

        menu.one("mouseleave", function () {
            $(this).animate({ right: '-260' }, 200, function (e) {
                $("body").css("overflow", "auto");
            });
        });
    });

    //NOTIFICATION CENTER

    function notificationsCount() {
        var center = $(".notification_center_open");
        $.post(center.data("count"), function (response) {
            if (response.count) {
                center.html(response.count);
            } else {
                center.html("0");
            }
        }, "json");
    }

    function notificationHtml(url, uri, content, email, date) {
        return `<div data-notificationlink="${url}${uri}" class="notification_center_item radius transition">
                <div class="info">
                    <p class="title">${content}</p>
                    <p class="time icon-clock-o">${date}</p>
                </div>
            </div>`;
    }

    notificationsCount();

    setInterval(function () {
        notificationsCount();
    }, 1000 * 50);

    $(".notification_center_open").click(function (e) {
        e.preventDefault();

        var notify = $(this).data("notify");
        var url = $(this).data("url");
        var center = $(".notification_center");

        $.post(notify, function (response) {
            if (response.message) {
                ajaxMessage(response.message, ajaxResponseBaseTime);
            }

            var centerHtml = "";
            if (response.notifications) {
                $.each(response.notifications, function (e, notify) {
                    centerHtml += notificationHtml(url, notify.uri, notify.content, notify.email, notify.created_at);
                });

                center.html(centerHtml);

                center.css("display", "block").animate({ right: 0 }, 200, function (e) {
                    $("body").css("overflow", "hidden");
                });
            }
        }, "json");

        center.one("mouseleave", function () {
            $(this).animate({ right: '-320' }, 200, function (e) {
                $("body").css("overflow", "auto");
                $(this).css("display", "none");
            });
        });

        notificationsCount();
    });

    $(".notification_center").on("click", "[data-notificationlink]", function () {
        window.location.href = $(this).data("notificationlink");
    });

    //DATA SET
    $("[data-post]").click(function (e) {
        e.preventDefault();

        var clicked = $(this);
        var data = clicked.data();
        var load = $(".ajax_load");

        if (data.confirm) {
            swal({
                title: "Attention!",
                text: data.confirm,
                icon: "warning",
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then((confirm) => {
                if (confirm) {
                    $.ajax({
                        url: data.post,
                        type: "POST",
                        data: data,
                        dataType: "json",
                        beforeSend: function () {
                            load.fadeIn(200).css("display", "flex");
                        },
                        success: function (response) {
                            //redirect
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                load.fadeOut(200);
                            }

                            //reload
                            if (response.reload) {
                                window.location.reload();
                            } else {
                                load.fadeOut(200);
                            }

                            //message
                            if (response.message) {
                                ajaxMessage(response.message, ajaxResponseBaseTime);
                            }
                        },
                        error: function () {
                            ajaxMessage(ajaxResponseRequestError, 5);
                            load.fadeOut();
                        }
                    });
                }
            });
        } else {
            $.ajax({
                url: data.post,
                type: "POST",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    load.fadeIn(200).css("display", "flex");
                },
                success: function (response) {
                    //redirect
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        load.fadeOut(200);
                    }

                    //reload
                    if (response.reload) {
                        window.location.reload();
                    } else {
                        load.fadeOut(200);
                    }

                    //message
                    if (response.message) {
                        ajaxMessage(response.message, ajaxResponseBaseTime);
                    }
                },
                error: function () {
                    ajaxMessage(ajaxResponseRequestError, 5);
                    load.fadeOut();
                }
            });
        }

    });

    //UPDATE ASSETS
    $("[data-update-asset]").click(function (e) {
        e.preventDefault();

        var clicked = $(this);
        var data = clicked.data();
        var load = $(".ajax_load");

        if (data.confirm) {
            var deleteConfirm = confirm(data.confirm);
            if (!deleteConfirm) {
                return;
            }
        }

        $.ajax({
            url: data.updateAsset,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            success: function (response) {
                //message
                if (response.message) {
                    ajaxMessage(response.message, 8);
                }
                if (response.success) {
                    let article = $("#" + response.asset.asset);
                    let logo = $("#" + response.asset.asset + " .cover").css("background-image").replace(/^url\(['"](.+)['"]\)/, '$1');
                    article.find(".cover").css("background-image", "url(" + logo + `?v=${new Date().getTime()}` + ")");
                    article.find(".last_update").text(response.asset.last_update);
                    article.find(".price").text(response.asset.price);
                    article.find(".percent").text(response.asset.percent + "%");
                    article.find(".message").removeClass("success danger").addClass((response.asset.percent > 0 ? "success" : "danger"));
                }
                load.fadeOut(200);
            },
            error: function () {
                ajaxMessage(ajaxResponseRequestError, 5);
                load.fadeOut();
            }
        });
    });

    //FORMS
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var load = $(".ajax_load");

        if (typeof tinyMCE !== 'undefined') {
            tinyMCE.triggerSave();
        }

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Sending (" + loaded + "%)");

                if (completed >= 100) {
                    load_title.text("Wait, loading...");
                }
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    form.find("input[type='file']").val(null);
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    ajaxMessage(response.message, ajaxResponseBaseTime);
                }

                //image by fsphp mce upload
                if (response.mce_image) {
                    $('.mce_upload').fadeOut(200);
                    tinyMCE.activeEditor.insertContent(response.mce_image);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {
                ajaxMessage(ajaxResponseRequestError, 5);
                load.fadeOut();
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

    // AJAX RESPONSE MONITOR
    // $(".ajax_response .message").each(function (e, m) {
    //     ajaxMessage(m, ajaxResponseBaseTime += 1);
    // });

    // AJAX MESSAGE CLOSE ON CLICK
    $(".ajax_response").on("click", ".message", function (e) {
        $(this).effect("bounce").fadeOut(1);
    });

    // MAKS

    $(".mask-date").mask('0000-00-00');
    $(".mask-datetime").mask('0000-00-00 00:00');
    $(".mask-month").mask('0000-00', { reverse: true });
    $(".mask-doc").mask('000.000.000-00', { reverse: true });
    $(".mask-card").mask('0000  0000  0000  0000', { reverse: true });
    $(".mask-money").mask('000.000.000.000.000,00', { reverse: true, placeholder: "0,00" });
});

// TINYMCE INIT
tinyMCE.init({
    selector: "textarea.mce",
    language: 'en',
    menubar: false,
    theme: "modern",
    height: 300,
    skin: 'light',
    entity_encoding: "raw",
    theme_advanced_resizing: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor media"
    ],
    toolbar: "styleselect | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | fsphpimage | code | fullscreen",
    style_formats: [
        { title: 'Normal', block: 'p' },
        { title: 'Title 3', block: 'h3' },
        { title: 'Title 4', block: 'h4' },
        { title: 'Title 5', block: 'h5' },
        { title: 'Code', block: 'pre', classes: 'brush: php;' }
    ],
    link_class_list: [
        { title: 'None', value: '' },
        { title: 'Blue CTA', value: 'btn btn_cta_blue' },
        { title: 'Green CTA', value: 'btn btn_cta_green' },
        { title: 'Yellow CTA', value: 'btn btn_cta_yellow' },
        { title: 'Red CTA', value: 'btn btn_cta_red' }
    ],
    setup: function (editor) {
        editor.addButton('fsphpimage', {
            title: 'Send Image',
            icon: 'image',
            onclick: function () {
                $('.mce_upload').fadeIn(200, function (e) {
                    $("body").click(function (e) {
                        if ($(e.target).attr("class") === "mce_upload") {
                            $('.mce_upload').fadeOut(200);
                        }
                    });
                }).css("display", "flex");
            }
        });
    },
    link_title: false,
    target_list: false,
    theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
    media_dimensions: false,
    media_poster: false,
    media_alt_source: false,
    media_embed: false,
    extended_valid_elements: "a[href|target=_blank|rel|class]",
    imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
    image_dimensions: false,
    relative_urls: false,
    remove_script_host: false,
    paste_as_text: true
});