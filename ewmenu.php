<?php
namespace PHPMaker2020\otg;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_kontak", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "kontaklist.php", -1, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}kontak'), FALSE, FALSE, "fas fa-address-book", "", FALSE);
$sideMenu->addMenuItem(6, "mi_kontak_customer", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "kontak_customerlist.php", -1, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}kontak_customer'), FALSE, FALSE, "fas fa-user-tag", "", FALSE);
$sideMenu->addMenuItem(5, "mi_kontak_bisnis", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "kontak_bisnislist.php", -1, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}kontak_bisnis'), FALSE, FALSE, "fas fa-user-tie", "", FALSE);
$sideMenu->addMenuItem(8, "mi_jurnal", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "jurnallist.php", -1, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}jurnal'), FALSE, FALSE, "fas fa-clipboard", "", FALSE);
$sideMenu->addMenuItem(7, "mci_Settings", $MenuLanguage->MenuPhrase("7", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fas fa-cogs", "", FALSE);
$sideMenu->addMenuItem(2, "mi_user", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "userlist.php", 7, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}user'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_userlevels", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "userlevelslist.php", 7, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", 7, "", IsLoggedIn() || AllowListMenu('{B40BBF3D-F2D9-4EB0-BEDB-E582E946496C}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>