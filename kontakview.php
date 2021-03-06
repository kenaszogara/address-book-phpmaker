<?php
namespace PHPMaker2020\otg;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$kontak_view = new kontak_view();

// Run the page
$kontak_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kontak_view->isExport()) { ?>
<script>
var fkontakview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkontakview = currentForm = new ew.Form("fkontakview", "view");
	loadjs.done("fkontakview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kontak_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kontak_view->ExportOptions->render("body") ?>
<?php $kontak_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kontak_view->showPageHeader(); ?>
<?php
$kontak_view->showMessage();
?>
<form name="fkontakview" id="fkontakview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<input type="hidden" name="modal" value="<?php echo (int)$kontak_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kontak_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_id"><?php echo $kontak_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $kontak_view->id->cellAttributes() ?>>
<span id="el_kontak_id">
<span<?php echo $kontak_view->id->viewAttributes() ?>><?php echo $kontak_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->id_nuskin->Visible) { // id_nuskin ?>
	<tr id="r_id_nuskin">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_id_nuskin"><?php echo $kontak_view->id_nuskin->caption() ?></span></td>
		<td data-name="id_nuskin" <?php echo $kontak_view->id_nuskin->cellAttributes() ?>>
<span id="el_kontak_id_nuskin">
<span<?php echo $kontak_view->id_nuskin->viewAttributes() ?>><?php echo $kontak_view->id_nuskin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_nama"><?php echo $kontak_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $kontak_view->nama->cellAttributes() ?>>
<span id="el_kontak_nama">
<span<?php echo $kontak_view->nama->viewAttributes() ?>><?php echo $kontak_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->no_hp->Visible) { // no_hp ?>
	<tr id="r_no_hp">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_no_hp"><?php echo $kontak_view->no_hp->caption() ?></span></td>
		<td data-name="no_hp" <?php echo $kontak_view->no_hp->cellAttributes() ?>>
<span id="el_kontak_no_hp">
<span<?php echo $kontak_view->no_hp->viewAttributes() ?>><?php echo $kontak_view->no_hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak__email"><?php echo $kontak_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $kontak_view->_email->cellAttributes() ?>>
<span id="el_kontak__email">
<span<?php echo $kontak_view->_email->viewAttributes() ?>><?php echo $kontak_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->gender->Visible) { // gender ?>
	<tr id="r_gender">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_gender"><?php echo $kontak_view->gender->caption() ?></span></td>
		<td data-name="gender" <?php echo $kontak_view->gender->cellAttributes() ?>>
<span id="el_kontak_gender">
<span<?php echo $kontak_view->gender->viewAttributes() ?>><?php echo $kontak_view->gender->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->tgl_lahir->Visible) { // tgl_lahir ?>
	<tr id="r_tgl_lahir">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_tgl_lahir"><?php echo $kontak_view->tgl_lahir->caption() ?></span></td>
		<td data-name="tgl_lahir" <?php echo $kontak_view->tgl_lahir->cellAttributes() ?>>
<span id="el_kontak_tgl_lahir">
<span<?php echo $kontak_view->tgl_lahir->viewAttributes() ?>><?php echo $kontak_view->tgl_lahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak_view->tgl_kenal->Visible) { // tgl_kenal ?>
	<tr id="r_tgl_kenal">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_tgl_kenal"><?php echo $kontak_view->tgl_kenal->caption() ?></span></td>
		<td data-name="tgl_kenal" <?php echo $kontak_view->tgl_kenal->cellAttributes() ?>>
<span id="el_kontak_tgl_kenal">
<span<?php echo $kontak_view->tgl_kenal->viewAttributes() ?>><?php echo $kontak_view->tgl_kenal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kontak_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kontak_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$kontak_view->terminate();
?>