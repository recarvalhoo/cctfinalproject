<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/booking/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-home">Bookings</h2>
    </header>

    <div class="dash_content_app_box">

        <div class="dash_content_app_box">
            <section>
                <div class="app_users_home">
                    <?php if (!$booking) : ?>
                        <div class="message info icon-info">No solicitation.</div>
                    <?php else : ?>
                        <?php foreach ($booking as $item) : ?>
                            <article class="user radius booking-<?= $item->accepted ?>">
                                <div class="info">
                                    <p><?= $item->content; ?></p>
                                    <br>
                                    <p>Created at <?= date_fmt($item->created_at, "Y-m-d H:i"); ?></p>
                                </div>

                                <div class="actions">
                                    <a class="icon-reply-all btn btn-blue" href="<?= url("/admin/booking/book/{$item->id}"); ?>" title="">Reply</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>

    </div>
</section>