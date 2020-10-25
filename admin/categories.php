<?php

declare(strict_types=1);

require_once __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/functions.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/MadGamescategories.php';

function sectionheader()
{
    echo '<div><h4>' . _MADGAME_CONFIG . ' / ' . _MADGAME_CATEGORIE . '</h4></div>';

    adminmenu();
}

function editCategoriesForm($id = 0)
{
    global $xoopsConfig, $modify, $xoopsUser;

    $xcategorie = new Categories($id);

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    if ($id) {
        $sform = new XoopsThemeForm(_MADGAME_MOD, 'op', xoops_getenv('PHP_SELF'));
    } else {
        $sform = new XoopsThemeForm(_MADGAME_ADD, 'op', xoops_getenv('PHP_SELF'));
    }

    $sform->addElement(new XoopsFormText(_MADGAME_CATEGORIE_NOM, 'nom', 30, 30, $xcategorie->nom()), true);

    $button_tray = new XoopsFormElementTray('', '');

    if ($id) {
        $button_tray->addElement(new XoopsFormHidden('id', $id));

        $button_tray->addElement(new XoopsFormButton('', 'save', _MADGAME_SAVE, 'submit'));

        $button_tray->addElement(new XoopsFormButton('', 'delete', _MADGAME_DEL, 'submit'));
    } else {
        $button_tray->addElement(new XoopsFormButton('', 'save', _MADGAME_SAVE, 'submit'));
    }

    $sform->addElement($button_tray);

    $sform->display();
}

$op = '';

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (isset($_POST['save'])) {
    $op = 'save';
} elseif (isset($_POST['delete'])) {
    $op = 'delete';
}
if (isset($_GET['op'])) {
    $op = $_GET['op'];
}

global $xoopsDB, $myts;
switch ($op) {
    case 'save':
        if (isset($_POST['id'])) {
            $xcategorie = new Categories($_POST['id']);
        } else {
            $xcategorie = new Categories();
        }

        $xcategorie->SetNom($_POST['nom']);
        $xcategorie->store();
        redirect_header('categories.php', 1, _AM_DBUPDATED);
        exit();
        break;
    case 'delete':
        if (1 != $_GET['ok']) {
            xoops_cp_header();

            echo "<table width='100%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";

            echo "<div class='confirmMsg'>";

            echo '<h4>';

            echo '' . _MADGAME_CATEGORIE_DELETE . '</font></h4><br>';

            echo '<table><tr><td>';

            echo myTextForm('categories.php?op=delete&id=' . $_POST['id'] . '&ok=1', _AM_YES);

            echo '</td><td>';

            echo myTextForm('categories.php', _AM_NO);

            echo '</td></tr></table>';

            echo '</div><br><br>';

            echo '</td></tr></table>';
        } else {
            $xcategorie = new Categories($_GET['id']);

            $xcategorie->delete();

            redirect_header('categories.php', 1, _AM_DELETE);

            exit();
        }
        break;
    case _MADGAME_MOD:        // Modifier
        xoops_cp_header();
        $modify = 1;
        sectionheader();
        editCategoriesForm($_POST['id']);
        break;
    case 'default':
    default:

        xoops_cp_header();
        sectionheader();

        $xcategorie = new Categories();
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $mform = new XoopsThemeForm(_MADGAME_MOD . ' ' . _MADGAME_CATEGORIE_NOM, 'modify', xoops_getenv('PHP_SELF'));

        ob_start();
        $xcategorie->makeSelBox('id', 0);
        $mform->addElement(new XoopsFormLabel(_MADGAME_CATEGORIE_NOM, ob_get_contents()));
        ob_end_clean();
        $button_tray = new XoopsFormElementTray('', '');

        $button_tray->addElement(new XoopsFormHidden('modify', '1'));
        $button_tray->addElement(new XoopsFormHidden('op', _MADGAME_MOD));
        $button_tray->addElement(new XoopsFormButton('', '', _MADGAME_MOD, 'submit'));
        $mform->addElement($button_tray);
        $mform->display();

        $xcategorie = new Categories();
        editCategoriesForm();
        break;
}
xoops_cp_footer();
