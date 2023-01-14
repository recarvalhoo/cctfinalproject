<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/jobs/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$category) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">New Category</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/jobs/category"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />

                <label class="label">
                    <span class="legend">*Title:</span>
                    <input type="text" name="title" placeholder="Category name" required />
                </label>

                <label class="label">
                    <span class="legend">*Description:</span>
                    <textarea name="description" placeholder="About this category" required></textarea>
                </label>

                <label class="label">
                    <span class="legend">Cover:</span>
                    <input type="file" name="cover" placeholder="Cover image" />
                </label>

                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Create category</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-bookmark-o"><?= $category->title; ?></h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/jobs/category/{$category->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <label class="label">
                    <span class="legend">*Title:</span>
                    <input type="text" name="title" value="<?= $category->title; ?>" placeholder="Category name" required />
                </label>

                <label class="label">
                    <span class="legend">*Description:</span>
                    <textarea name="description" placeholder="About this category" required><?= $category->description; ?></textarea>
                </label>

                <label class="label">
                    <span class="legend">Cover:</span>
                    <input type="file" name="cover" placeholder="Cover image" />
                </label>

                <div class="al-right">
                    <button class="btn btn-blue icon-check-square-o">Update</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>