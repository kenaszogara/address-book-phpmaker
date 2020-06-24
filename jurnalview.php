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
$jurnal_view = new jurnal_view();

// Run the page
$jurnal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jurnal_view->isExport()) { ?>
<script>
var fjurnalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjurnalview = currentForm = new ew.Form("fjurnalview", "view");
	loadjs.done("fjurnalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jurnal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jurnal_view->ExportOptions->render("body") ?>
<?php $jurnal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jurnal_view->showPageHeader(); ?>
<?php
$jurnal_view->showMessage();
?>
<form name="fjurnalview" id="fjurnalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jurnal_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_id"><?php echo $jurnal_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jurnal_view->id->cellAttributes() ?>>
<span id="el_jurnal_id">
<span<?php echo $jurnal_view->id->viewAttributes() ?>><?php echo $jurnal_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->id_kontak->Visible) { // id_kontak ?>
	<tr id="r_id_kontak">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_id_kontak"><?php echo $jurnal_view->id_kontak->caption() ?></span></td>
		<td data-name="id_kontak" <?php echo $jurnal_view->id_kontak->cellAttributes() ?>>
<span id="el_jurnal_id_kontak">
<span<?php echo $jurnal_view->id_kontak->viewAttributes() ?>><?php echo $jurnal_view->id_kontak->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->item->Visible) { // item ?>
	<tr id="r_item">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_item"><?php echo $jurnal_view->item->caption() ?></span></td>
		<td data-name="item" <?php echo $jurnal_view->item->cellAttributes() ?>>
<span id="el_jurnal_item">
<span<?php echo $jurnal_view->item->viewAttributes() ?>><?php echo $jurnal_view->item->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_qty"><?php echo $jurnal_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $jurnal_view->qty->cellAttributes() ?>>
<span id="el_jurnal_qty">
<span<?php echo $jurnal_view->qty->viewAttributes() ?>><?php echo $jurnal_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->memo->Visible) { // memo ?>
	<tr id="r_memo">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_memo"><?php echo $jurnal_view->memo->caption() ?></span></td>
		<td data-name="memo" <?php echo $jurnal_view->memo->cellAttributes() ?>>
<span id="el_jurnal_memo">
<span<?php echo $jurnal_view->memo->viewAttributes() ?>><?php echo $jurnal_view->memo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_tgl"><?php echo $jurnal_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $jurnal_view->tgl->cellAttributes() ?>>
<span id="el_jurnal_tgl">
<span<?php echo $jurnal_view->tgl->viewAttributes() ?>><?php echo $jurnal_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jurnal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jurnal_view->isExport()) { ?>
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
$jurnal_view->terminate();
?>