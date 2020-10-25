<?php

declare(strict_types=1);

// $Id: xoops_version.php,v 1.7 2003/11/11 Shine Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
$modversion['name'] = 'MadGame';
$modversion['version'] = 2.0;
$modversion['author'] = 'DuGris / MadBead';
$modversion['description'] = 'Madgame';
$modversion['credits'] = 'DuGris pour MadBead<br>( http://www.madbead.net )<br>The XOOPS Project';

$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = '';
$modversion['image'] = 'images/MadGames_slogo.png';
$modversion['dirname'] = 'MadGames';

// Tables created by sql file (without prefix!)
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'madgames_categorie';
$modversion['tables'][1] = 'madgames';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Blocks
$modversion['blocks'][1]['file'] = 'game_block.php';
$modversion['blocks'][1]['name'] = 'MadGames';
$modversion['blocks'][1]['description'] = 'Voir les icones des jeux';
$modversion['blocks'][1]['show_func'] = 'show_MadGames';
$modversion['blocks'][1]['template'] = 'game_block.html';

// Menu
$modversion['hasMain'] = 1;
