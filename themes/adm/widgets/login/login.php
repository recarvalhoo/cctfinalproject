<?php $v->layout("_login"); ?>

<div class="login">
    <article class="login_box radius">
        <h1 class="hl icon-coffee">Login</h1>
        <div class="ajax_response"><?= flash(); ?></div>

        <form name="login" action="<?= url("/admin/login"); ?>" method="post">
            <label>
                <span class="field icon-envelope">E-mail:</span>
                <input name="email" type="email" placeholder="Informe seu e-mail" required />
            </label>

            <label>
                <span class="field icon-unlock-alt">Password:</span>
                <input name="password" type="password" placeholder="Informe sua senha:" required />
            </label>

            <button class="radius gradient gradient-green gradient-hover icon-sign-in">Log in</button>
        </form>

        <footer>
            <p>Designed by <b>RC</b></p>
            <p>&copy; <?= date("Y"); ?> - All rights reserved</p>
        </footer>
    </article>
</div>