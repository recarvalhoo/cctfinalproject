<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/jobs</h3>
    <p class="dash_content_sidebar_desc">Here you manage all published jobs...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("briefcase", "jobs/home", "Jobs");
        echo $nav("bookmark", "jobs/categories", "Categories");
        echo $nav("plus-circle", "jobs/post", "New Job");
        ?>

        <?php if (!empty($post->cover)) : ?>
            <img class="radius" style="width: 100%; margin-top: 30px" src="<?= image($post->cover, 680); ?>" />
        <?php endif; ?>

        <?php if (!empty($category->cover)) : ?>
            <img class="radius" style="width: 100%; margin-top: 30px" src="<?= image($category->cover, 680); ?>" />
        <?php endif; ?>
    </nav>
</div>