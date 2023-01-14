<?php $v->layout("_theme"); ?>

<!-- SLIDER -->
<?= $v->insert("views/home/slider", $jobs); ?>

<!-- WELCOME -->
<?= $v->insert("views/home/welcome"); ?>

<!-- LATEST PROJECTS  -->
<?= $v->insert("views/home/projects"); ?>

<!-- COMPANY DETAIL SECTION -->
<?= $v->insert("views/home/facts"); ?>