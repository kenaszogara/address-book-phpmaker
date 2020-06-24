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
$user_list = new user_list();

// Run the page
$user_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_list->isExport()) { ?>
<script>
var fuserlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuserlist = currentForm = new ew.Form("fuserlist", "list");
	fuserlist.formKeyCountName = '<?php echo $user_list->FormKeyCountName ?>';
	loadjs.done("fuserlist");
});
var fuserlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuserlistsrch = currentSearchForm = new ew.Form("fuserlistsrch");

	// Dynamic selection lists
	// Filters

	fuserlistsrch.filterList = <?php echo $user_list->getFilterList() ?>;
	loadjs.done("fuserlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$user_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($user_list->TotalRecords > 0 && $user_list->ExportOptions->visible()) { ?>
<?php $user_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->ImportOptions->visible()) { ?>
<?php $user_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->SearchOptions->visible()) { ?>
<?php $user_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->FilterOptions->visible()) { ?>
<?php $user_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$user_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$user_list->isExport() && !$user->CurrentAction) { ?>
<form name="fuserlistsrch" id="fuserlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuserlistsrch-search-panel" class="<?php echo $user_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $user_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($user_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($user_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $user_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $user_list->showPageHeader(); ?>
<?php
$user_list->showMessage();
?>
<?php if ($user_list->TotalRecords > 0 || $user->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($user_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user">
<?php if (!$user_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$user_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlist" id="fuserlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<div id="gmp_user" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($user_list->TotalRecords > 0 || $user_list->isGridEdit()) { ?>
<table id="tbl_userlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$user->RowType = ROWTYPE_HEADER;

// Render list options
$user_list->renderListOptions();

// Render list options (header, left)
$user_list->ListOptions->render("header", "left");
?>
<?php if ($user_list->username->Visible) { // username ?>
	<?php if ($user_list->SortUrl($user_list->username) == "") { ?>
		<th data-name="username" class="<?php echo $user_list->username->headerCellClass() ?>"><div id="elh_user_username" class="user_username"><div class="ew-table-header-caption"><?php echo $user_list->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $user_list->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->username) ?>', 1);"><div id="elh_user_username" class="user_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->username->caption() ?></span><span class="ew-table-header-sort"><?php if ($user_list->username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_list->password->Visible) { // password ?>
	<?php if ($user_list->SortUrl($user_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $user_list->password->headerCellClass() ?>"><div id="elh_user_password" class="user_password"><div class="ew-table-header-caption"><?php echo $user_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $user_list->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->password) ?>', 1);"><div id="elh_user_password" class="user_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_list->userlevel->Visible) { // userlevel ?>
	<?php if ($user_list->SortUrl($user_list->userlevel) == "") { ?>
		<th data-name="userlevel" class="<?php echo $user_list->userlevel->headerCellClass() ?>"><div id="elh_user_userlevel" class="user_userlevel"><div class="ew-table-header-caption"><?php echo $user_list->userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel" class="<?php echo $user_list->userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_list->SortUrl($user_list->userlevel) ?>', 1);"><div id="elh_user_userlevel" class="user_userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_list->userlevel->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_list->userlevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_list->userlevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$user_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($user_list->ExportAll && $user_list->isExport()) {
	$user_list->StopRecord = $user_list->TotalRecords;
} else {

	// Set the last record to display
	if ($user_list->TotalRecords > $user_list->StartRecord + $user_list->DisplayRecords - 1)
		$user_list->StopRecord = $user_list->StartRecord + $user_list->DisplayRecords - 1;
	else
		$user_list->StopRecord = $user_list->TotalRecords;
}
$user_list->RecordCount = $user_list->StartRecord - 1;
if ($user_list->Recordset && !$user_list->Recordset->EOF) {
	$user_list->Recordset->moveFirst();
	$selectLimit = $user_list->UseSelectLimit;
	if (!$selectLimit && $user_list->StartRecord > 1)
		$user_list->Recordset->move($user_list->StartRecord - 1);
} elseif (!$user->AllowAddDeleteRow && $user_list->StopRecord == 0) {
	$user_list->StopRecord = $user->GridAddRowCount;
}

// Initialize aggregate
$user->RowType = ROWTYPE_AGGREGATEINIT;
$user->resetAttributes();
$user_list->renderRow();
while ($user_list->RecordCount < $user_list->StopRecord) {
	$user_list->RecordCount++;
	if ($user_list->RecordCount >= $user_list->StartRecord) {
		$user_list->RowCount++;

		// Set up key count
		$user_list->KeyCount = $user_list->RowIndex;

		// Init row class and style
		$user->resetAttributes();
		$user->CssClass = "";
		if ($user_list->isGridAdd()) {
		} else {
			$user_list->loadRowValues($user_list->Recordset); // Load row values
		}
		$user->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$user->RowAttrs->merge(["data-rowindex" => $user_list->RowCount, "id" => "r" . $user_list->RowCount . "_user", "data-rowtype" => $user->RowType]);

		// Render row
		$user_list->renderRow();

		// Render list options
		$user_list->renderListOptions();
?>
	<tr <?php echo $user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_list->ListOptions->render("body", "left", $user_list->RowCount);
?>
	<?php if ($user_list->username->Visible) { // username ?>
		<td data-name="username" <?php echo $user_list->username->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_username">
<span<?php echo $user_list->username->viewAttributes() ?>><?php echo $user_list->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $user_list->password->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_password">
<span<?php echo $user_list->password->viewAttributes() ?>><?php echo $user_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_list->userlevel->Visible) { // userlevel ?>
		<td data-name="userlevel" <?php echo $user_list->userlevel->cellAttributes() ?>>
<span id="el<?php echo $user_list->RowCount ?>_user_userlevel">
<span<?php echo $user_list->userlevel->viewAttributes() ?>><?php echo $user_list->userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_list->ListOptions->render("body", "right", $user_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$user_list->isGridAdd())
		$user_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$user->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($user_list->Recordset)
	$user_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($user_list->TotalRecords == 0 && !$user->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$user_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_list->isExport()) { ?>
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
$user_list->terminate();
?>