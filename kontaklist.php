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
$kontak_list = new kontak_list();

// Run the page
$kontak_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kontak_list->isExport()) { ?>
<script>
var fkontaklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkontaklist = currentForm = new ew.Form("fkontaklist", "list");
	fkontaklist.formKeyCountName = '<?php echo $kontak_list->FormKeyCountName ?>';
	loadjs.done("fkontaklist");
});
var fkontaklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkontaklistsrch = currentSearchForm = new ew.Form("fkontaklistsrch");

	// Dynamic selection lists
	// Filters

	fkontaklistsrch.filterList = <?php echo $kontak_list->getFilterList() ?>;
	loadjs.done("fkontaklistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kontak_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kontak_list->TotalRecords > 0 && $kontak_list->ExportOptions->visible()) { ?>
<?php $kontak_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->ImportOptions->visible()) { ?>
<?php $kontak_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->SearchOptions->visible()) { ?>
<?php $kontak_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->FilterOptions->visible()) { ?>
<?php $kontak_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kontak_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kontak_list->isExport() && !$kontak->CurrentAction) { ?>
<form name="fkontaklistsrch" id="fkontaklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkontaklistsrch-search-panel" class="<?php echo $kontak_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kontak">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kontak_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kontak_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kontak_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kontak_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kontak_list->showPageHeader(); ?>
<?php
$kontak_list->showMessage();
?>
<?php if ($kontak_list->TotalRecords > 0 || $kontak->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kontak_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kontak">
<?php if (!$kontak_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kontak_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kontak_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kontak_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkontaklist" id="fkontaklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<div id="gmp_kontak" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kontak_list->TotalRecords > 0 || $kontak_list->isGridEdit()) { ?>
<table id="tbl_kontaklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kontak->RowType = ROWTYPE_HEADER;

// Render list options
$kontak_list->renderListOptions();

// Render list options (header, left)
$kontak_list->ListOptions->render("header", "left");
?>
<?php if ($kontak_list->id_nuskin->Visible) { // id_nuskin ?>
	<?php if ($kontak_list->SortUrl($kontak_list->id_nuskin) == "") { ?>
		<th data-name="id_nuskin" class="<?php echo $kontak_list->id_nuskin->headerCellClass() ?>"><div id="elh_kontak_id_nuskin" class="kontak_id_nuskin"><div class="ew-table-header-caption"><?php echo $kontak_list->id_nuskin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_nuskin" class="<?php echo $kontak_list->id_nuskin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->id_nuskin) ?>', 1);"><div id="elh_kontak_id_nuskin" class="kontak_id_nuskin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->id_nuskin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->id_nuskin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->id_nuskin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->nama->Visible) { // nama ?>
	<?php if ($kontak_list->SortUrl($kontak_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $kontak_list->nama->headerCellClass() ?>"><div id="elh_kontak_nama" class="kontak_nama"><div class="ew-table-header-caption"><?php echo $kontak_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $kontak_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->nama) ?>', 1);"><div id="elh_kontak_nama" class="kontak_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->no_hp->Visible) { // no_hp ?>
	<?php if ($kontak_list->SortUrl($kontak_list->no_hp) == "") { ?>
		<th data-name="no_hp" class="<?php echo $kontak_list->no_hp->headerCellClass() ?>"><div id="elh_kontak_no_hp" class="kontak_no_hp"><div class="ew-table-header-caption"><?php echo $kontak_list->no_hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_hp" class="<?php echo $kontak_list->no_hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->no_hp) ?>', 1);"><div id="elh_kontak_no_hp" class="kontak_no_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->no_hp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->no_hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->no_hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->_email->Visible) { // email ?>
	<?php if ($kontak_list->SortUrl($kontak_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $kontak_list->_email->headerCellClass() ?>"><div id="elh_kontak__email" class="kontak__email"><div class="ew-table-header-caption"><?php echo $kontak_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $kontak_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->_email) ?>', 1);"><div id="elh_kontak__email" class="kontak__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->gender->Visible) { // gender ?>
	<?php if ($kontak_list->SortUrl($kontak_list->gender) == "") { ?>
		<th data-name="gender" class="<?php echo $kontak_list->gender->headerCellClass() ?>"><div id="elh_kontak_gender" class="kontak_gender"><div class="ew-table-header-caption"><?php echo $kontak_list->gender->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gender" class="<?php echo $kontak_list->gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->gender) ?>', 1);"><div id="elh_kontak_gender" class="kontak_gender">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->gender->caption() ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->gender->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->gender->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->tgl_lahir->Visible) { // tgl_lahir ?>
	<?php if ($kontak_list->SortUrl($kontak_list->tgl_lahir) == "") { ?>
		<th data-name="tgl_lahir" class="<?php echo $kontak_list->tgl_lahir->headerCellClass() ?>"><div id="elh_kontak_tgl_lahir" class="kontak_tgl_lahir"><div class="ew-table-header-caption"><?php echo $kontak_list->tgl_lahir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_lahir" class="<?php echo $kontak_list->tgl_lahir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->tgl_lahir) ?>', 1);"><div id="elh_kontak_tgl_lahir" class="kontak_tgl_lahir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->tgl_lahir->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->tgl_lahir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->tgl_lahir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak_list->tgl_kenal->Visible) { // tgl_kenal ?>
	<?php if ($kontak_list->SortUrl($kontak_list->tgl_kenal) == "") { ?>
		<th data-name="tgl_kenal" class="<?php echo $kontak_list->tgl_kenal->headerCellClass() ?>"><div id="elh_kontak_tgl_kenal" class="kontak_tgl_kenal"><div class="ew-table-header-caption"><?php echo $kontak_list->tgl_kenal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_kenal" class="<?php echo $kontak_list->tgl_kenal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kontak_list->SortUrl($kontak_list->tgl_kenal) ?>', 1);"><div id="elh_kontak_tgl_kenal" class="kontak_tgl_kenal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak_list->tgl_kenal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak_list->tgl_kenal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kontak_list->tgl_kenal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kontak_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kontak_list->ExportAll && $kontak_list->isExport()) {
	$kontak_list->StopRecord = $kontak_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kontak_list->TotalRecords > $kontak_list->StartRecord + $kontak_list->DisplayRecords - 1)
		$kontak_list->StopRecord = $kontak_list->StartRecord + $kontak_list->DisplayRecords - 1;
	else
		$kontak_list->StopRecord = $kontak_list->TotalRecords;
}
$kontak_list->RecordCount = $kontak_list->StartRecord - 1;
if ($kontak_list->Recordset && !$kontak_list->Recordset->EOF) {
	$kontak_list->Recordset->moveFirst();
	$selectLimit = $kontak_list->UseSelectLimit;
	if (!$selectLimit && $kontak_list->StartRecord > 1)
		$kontak_list->Recordset->move($kontak_list->StartRecord - 1);
} elseif (!$kontak->AllowAddDeleteRow && $kontak_list->StopRecord == 0) {
	$kontak_list->StopRecord = $kontak->GridAddRowCount;
}

// Initialize aggregate
$kontak->RowType = ROWTYPE_AGGREGATEINIT;
$kontak->resetAttributes();
$kontak_list->renderRow();
while ($kontak_list->RecordCount < $kontak_list->StopRecord) {
	$kontak_list->RecordCount++;
	if ($kontak_list->RecordCount >= $kontak_list->StartRecord) {
		$kontak_list->RowCount++;

		// Set up key count
		$kontak_list->KeyCount = $kontak_list->RowIndex;

		// Init row class and style
		$kontak->resetAttributes();
		$kontak->CssClass = "";
		if ($kontak_list->isGridAdd()) {
		} else {
			$kontak_list->loadRowValues($kontak_list->Recordset); // Load row values
		}
		$kontak->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kontak->RowAttrs->merge(["data-rowindex" => $kontak_list->RowCount, "id" => "r" . $kontak_list->RowCount . "_kontak", "data-rowtype" => $kontak->RowType]);

		// Render row
		$kontak_list->renderRow();

		// Render list options
		$kontak_list->renderListOptions();
?>
	<tr <?php echo $kontak->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kontak_list->ListOptions->render("body", "left", $kontak_list->RowCount);
?>
	<?php if ($kontak_list->id_nuskin->Visible) { // id_nuskin ?>
		<td data-name="id_nuskin" <?php echo $kontak_list->id_nuskin->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_id_nuskin">
<span<?php echo $kontak_list->id_nuskin->viewAttributes() ?>><?php echo $kontak_list->id_nuskin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $kontak_list->nama->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_nama">
<span<?php echo $kontak_list->nama->viewAttributes() ?>><?php echo $kontak_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->no_hp->Visible) { // no_hp ?>
		<td data-name="no_hp" <?php echo $kontak_list->no_hp->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_no_hp">
<span<?php echo $kontak_list->no_hp->viewAttributes() ?>><?php echo $kontak_list->no_hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $kontak_list->_email->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak__email">
<span<?php echo $kontak_list->_email->viewAttributes() ?>><?php echo $kontak_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->gender->Visible) { // gender ?>
		<td data-name="gender" <?php echo $kontak_list->gender->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_gender">
<span<?php echo $kontak_list->gender->viewAttributes() ?>><?php echo $kontak_list->gender->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->tgl_lahir->Visible) { // tgl_lahir ?>
		<td data-name="tgl_lahir" <?php echo $kontak_list->tgl_lahir->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_tgl_lahir">
<span<?php echo $kontak_list->tgl_lahir->viewAttributes() ?>><?php echo $kontak_list->tgl_lahir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak_list->tgl_kenal->Visible) { // tgl_kenal ?>
		<td data-name="tgl_kenal" <?php echo $kontak_list->tgl_kenal->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCount ?>_kontak_tgl_kenal">
<span<?php echo $kontak_list->tgl_kenal->viewAttributes() ?>><?php echo $kontak_list->tgl_kenal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kontak_list->ListOptions->render("body", "right", $kontak_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kontak_list->isGridAdd())
		$kontak_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kontak->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kontak_list->Recordset)
	$kontak_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kontak_list->TotalRecords == 0 && !$kontak->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kontak_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kontak_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kontak_list->isExport()) { ?>
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
$kontak_list->terminate();
?>