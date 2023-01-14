<div class="dash_content_sidebar">
    <h3 class="icon-asterisk">dashboard/users</h3>
    <p class="dash_content_sidebar_desc">Manage, monitor and track your website users here...</p>

    <nav>
        <?php
        $nav = function ($icon, $href, $title) use ($app) {
            $active = ($app == $href ? "active" : null);
            $url = url("/admin/{$href}");
            return "<a class=\"icon-{$icon} radius {$active}\" href=\"{$url}\">{$title}</a>";
        };

        echo $nav("user", "users/home", "Users");
        echo $nav("plus-circle", "users/user", "New User");
        ?>

        <?php if (!empty($user) && $user->photo()) : ?>
            <img class="radius" style="width: 100%; margin-top: 30px" src="<?= image($user->photo, 600, 600); ?>" />
        <?php endif; ?>
    </nav>
</div>