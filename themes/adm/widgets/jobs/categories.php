<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/jobs/sidebar.php"); ?>

<section class="dash_content_app">
    <header class="dash_content_app_header">
        <h2 class="icon-pencil-square-o">Jobs Categories</h2>
        <a class="icon-plus-circle btn btn-green" href="<?= url("/admin/jobs/category"); ?>">New Category</a>
    </header>

    <div class="dash_content_app_box">
        <section>
            <div class="app_blog_categories">
                <?php if (!$categories) : ?>
                    <div class="message info icon-info">There are still no categories registered in your Jobs</div>
                <?php else : ?>
                    <?php foreach ($categories as $category) :
                        $categoryCover = ($category->cover ? image($category->cover, 300) : "");
                    ?>
                        <article class="radius">
                            <div class="thumb">
                                <div style="background-image: url(<?= $categoryCover; ?>);" class="cover embed radius"></div>
                            </div>
                            <div class="info">
                                <h3 class="title">
                                    <?= $category->title; ?>
                                    [ <b><?= $category->posts()->count(); ?> job<?= $category->posts()->count() > 1 ? "s" : "" ?> here</b> ]
                                </h3>
                                <p class="desc"><?= $category->description; ?></p>

                                <div class="actions">
                                    <a class="icon-pencil btn btn-blue" title="" href="<?= url("/admin/jobs/category/{$category->id}"); ?>">Edit</a>

                                    <a class="icon-trash-o btn btn-red" href="#" title="" data-post="<?= url("/admin/jobs/category"); ?>" data-action="delete" data-confirm="Are you sure you want to delete the category?" data-category_id="<?= $category->id; ?>">Delete</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?= $paginator; ?>
        </section>
    </div>
</section>