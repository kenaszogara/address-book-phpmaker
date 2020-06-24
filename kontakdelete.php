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
$kontak_delete = new kontak_delete();

// Run the page
$kontak_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkontakdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkontakdelete = currentForm = new ew.Form("fkontakdelete", "delete");
	loadjs.done("fkontakdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kontak_delete->showPageHeader(); ?>
<?php
$kontak_delete->showMessage();
?>
<form name="fkontakdelete" id="fkontakdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kontak_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kontak_delete->id_nuskin->Visible) { // id_nuskin ?>
		<th class="<?php echo $kontak_delete->id_nuskin->headerCellClass() ?>"><span id="elh_kontak_id_nuskin" class="kontak_id_nuskin"><?php echo $kontak_delete->id_nuskin->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $kontak_delete->nama->headerCellClass() ?>"><span id="elh_kontak_nama" class="kontak_nama"><?php echo $kontak_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->no_hp->Visible) { // no_hp ?>
		<th class="<?php echo $kontak_delete->no_hp->headerCellClass() ?>"><span id="elh_kontak_no_hp" class="kontak_no_hp"><?php echo $kontak_delete->no_hp->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->_email->Visible) { // email ?>
		<th class="<?php echo $kontak_delete->_email->headerCellClass() ?>"><span id="elh_kontak__email" class="kontak__email"><?php echo $kontak_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->gender->Visible) { // gender ?>
		<th class="<?php echo $kontak_delete->gender->headerCellClass() ?>"><span id="elh_kontak_gender" class="kontak_gender"><?php echo $kontak_delete->gender->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<th class="<?php echo $kontak_delete->tgl_lahir->headerCellClass() ?>"><span id="elh_kontak_tgl_lahir" class="kontak_tgl_lahir"><?php echo $kontak_delete->tgl_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($kontak_delete->tgl_kenal->Visible) { // tgl_kenal ?>
		<th class="<?php echo $kontak_delete->tgl_kenal->headerCellClass() ?>"><span id="elh_kontak_tgl_kenal" class="kontak_tgl_kenal"><?php echo $kontak_delete->tgl_kenal->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kontak_delete->RecordCount = 0;
$i = 0;
while (!$kontak_delete->Recordset->EOF) {
	$kontak_delete->RecordCount++;
	$kontak_delete->RowCount++;

	// Set row properties
	$kontak->resetAttributes();
	$kontak->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kontak_delete->loadRowValues($kontak_delete->Recordset);

	// Render row
	$kontak_delete->renderRow();
?>
	<tr <?php echo $kontak->rowAttributes() ?>>
<?php if ($kontak_delete->id_nuskin->Visible) { // id_nuskin ?>
		<td <?php echo $kontak_delete->id_nuskin->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_id_nuskin" class="kontak_id_nuskin">
<span<?php echo $kontak_delete->id_nuskin->viewAttributes() ?>><?php echo $kontak_delete->id_nuskin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->nama->Visible) { // nama ?>
		<td <?php echo $kontak_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_nama" class="kontak_nama">
<span<?php echo $kontak_delete->nama->viewAttributes() ?>><?php echo $kontak_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->no_hp->Visible) { // no_hp ?>
		<td <?php echo $kontak_delete->no_hp->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_no_hp" class="kontak_no_hp">
<span<?php echo $kontak_delete->no_hp->viewAttributes() ?>><?php echo $kontak_delete->no_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->_email->Visible) { // email ?>
		<td <?php echo $kontak_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak__email" class="kontak__email">
<span<?php echo $kontak_delete->_email->viewAttributes() ?>><?php echo $kontak_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->gender->Visible) { // gender ?>
		<td <?php echo $kontak_delete->gender->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_gender" class="kontak_gender">
<span<?php echo $kontak_delete->gender->viewAttributes() ?>><?php echo $kontak_delete->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<td <?php echo $kontak_delete->tgl_lahir->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_tgl_lahir" class="kontak_tgl_lahir">
<span<?php echo $kontak_delete->tgl_lahir->viewAttributes() ?>><?php echo $kontak_delete->tgl_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kontak_delete->tgl_kenal->Visible) { // tgl_kenal ?>
		<td <?php echo $kontak_delete->tgl_kenal->cellAttributes() ?>>
<span id="el<?php echo $kontak_delete->RowCount ?>_kontak_tgl_kenal" class="kontak_tgl_kenal">
<span<?php echo $kontak_delete->tgl_kenal->viewAttributes() ?>><?php echo $kontak_delete->tgl_kenal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kontak_delete->Recordset->moveNext();
}
$kontak_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kontak_delete->showPageFooter();
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
$kontak_delete->terminate();
?>