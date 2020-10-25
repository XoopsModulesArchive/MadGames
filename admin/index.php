<?php

declare(strict_types=1);

require_once __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/functions.php';

$op = '';

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

xoops_cp_header();
echo '<div><h4>' . _MADGAME_CONFIG . '</h4></div>';
adminmenu();
xoops_cp_footer();
