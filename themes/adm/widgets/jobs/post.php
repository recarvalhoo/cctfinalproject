<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/jobs/sidebar.php"); ?>

<div class="mce_upload" style="z-index: 997">
    <div class="mce_upload_box">
        <form class="app_form" action="<?= url("/admin/jobs/post"); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload" value="true" />
            <label>
                <label class="legend">Select a JPG or PNG image:</label>
                <input accept="image/*" type="file" name="image" required />
            </label>
            <button class="btn btn-blue icon-upload">Send Image</button>
        </form>
    </div>
</div>

<section class="dash_content_app">
    <?php if (!$post) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">New Job</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/jobs/post"); ?>" method="post">
                <!-- ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />

                <label class="label">
                    <span class="legend">*Title:</span>
                    <input type="text" name="title" placeholder="Title of job" required />
                </label>

                <label class="label">
                    <span class="legend">*Subtitle:</span>
                    <textarea name="subtitle" placeholder="Subtitle of job" required></textarea>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <input type="checkbox" name="slider" style="width: auto; display: inline-block;">
                        <small class="text-muted" style="font-weight: bold;">Show on slider (Page Home)</small>
                    </label>
                </div>

                <label>
                    <span class="legend">Project images</span>
                    <input type="file" name="project_images[]" placeholder="Some project images" multiple>
                </label>

                <label class="label">
                    <span class="legend">Video:</span>
                    <input type="text" name="video" placeholder="The YouTube video ID" />
                </label>

                <label class="label">
                    <span class="legend">*Content:</span>
                    <textarea class="mce" name="content"></textarea>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Category:</span>
                        <select name="category" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Author:</span>
                        <select name="author" required>
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?= $author->id; ?>"><?= $author->fullName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <option value="post">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="trash">Trash</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Publish date</span>
                        <input class="mask-datetime" type="text" name="post_at" value="<?= date("Y-m-d H:i"); ?>" required />
                    </label>
                </div>

                <hr>
                <h1 class="py-4">Customer Data</h1>

                <div class="label">
                    <label class="label">
                        <span class="legend">Client:</span>
                        <input type="text" name="client" placeholder="Client name" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Name of Project:</span>
                        <input type="text" name="project_name" placeholder="Name of project" />
                    </label>
                    <label class="label">
                        <span class="legend">Project Number:</span>
                        <input type="text" name="project_number" placeholder="Project number" />
                    </label>
                </div>

                <div class="label">
                    <label class="label">
                        <span class="legend">Address:</span>
                        <input type="text" name="address" placeholder="Address" />
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Project File: (PDF)</span>
                    <input type="file" name="project_file" />
                </label>

                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Publish</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-pencil-square-o">Edit job #<?= $post->id; ?></h2>
            <a class="icon-link btn btn-green" href="<?= url("/jobs/{$post->uri}"); ?>" target="_blank" title="">View on site</a>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/jobs/post/{$post->id}"); ?>" method="post">
                <!-- ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <label class="label">
                    <span class="legend">*Title:</span>
                    <input type="text" name="title" value="<?= $post->title; ?>" placeholder="Title of job" required />
                </label>

                <label class="label">
                    <span class="legend">*Subtitle:</span>
                    <textarea name="subtitle" placeholder="Subtitle of job" required><?= $post->subtitle; ?></textarea>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <input type="checkbox" name="slider" style="width: auto; display: inline-block;" <?= $post->slider ? "checked" : null ?>>
                        <small class="text-muted" style="font-weight: bold;">Show on slider (Page Home)</small>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Project Images</span>
                    <div class="al-center p-4">
                        <?php if ($projectImages) : ?>
                            <?php foreach ($projectImages as $image) : ?>
                                <div style="position: relative; display:inline-block;">
                                    <img class="radius" src="<?= image("images/projects/{$post->images}/{$image}", 250); ?>" />
                                    <a class="btn btn-red btn-sm icon-trash-o icon-notext" data-post="<?= url("/admin/jobs/post"); ?>" data-action="deleteImage" data-confirm="Are you sure you want to delete this image? This action cannot be undone." data-image="<?= $post->images . $image; ?>" style="position: absolute; top: 8px; right: 16px;"></a>
                                    <?php if ($post->cover != "images/projects/" . $post->images . $image) : ?>
                                        <a class="btn btn-blue btn-sm icon-camera icon-notext" data-post="<?= url("/admin/jobs/post"); ?>" data-action="coverImage" data-id="<?= $post->id; ?>" data-image="<?= $post->images . $image; ?>" style="position: absolute; top: 8px; right: 48px;"></a>
                                    <?php else : ?>
                                        <span class="btn btn-green btn-sm icon-camera" style="position: absolute; top: 8px; right: 48px; cursor:inherit">Selected Cover</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="al-center p-4">Empty project images</div>
                        <?php endif; ?>
                    </div>

                    <input type="file" name="project_images[]" placeholder="Some project images" multiple>
                </label>

                <label class="label">
                    <span class="legend">Video:</span>
                    <input type="text" name="video" value="<?= $post->video; ?>" placeholder="The YouTube video ID" />
                </label>

                <label class="label">
                    <span class="legend">*Content:</span>
                    <textarea class="mce" name="content"><?= $post->content; ?></textarea>
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Categories:</span>
                        <select name="category" required>
                            <?php foreach ($categories as $category) :
                                $categoryId = $post->category;
                                $select = function ($value) use ($categoryId) {
                                    return ($categoryId == $value ? "selected" : "");
                                };
                            ?>
                                <option <?= $select($category->id); ?> value="<?= $category->id; ?>"><?= $category->title; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Author:</span>
                        <select name="author" required>
                            <?php foreach ($authors as $author) :
                                $authorId = $post->author;
                                $select = function ($value) use ($authorId) {
                                    return ($authorId == $value ? "selected" : "");
                                };
                            ?>
                                <option <?= $select($author->id); ?> value="<?= $author->id; ?>"><?= $author->fullName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <?php
                            $status = $post->status;
                            $select = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select("post"); ?> value="post">Publish</option>
                            <option <?= $select("draft"); ?> value="draft">Draft</option>
                            <option <?= $select("trash"); ?> value="trash">Trash</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Publish date:</span>
                        <input class="mask-datetime" type="text" name="post_at" value="<?= date_fmt($post->post_at, "Y-m-d H:i"); ?>" required />
                    </label>
                </div>

                <hr>
                <h1 class="py-4">Customer Data</h1>

                <div class="label">
                    <label class="label">
                        <span class="legend">Client:</span>
                        <input type="text" name="client" placeholder="Client name" value="<?= $post->client ?>" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Name of Project:</span>
                        <input type="text" name="project_name" placeholder="Name of project" value="<?= $post->project_name ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">Project Number:</span>
                        <input type="text" name="project_number" placeholder="Project number" value="<?= $post->project_number ?>" />
                    </label>
                </div>

                <div class="label">
                    <label class="label">
                        <span class="legend">Address:</span>
                        <input type="text" name="address" placeholder="Address" value="<?= $post->address ?>" />
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Project File: (PDF)</span>
                    <?php if ($post->project_file) : ?>
                        <a href="<?= url(CONF_UPLOAD_DIR . "/" . $post->project_file); ?>" target="_blank"><img src="<?= url("/shared/images/pdf.png"); ?>" width="80"></a>
                    <?php endif; ?>
                    <input type="file" name="project_file" />
                </label>

                <div class="al-right">
                    <button class="btn btn-blue icon-pencil-square-o">Update</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>