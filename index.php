<?php

declare(strict_types=1);

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

// Affichage du titre en fonction du theme
$mod_url = XOOPS_URL . '/modules/MadGames/';
$mod_img = XOOPS_URL . '/modules/MadGames/images/logo.gif';
if ('default' != $xoopsConfig['theme_set'] && file_exists(XOOPS_THEME_PATH . '/' . $xoopsConfig['theme_set'] . '/images/madgame.gif')) {
    $mod_img = XOOPS_URL . '/themes/' . $xoopsConfig['theme_set'] . '/images/madgame.gif';
}
// Affichage du titre en fonction du theme

if (!isset($cid)) {
    $cid = 0;
}
if (!isset($GameId)) {
    gamelist($cid);
} else {
    gamePlay($GameId, $cid);
}

require XOOPS_ROOT_PATH . '/footer.php';

function gamePlay($GameId, $cid)
{
    global $xoopsDB, $mod_url, $mod_img;

    $games = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('madgames') . " WHERE id='$GameId'");

    $row = $xoopsDB->fetchArray($games);

    $url_swf = $row['url_swf'];

    $width = $row['width'];

    $height = $row['height'];

    if (0 == $width) {
        $width = 600;
    }

    if (0 == $height) {
        $height = 500;
    }

    echo "\n<table width='100%' cellspacing='5' cellpadding='0' border='0'>\n";

    echo "<tr><td colspan='3' align='center'><a href='" . $mod_url . "/index.php'><img src='" . $mod_img . "' border='0'></a></td></tr>\n";

    echo "<tr><td colspan='3' align='center'>&nbsp;</td></tr>\n";

    echo "<tr><td width='10%'>&nbsp;</td><td width='80%' align='center'>\n";

    echo "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/Flash/swflash.cab#version=6,0,29,0' width='$width' height='$height'>\n";

    echo "<param name='movie' value='$url_swf'>\n";

    echo "<param name='quality' value='high'>\n";

    echo "<param name='menu' value='false'>\n";

    echo "<embed src='$url_swf' width='$width' height='$height' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' menu='false'>\n";

    echo "</embed>\n";

    echo "</object>\n";

    echo "</td><td width='10%'>&nbsp;</td></tr>\n";

    echo "</table>\n";
}

function gamelist($cid = 0)
{
    global $xoopsDB, $mod_url, $mod_img;

    $clrclass = '';

    echo "\n<table width='100%' cellspacing='5' cellpadding='0' border='0'>\n";

    echo "<tr><td colspan='3' align='center'><a href='" . $mod_url . "/index.php'><img src='" . $mod_img . "' border='0'></a></td></tr>\n";

    echo "<tr><td colspan='3' align='center'>&nbsp;</td></tr>\n";

    echo "<tr><td width='10%'>&nbsp;</td><td width='80%' align='center'>\n";

    echo _MADGAME_CATEGORY . " : \n";

    echo "<select name='cid' onChange='window.location.href=this.options[this.selectedIndex].value;'>\n";

    echo "<option value='" . XOOPS_URL . "/modules/MadGames/index.php?cid=0'>" . _MADGAME_ALLGAMES . "\n";

    $cat_games = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('madgames_categorie '));

    while (false !== ($row = $xoopsDB->fetchArray($cat_games))) {
        $id = $row['id'];

        echo "<option value='" . XOOPS_URL . '/modules/MadGames/index.php?cid=' . $id . "'";

        if ($id == $cid) {
            echo ' selected';
        }

        echo '>' . $row['nom'] . "\n";
    }

    echo "</select>\n";

    echo "</td></tr>\n";

    echo "<tr><td colspan='3' align='center'>&nbsp;</td></tr>\n";

    echo "<tr><td width='10%'>&nbsp;</td><td width='80%'>\n";

    if (0 == $cid) {
        $games = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('madgames'));
    } else {
        $games = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('madgames') . " WHERE cid=$cid");
    }

    $nb = $xoopsDB->getRowsNum($games);

    if (0 != $nb) {
        echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>\n";

        while (false !== ($row = $xoopsDB->fetchArray($games))) {
            $url_img = $row['url_img'];

            $name = $row['nom'];

            $game = XOOPS_URL . '/modules/MadGames/index.php?GameId=' . $row['id'] . '&cid=' . $cid;

            $description = $row['description'];

            if ('even' == $clrclass) {
                $clrclass = 'odd';
            } else {
                $clrclass = 'even';
            }

            echo "<tr class='$clrclass'>
			<td width='100' align='left' valign='top'><a href='$game'><img src='$url_img' width='70' hieght='59' alt='" . _MADGAME_PLAYGAME . "' border='0'></a></td>
			<td align='left' valign='top'>$name<br>$description</td>
			</tr>\n";
        }

        echo "</table>\n";
    }

    echo "</td><td width='10%'>&nbsp;</td></tr>\n";

    echo "<tr><td colspan='3' align='center'>&nbsp;</td></tr>\n";

    echo "</table>\n";
}
