<?php $v->layout("_theme", ["title" => $subject]); ?>


<tr>
    <td style="padding: 15px 24px 15px;">
        <?= $message; ?>
    </td>
</tr>

<tr>
    <td style="padding: 15px 24px 15px; color: #8492a6;">
        Equipe <strong><?= CONF_SITE_NAME ?></strong>
    </td>
</tr>

<tr>
    <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
        <?= date("Y") . " | " . CONF_SITE_NAME ?>
    </td>
</tr>