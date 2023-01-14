<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/jobs/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Jobs</h2>
        <form action="<?= url("/admin/jobs/home"); ?>" method="post" class="app_search_form">
            <input type="text" name="s" value="<?= $search; ?>" placeholder="Search Jobs:">
            <button class="icon-search icon-notext"></button>
        </form>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_blog_home">
                <?php if (!$posts) : ?>
                    <div class="message info icon-info">There are no published jobs yet.</div>
                <?php else : ?>
                    <?php foreach ($posts as $post) :
                        $postCover = ($post->cover ? image($post->cover, 300) : "");
                    ?>
                        <article>
                            <div style="background-image: url(<?= $postCover; ?>);" class="cover embed radius"></div>
                            <h3 class="tittle">
                                <a target="_blank" href=" <?= url("/jobs/{$post->uri}"); ?>">
                                    <?php if ($post->post_at > date("Y-m-d H:i:s")) : ?>
                                        <span class="icon-clock-o"><?= $post->title; ?></span>
                                    <?php else : ?>
                                        <span class="icon-check"><?= $post->title; ?></span>
                                    <?php endif; ?>
                                </a>
                            </h3>

                            <div class="info">
                                <?php if ($post->slider) : ?>
                                    <p class="icon-star text-slide">Slide</p>
                                <?php endif; ?>
                                <p class="icon-clock-o text-success"><?= date_fmt($post->post_at, "Y-m-d H:i"); ?></p>
                                <p class="icon-bookmark"><?= $post->category()->title; ?></p>
                                <p class="icon-user"><?= $post->author()->fullName(); ?></p>
                                <p class="icon-bar-chart"><?= $post->views; ?></p>
                                <p class="icon-pencil-square-o" <?= $post->status != "post" ? "style='color: #D94352;'" : "" ?>><?= ($post->status == "post" ? "Published" : ($post->status == "draft" ? "Draft" : "Trash")); ?></p>
                            </div>

                            <div class=" actions">
                                <a class="icon-pencil btn btn-blue" title="" href="<?= url("/admin/jobs/post/{$post->id}"); ?>">Edit</a>

                                <a class="icon-trash-o btn btn-red" title="" href="#" data-post="<?= url("/admin/jobs/post"); ?>" data-action="delete" data-confirm="Are you sure you want to delete this job?" data-post_id="<?= $post->id; ?>">Delete</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>