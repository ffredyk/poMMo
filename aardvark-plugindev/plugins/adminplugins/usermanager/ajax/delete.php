<?php
/**
 * Copyright (C) 2005, 2006, 2007  Brice Burgess <bhb@iceburg.net>
 * 
 * This file is part of poMMo (http://www.pommo.org)
 * 
 * poMMo is free software; you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published 
 * by the Free Software Foundation; either version 2, or any later version.
 * 
 * poMMo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See
 * the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with program; see the file docs/LICENSE. If not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
 */

 /**********************************
	INITIALIZATION METHODS
 *********************************/
require ('../../../../bootstrap.php');

$pommo->init(array('noDebug' => TRUE));

	
/**********************************
	SETUP TEMPLATE, PAGE
 *********************************/
Pommo::requireOnce($pommo->_baseDir.'inc/classes/template.php');
$smarty = new PommoTemplate();


Pommo::requireOnce($pommo->_baseDir.'plugins/adminplugins/usermanager/class.db_userhandler.php');
$dbhandler = new UserDBHandler();
if ($_REQUEST['groupid']) {
	$smarty->assign('groupid', $_REQUEST['groupid']);
	$smarty->assign('delgroup', TRUE);
	$smarty->assign('info', $dbhandler->dbFetchPermInfo($_REQUEST['groupid']));
}
if ($_REQUEST['userid']) {
	$smarty->assign('userid', $_REQUEST['userid']);
	$smarty->assign('deluser', TRUE);
	$smarty->assign('info', $dbhandler->dbFetchUserInfo($_REQUEST['userid']));
}

/*$smarty->assign('permgroups',  $dbhandler->dbFetchPermNames());*/

$smarty->display('plugins/adminplugins/usermanager/ajax/delete.tpl');
Pommo::kill();

?>