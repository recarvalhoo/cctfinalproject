<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/booking/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-home">Booking</h2>
    </header>

    <div class="dash_content_app_box">

        <div class="dash_content_app_box">
            <section>
                <div class="app_users_home">
                    <form class="app_form" action="<?= url("/admin/booking/book"); ?>" method="post">
                        <input type="hidden" name="action" value="reply" />
                        <input type="hidden" name="id" value="<?= $book->id ?>" />


                        <label class="label">
                            <span class="legend">*Content:</span>
                            <textarea class="mce" name="content" rows="10">
                                <h1>Answer:</h1>
                                <p>><u>Enter the response details here.</u><</p>
                                <br>
                                <hr>
                                <?= $preview ?>
                            </textarea>
                        </label>

                        <label class="label">
                            <span class="legend">Booking a consultation accepted:</span>
                            <select name="accept">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </label>

                        <div class="al-right">
                            <a class="icon-trash-o btn btn-red" href="javascript:void(0);" data-post="<?= url("admin/booking/book") ?>" data-action="delete" data-confirm="Are you sure you want to delete this request?" data-id="<?= $book->id; ?>">Delete</a>
                            <button class="btn btn-green icon-check-square-o">Send e-mail to client</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
</section>