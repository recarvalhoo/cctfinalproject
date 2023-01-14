<?php $v->layout("_admin"); ?>
<?php $v->insert("widgets/users/sidebar.php"); ?>

<section class="dash_content_app">
    <?php if (!$user) : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-plus-circle">New User</h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/users/user"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="create" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*First Name:</span>
                        <input type="text" name="first_name" placeholder="First Name" required />
                    </label>

                    <label class="label">
                        <span class="legend">*Last Name:</span>
                        <input type="text" name="last_name" placeholder="Last Name" required />
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Genre:</span>
                    <select name="genre">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Photo: (600x600px)</span>
                    <input type="file" name="photo" />
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Birth Date:</span>
                        <input type="text" class="mask-date" name="datebirth" placeholder="YYYY-mm-dd" />
                    </label>

                    <label class="label">
                        <span class="legend">Document:</span>
                        <input type="text" name="document" placeholder="Document user (To identification)" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*E-mail:</span>
                        <input type="email" name="email" placeholder="E-mail" required />
                    </label>

                    <label class="label">
                        <span class="legend">*Password:</span>
                        <input type="password" name="password" placeholder="Password" required />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Level:</span>
                        <select name="level" required>
                            <option value="1">User</option>
                            <option value="5">Administrator</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <option value="registered">Registered</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                    </label>

                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Role:</span>
                        <input type="text" name="role" placeholder="Administrator, Architect, Clenaer..." />
                    </label>

                    <label class="label">
                        <span class="legend">Experts:</span>
                        <input type="checkbox" name="experts" style="width: auto; display: inline-block;">
                        <small class="text-muted" style="font-weight: bold;">Display in experts</small>
                    </label>

                    <label class="label">
                        <span class="legend">Boss:</span>
                        <input type="checkbox" name="boss" style="width: auto; display: inline-block;">
                        <small class="text-muted" style="font-weight: bold;">Display like a BOSS in experts</small>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">*Bio:</span>
                    <textarea name="bio" rows="5"></textarea>
                </label>

                <h1 class="py-4">Social Media</h1>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">LinkedIn:</span>
                        <input type="text" name="linkedin" placeholder="https://br.linkedin.com/in/user" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Facebook:</span>
                        <input type="text" name="facebook" placeholder="https://www.facebook.com/user/" />
                    </label>
                    <label class="label">
                        <span class="legend">Twitter:</span>
                        <input type="text" name="twitter" placeholder="https://twitter.com/user" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Instagram:</span>
                        <input type="text" name="instagram" placeholder="https://www.instagram.com/user/" />
                    </label>
                    <label class="label">
                        <span class="legend">YouTube:</span>
                        <input type="text" name="youtube" placeholder="https://www.youtube.com/user" />
                    </label>
                </div>

                <div class="al-right">
                    <button class="btn btn-green icon-check-square-o">Create User</button>
                </div>
            </form>
        </div>
    <?php else : ?>
        <header class="dash_content_app_header">
            <h2 class="icon-user"><?= $user->fullName(); ?></h2>
        </header>

        <div class="dash_content_app_box">
            <form class="app_form" action="<?= url("/admin/users/user/{$user->id}"); ?>" method="post">
                <!--ACTION SPOOFING-->
                <input type="hidden" name="action" value="update" />

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*First Name:</span>
                        <input type="text" name="first_name" value="<?= $user->first_name; ?>" placeholder="First Name" required />
                    </label>

                    <label class="label">
                        <span class="legend">*Last Name:</span>
                        <input type="text" name="last_name" value="<?= $user->last_name; ?>" placeholder="Last Name" required />
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Genre:</span>
                    <select name="genre">
                        <?php
                        $genre = $user->genre;
                        $select = function ($value) use ($genre) {
                            return ($genre == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $select("male"); ?> value="male">Male</option>
                        <option <?= $select("female"); ?> value="female">Female</option>
                    </select>
                </label>

                <label class="label">
                    <span class="legend">Photo: (600x600px)</span>
                    <input type="file" name="photo" />
                </label>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Birth Date:</span>
                        <input type="text" class="mask-date" value="<?= date_fmt($user->datebirth, "Y-m-d"); ?>" name="datebirth" placeholder="YYYY/mm/dd" />
                    </label>

                    <label class="label">
                        <span class="legend">Document:</span>
                        <input type="text" value="<?= $user->document; ?>" name="document" placeholder="User document (To identification)" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*E-mail:</span>
                        <input type="email" name="email" value="<?= $user->email; ?>" placeholder="E-mail" required />
                    </label>

                    <label class="label">
                        <span class="legend">Change Password:</span>
                        <input type="password" name="password" placeholder="Password" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">*Level:</span>
                        <select name="level" required>
                            <?php
                            $level = $user->level;
                            $select = function ($value) use ($level) {
                                return ($level == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select(1); ?> value="1">User</option>
                            <option <?= $select(5); ?> value="5">Administrator</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">*Status:</span>
                        <select name="status" required>
                            <?php
                            $status = $user->status;
                            $select = function ($value) use ($status) {
                                return ($status == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select("registered"); ?> value="registered">Registered</option>
                            <option <?= $select("confirmed"); ?> value="confirmed">Confirmed</option>
                        </select>
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Role:</span>
                        <input type="text" name="role" placeholder="Administrator, Architect, Clenaer..." value="<?= $user->role ?>" />
                    </label>

                    <label class="label">
                        <span class="legend">Experts:</span>
                        <input type="checkbox" name="experts" style="width: auto; display: inline-block;" <?= $user->experts ? "checked" : null ?>>
                        <small class="text-muted" style="font-weight: bold;">Display in experts</small>
                    </label>

                    <label class="label">
                        <span class="legend">Boss:</span>
                        <input type="checkbox" name="boss" style="width: auto; display: inline-block;" <?= $user->boss ? "checked" : null ?>>
                        <small class="text-muted" style="font-weight: bold;">Display like a BOSS in experts</small>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">*Bio:</span>
                    <textarea name="bio" rows="5"><?= $user->bio ?></textarea>
                </label>

                <h1 class="py-4">Social Media</h1>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">LinkedIn:</span>
                        <input type="text" name="linkedin" placeholder="https://br.linkedin.com/in/user" value="<?= $user->linkedin ?>" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Facebook:</span>
                        <input type="text" name="facebook" placeholder="https://www.facebook.com/user/" value="<?= $user->facebook ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">Twitter:</span>
                        <input type="text" name="twitter" placeholder="https://twitter.com/user" value="<?= $user->twitter ?>" />
                    </label>
                </div>

                <div class="label_g2">
                    <label class="label">
                        <span class="legend">Instagram:</span>
                        <input type="text" name="instagram" placeholder="https://www.instagram.com/user/" value="<?= $user->instagram ?>" />
                    </label>
                    <label class="label">
                        <span class="legend">YouTube:</span>
                        <input type="text" name="youtube" placeholder="https://www.youtube.com/user" value="<?= $user->youtube ?>" />
                    </label>
                </div>

                <div class="app_form_footer">
                    <button class="btn btn-blue icon-check-square-o">Update</button>
                    <a href="#" class="remove_link icon-warning" data-post="<?= url("/admin/users/user/{$user->id}"); ?>" data-action="delete" data-confirm="CAUTION: Are you sure you want to delete the user and all data related to him? This action cannot be done!" data-user_id="<?= $user->id; ?>">Delete User</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</section>