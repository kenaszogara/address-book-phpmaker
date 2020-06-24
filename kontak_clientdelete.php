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
$kontak_client_delete = new kontak_client_delete();

// Run the page
$kontak_client_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_client_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkontak_clientdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkontak_clientdelete = currentForm = new ew.Form("fkontak_clientdelete", "delete");
	loadjs.done("fkontak_clientdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kontak_client_delete->showPageHeader(); ?>
<?php
$kontak_client_delete->showMessage();
?>
<form name="fkontak_clientdelete" id="fkontak_clientdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak_client">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kontak_client_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kontak_client_delete->id_kontak->Visible) { // id_kontak ?>
		<th class="<?php echo $kontak_client_delete->id_kontak->headerCellClass() ?>"><span id="elh_kontak_client_id_kontak" class="kontak_client_id_kontak"><?php echo $kontak_client_delete->id_kontak->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_client_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $kontak_client_delete->nama->headerCellClass() ?>"><span id="elh_kontak_client_nama" class="kontak_client_nama"><?php echo $kontak_client_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_client_delete->no_hp->Visible) { // no_hp ?>
		<th class="<?php echo $kontak_client_delete->no_hp->headerCellClass() ?>"><span id="elh_kontak_client_no_hp" class="kontak_client_no_hp"><?php echo $kontak_client_delete->no_hp->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_client_delete->gender->Visible) { // gender ?>
		<th class="<?php echo $kontak_client_delete->gender->headerCellClass() ?>"><span id="elh_kontak_client_gender" class="kontak_client_gender"><?php echo $kontak_client_delete->gender->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_client_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<th class="<?php echo $kontak_client_delete->tgl_lahir->headerCellClass() ?>"><span id="elh_kontak_client_tgl_lahir" class="kontak_client_tgl_lahir"><?php echo $kontak_client_delete->tgl_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_client_delete->tgl_kenal->Visible) { // tgl_kenal ?>
		<th class="<?php echo $kontak_client_delete->tgl_kenal->headerCellClass() ?>"><span id="elh_kontak_client_tgl_kenal" class="kontak_client_tgl_kenal"><?php echo $kontak_client_delete->tgl_kenal->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kontak_client_delete->RecordCount = 0;
$i = 0;
while (!$kontak_client_delete->Recordset->EOF) {
	$kontak_client_delete->RecordCount++;
	$kontak_client_delete->RowCount++;

	// Set row properties
	$kontak_client->resetAttributes();
	$kontak_client->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kontak_client_delete->loadRowValues($kontak_client_delete->Recordset);

	// Render row
	$kontak_client_delete->renderRow();
?>
	<tr <?php echo $kontak_client->rowAttributes() ?>>
<?php if ($kontak_client_delete->id_kontak->Visible) { // id_kontak ?>
		<td <?php echo $kontak_client_delete->id_kontak->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_id_kontak" class="kontak_client_id_kontak">
<span<?php echo $kontak_client_delete->id_kontak->viewAttributes() ?>><?php echo $kontak_client_delete->id_kontak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_client_delete->nama->Visible) { // nama ?>
		<td <?php echo $kontak_client_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_nama" class="kontak_client_nama">
<span<?php echo $kontak_client_delete->nama->viewAttributes() ?>><?php echo $kontak_client_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_client_delete->no_hp->Visible) { // no_hp ?>
		<td <?php echo $kontak_client_delete->no_hp->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_no_hp" class="kontak_client_no_hp">
<span<?php echo $kontak_client_delete->no_hp->viewAttributes() ?>><?php echo $kontak_client_delete->no_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_client_delete->gender->Visible) { // gender ?>
		<td <?php echo $kontak_client_delete->gender->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_gender" class="kontak_client_gender">
<span<?php echo $kontak_client_delete->gender->viewAttributes() ?>><?php echo $kontak_client_delete->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_client_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<td <?php echo $kontak_client_delete->tgl_lahir->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_tgl_lahir" class="kontak_client_tgl_lahir">
<span<?php echo $kontak_client_delete->tgl_lahir->viewAttributes() ?>><?php echo $kontak_client_delete->tgl_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_client_delete->tgl_kenal->Visible) { // tgl_kenal ?>
		<td <?php echo $kontak_client_delete->tgl_kenal->cellAttributes() ?>>
<span id="el<?php echo $kontak_client_delete->RowCount ?>_kontak_client_tgl_kenal" class="kontak_client_tgl_kenal">
<span<?php echo $kontak_client_delete->tgl_kenal->viewAttributes() ?>><?php echo $kontak_client_delete->tgl_kenal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kontak_client_delete->Recordset->moveNext();
}
$kontak_client_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_client_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kontak_client_delete->showPageFooter();
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
$kontak_client_delete->terminate();
?>