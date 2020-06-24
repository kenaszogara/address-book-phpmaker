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
$jurnal_delete = new jurnal_delete();

// Run the page
$jurnal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjurnaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjurnaldelete = currentForm = new ew.Form("fjurnaldelete", "delete");
	loadjs.done("fjurnaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jurnal_delete->showPageHeader(); ?>
<?php
$jurnal_delete->showMessage();
?>
<form name="fjurnaldelete" id="fjurnaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jurnal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jurnal_delete->id_kontak->Visible) { // id_kontak ?>
		<th class="<?php echo $jurnal_delete->id_kontak->headerCellClass() ?>"><span id="elh_jurnal_id_kontak" class="jurnal_id_kontak"><?php echo $jurnal_delete->id_kontak->caption() ?></span></th>
<?php } ?>
<?php if ($jurnal_delete->item->Visible) { // item ?>
		<th class="<?php echo $jurnal_delete->item->headerCellClass() ?>"><span id="elh_jurnal_item" class="jurnal_item"><?php echo $jurnal_delete->item->caption() ?></span></th>
<?php } ?>
<?php if ($jurnal_delete->qty->Visible) { // qty ?>
		<th class="<?php echo $jurnal_delete->qty->headerCellClass() ?>"><span id="elh_jurnal_qty" class="jurnal_qty"><?php echo $jurnal_delete->qty->caption() ?></span></th>
<?php } ?>
<?php if ($jurnal_delete->memo->Visible) { // memo ?>
		<th class="<?php echo $jurnal_delete->memo->headerCellClass() ?>"><span id="elh_jurnal_memo" class="jurnal_memo"><?php echo $jurnal_delete->memo->caption() ?></span></th>
<?php } ?>
<?php if ($jurnal_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $jurnal_delete->tgl->headerCellClass() ?>"><span id="elh_jurnal_tgl" class="jurnal_tgl"><?php echo $jurnal_delete->tgl->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jurnal_delete->RecordCount = 0;
$i = 0;
while (!$jurnal_delete->Recordset->EOF) {
	$jurnal_delete->RecordCount++;
	$jurnal_delete->RowCount++;

	// Set row properties
	$jurnal->resetAttributes();
	$jurnal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jurnal_delete->loadRowValues($jurnal_delete->Recordset);

	// Render row
	$jurnal_delete->renderRow();
?>
	<tr <?php echo $jurnal->rowAttributes() ?>>
<?php if ($jurnal_delete->id_kontak->Visible) { // id_kontak ?>
		<td <?php echo $jurnal_delete->id_kontak->cellAttributes() ?>>
<span id="el<?php echo $jurnal_delete->RowCount ?>_jurnal_id_kontak" class="jurnal_id_kontak">
<span<?php echo $jurnal_delete->id_kontak->viewAttributes() ?>><?php echo $jurnal_delete->id_kontak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jurnal_delete->item->Visible) { // item ?>
		<td <?php echo $jurnal_delete->item->cellAttributes() ?>>
<span id="el<?php echo $jurnal_delete->RowCount ?>_jurnal_item" class="jurnal_item">
<span<?php echo $jurnal_delete->item->viewAttributes() ?>><?php echo $jurnal_delete->item->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jurnal_delete->qty->Visible) { // qty ?>
		<td <?php echo $jurnal_delete->qty->cellAttributes() ?>>
<span id="el<?php echo $jurnal_delete->RowCount ?>_jurnal_qty" class="jurnal_qty">
<span<?php echo $jurnal_delete->qty->viewAttributes() ?>><?php echo $jurnal_delete->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jurnal_delete->memo->Visible) { // memo ?>
		<td <?php echo $jurnal_delete->memo->cellAttributes() ?>>
<span id="el<?php echo $jurnal_delete->RowCount ?>_jurnal_memo" class="jurnal_memo">
<span<?php echo $jurnal_delete->memo->viewAttributes() ?>><?php echo $jurnal_delete->memo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jurnal_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $jurnal_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $jurnal_delete->RowCount ?>_jurnal_tgl" class="jurnal_tgl">
<span<?php echo $jurnal_delete->tgl->viewAttributes() ?>><?php echo $jurnal_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jurnal_delete->Recordset->moveNext();
}
$jurnal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jurnal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jurnal_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$jurnal_delete->terminate();
?>