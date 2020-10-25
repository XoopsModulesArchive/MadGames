<?php

declare(strict_types=1);

require_once __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/functions.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/MadGamescategories.php';
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/MadGamesjeux.php';

function sectionheader()
{
    echo '<div><h4>' . _MADGAME_CONFIG . ' / ' . _MADGAME_JEUX . '</h4></div>';

    adminmenu();
}

function editJeuxForm($id = 0)
{
    global $xoopsConfig, $modify, $xoopsUser;

    $xjeux = new Jeux($id);

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    if ($id) {
        $sform = new XoopsThemeForm(_MADGAME_MOD, 'op', xoops_getenv('PHP_SELF'));
    } else {
        $sform = new XoopsThemeForm(_MADGAME_ADD, 'op', xoops_getenv('PHP_SELF'));
    }

    ob_start();

    $xcategorie = new Categories();

    $xcategorie->makeSelBox('cid', $xjeux->cid());

    $sform->addElement(new XoopsFormLabel(_MADGAME_CATEGORIE_NOM, ob_get_contents()));

    ob_end_clean();

    $sform->addElement(new XoopsFormText(_MADGAME_JEUX_NOM, 'nom', 70, 100, $xjeux->nom()), true);

    $sform->addElement(new XoopsFormTextArea(_MADGAME_JEUX_DESCRIPTION, 'description', $xjeux->description(), 5, 100), false);

    $sform->addElement(new XoopsFormTextArea(_MADGAME_JEUX_IMG, 'url_img', $xjeux->url_img(), 5, 100), true);

    $sform->addElement(new XoopsFormTextArea(_MADGAME_JEUX_SWF, 'url_swf', $xjeux->url_swf(), 5, 100), true);

    $sform->addElement(new XoopsFormText(_MADGAME_JEUX_WIDTH, 'width', 5, 5, $xjeux->width()), false);

    $sform->addElement(new XoopsFormText(_MADGAME_JEUX_HEIGHT, 'height', 5, 5, $xjeux->height()), false);

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
            $xjeux = new Jeux($_POST['id']);
        } else {
            $xjeux = new Jeux();
        }

        $xjeux->SetCid($_POST['cid']);
        $xjeux->SetNom($_POST['nom']);
        $xjeux->SetDescription($_POST['description']);
        $xjeux->SetUrl_img($_POST['url_img']);
        $xjeux->SetUrl_swf($_POST['url_swf']);
        $xjeux->SetWidth($_POST['width']);
        $xjeux->SetHeight($_POST['height']);
        $xjeux->store();
        redirect_header('jeux.php', 1, _AM_DBUPDATED);
        exit();
        break;
    case 'delete':
        if (1 != $_GET['ok']) {
            xoops_cp_header();

            echo "<table width='100%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";

            echo "<div class='confirmMsg'>";

            echo '<h4>';

            echo '' . _MADGAME_JEUX_DELETE . '</font></h4><br>';

            echo '<table><tr><td>';

            echo myTextForm('jeux.php?op=delete&id=' . $_POST['id'] . '&ok=1', _AM_YES);

            echo '</td><td>';

            echo myTextForm('jeux.php?op=default', _AM_NO);

            echo '</td></tr></table>';

            echo '</div><br><br>';

            echo '</td></tr></table>';
        } else {
            $xjeux = new Jeux($_GET['id']);

            $xjeux->delete();

            redirect_header('jeux.php', 1, _AM_DELETE);

            exit();
        }
        break;
    case _MADGAME_MOD:        // Modifier
        xoops_cp_header();
        $modify = 1;
        sectionheader();
        editJeuxForm($_POST['id']);
        break;
    case 'default':
    default:

        xoops_cp_header();
        sectionheader();

        $xjeux = new Jeux();
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $mform = new XoopsThemeForm(_MADGAME_MOD . ' ' . _MADGAME_JEUX, 'modify', xoops_getenv('PHP_SELF'));

        ob_start();
        $xjeux->makeSelBox('id', 0);
        $mform->addElement(new XoopsFormLabel(_MADGAME_JEUX_NOM, ob_get_contents()));
        ob_end_clean();
        $button_tray = new XoopsFormElementTray('', '');

        $button_tray->addElement(new XoopsFormHidden('modify', '1'));
        $button_tray->addElement(new XoopsFormHidden('op', _MADGAME_MOD));
        $button_tray->addElement(new XoopsFormButton('', '', _MADGAME_MOD, 'submit'));
        $mform->addElement($button_tray);
        $mform->display();

        $xjeux = new Jeux();
        editJeuxForm();
        break;
}
xoops_cp_footer();
