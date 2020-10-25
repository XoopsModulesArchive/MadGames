<?php

declare(strict_types=1);

function show_MadGames()
{
    global $xoopsDB;

    $block['image_links'] = "<table cellspacing='2' cellpadding='2'><center>\n";

    $games = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('madgames'));

    while (false !== ($row = $xoopsDB->fetchArray($games))) {
        $url_img = $row['url_img'];

        $name = $row['nom'];

        $game = XOOPS_URL . '/modules/MadGames/index.php?GameId=' . $row['id'] . '&cid=0';

        $block['image_links'] .= "<tr><td align='center'>\n
    <a href='" . $game . "'><img src='" . $url_img . "' width='70' height='59' alt='" . _MADGAME_PLAYGAME . ' ' . $name . "' border='0'></a>\n
    </td></tr>\n
    <td align='center'>" . $name . "</td></tr>\n";
    }

    $block['image_links'] .= "</center></table>\n";

    return $block;
}
