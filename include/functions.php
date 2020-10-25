<?php

declare(strict_types=1);

function adminmenu()
{
    echo "<table width='100%' border='0' cellspacing='1' cellpadding = '2' class='outer'>";

    echo "<tr><td class = 'even'><b><a href='categories.php'>" . _MADGAME_CATEGORIE . '</b></a></td></tr>';

    echo "<tr><td class = 'head'><a href='jeux.php'>" . _MADGAME_JEUX . '</a></td></tr>';

    echo '</table><br>';
}
