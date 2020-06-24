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
$kontak_client_edit = new kontak_client_edit();

// Run the page
$kontak_client_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_client_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkontak_clientedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkontak_clientedit = currentForm = new ew.Form("fkontak_clientedit", "edit");

	// Validate form
	fkontak_clientedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($kontak_client_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->id->caption(), $kontak_client_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_client_edit->id_kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->id_kontak->caption(), $kontak_client_edit->id_kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_client_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->nama->caption(), $kontak_client_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_client_edit->no_hp->Required) { ?>
				elm = this.getElements("x" + infix + "_no_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->no_hp->caption(), $kontak_client_edit->no_hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_client_edit->gender->Required) { ?>
				elm = this.getElements("x" + infix + "_gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->gender->caption(), $kontak_client_edit->gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_client_edit->tgl_lahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->tgl_lahir->caption(), $kontak_client_edit->tgl_lahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kontak_client_edit->tgl_lahir->errorMessage()) ?>");
			<?php if ($kontak_client_edit->tgl_kenal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_kenal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_client_edit->tgl_kenal->caption(), $kontak_client_edit->tgl_kenal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_kenal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kontak_client_edit->tgl_kenal->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fkontak_clientedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkontak_clientedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkontak_clientedit.lists["x_id_kontak"] = <?php echo $kontak_client_edit->id_kontak->Lookup->toClientList($kontak_client_edit) ?>;
	fkontak_clientedit.lists["x_id_kontak"].options = <?php echo JsonEncode($kontak_client_edit->id_kontak->lookupOptions()) ?>;
	loadjs.done("fkontak_clientedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kontak_client_edit->showPageHeader(); ?>
<?php
$kontak_client_edit->showMessage();
?>
<form name="fkontak_clientedit" id="fkontak_clientedit" class="<?php echo $kontak_client_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak_client">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kontak_client_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kontak_client_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_kontak_client_id" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->id->caption() ?><?php echo $kontak_client_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->id->cellAttributes() ?>>
<span id="el_kontak_client_id">
<span<?php echo $kontak_client_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kontak_client_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="kontak_client" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($kontak_client_edit->id->CurrentValue) ?>">
<?php echo $kontak_client_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->id_kontak->Visible) { // id_kontak ?>
	<div id="r_id_kontak" class="form-group row">
		<label id="elh_kontak_client_id_kontak" for="x_id_kontak" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->id_kontak->caption() ?><?php echo $kontak_client_edit->id_kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->id_kontak->cellAttributes() ?>>
<span id="el_kontak_client_id_kontak">
<?php $kontak_client_edit->id_kontak->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kontak_client" data-field="x_id_kontak" data-value-separator="<?php echo $kontak_client_edit->id_kontak->displayValueSeparatorAttribute() ?>" id="x_id_kontak" name="x_id_kontak"<?php echo $kontak_client_edit->id_kontak->editAttributes() ?>>
			<?php echo $kontak_client_edit->id_kontak->selectOptionListHtml("x_id_kontak") ?>
		</select>
</div>
<?php echo $kontak_client_edit->id_kontak->Lookup->getParamTag($kontak_client_edit, "p_x_id_kontak") ?>
</span>
<?php echo $kontak_client_edit->id_kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_kontak_client_nama" for="x_nama" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->nama->caption() ?><?php echo $kontak_client_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->nama->cellAttributes() ?>>
<span id="el_kontak_client_nama">
<input type="text" data-table="kontak_client" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_client_edit->nama->getPlaceHolder()) ?>" value="<?php echo $kontak_client_edit->nama->EditValue ?>"<?php echo $kontak_client_edit->nama->editAttributes() ?>>
</span>
<?php echo $kontak_client_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->no_hp->Visible) { // no_hp ?>
	<div id="r_no_hp" class="form-group row">
		<label id="elh_kontak_client_no_hp" for="x_no_hp" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->no_hp->caption() ?><?php echo $kontak_client_edit->no_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->no_hp->cellAttributes() ?>>
<span id="el_kontak_client_no_hp">
<input type="text" data-table="kontak_client" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_client_edit->no_hp->getPlaceHolder()) ?>" value="<?php echo $kontak_client_edit->no_hp->EditValue ?>"<?php echo $kontak_client_edit->no_hp->editAttributes() ?>>
</span>
<?php echo $kontak_client_edit->no_hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_kontak_client_gender" for="x_gender" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->gender->caption() ?><?php echo $kontak_client_edit->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->gender->cellAttributes() ?>>
<span id="el_kontak_client_gender">
<input type="text" data-table="kontak_client" data-field="x_gender" name="x_gender" id="x_gender" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_client_edit->gender->getPlaceHolder()) ?>" value="<?php echo $kontak_client_edit->gender->EditValue ?>"<?php echo $kontak_client_edit->gender->editAttributes() ?>>
</span>
<?php echo $kontak_client_edit->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->tgl_lahir->Visible) { // tgl_lahir ?>
	<div id="r_tgl_lahir" class="form-group row">
		<label id="elh_kontak_client_tgl_lahir" for="x_tgl_lahir" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->tgl_lahir->caption() ?><?php echo $kontak_client_edit->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->tgl_lahir->cellAttributes() ?>>
<span id="el_kontak_client_tgl_lahir">
<input type="text" data-table="kontak_client" data-field="x_tgl_lahir" name="x_tgl_lahir" id="x_tgl_lahir" maxlength="10" placeholder="<?php echo HtmlEncode($kontak_client_edit->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $kontak_client_edit->tgl_lahir->EditValue ?>"<?php echo $kontak_client_edit->tgl_lahir->editAttributes() ?>>
<?php if (!$kontak_client_edit->tgl_lahir->ReadOnly && !$kontak_client_edit->tgl_lahir->Disabled && !isset($kontak_client_edit->tgl_lahir->EditAttrs["readonly"]) && !isset($kontak_client_edit->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkontak_clientedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fkontak_clientedit", "x_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kontak_client_edit->tgl_lahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_client_edit->tgl_kenal->Visible) { // tgl_kenal ?>
	<div id="r_tgl_kenal" class="form-group row">
		<label id="elh_kontak_client_tgl_kenal" for="x_tgl_kenal" class="<?php echo $kontak_client_edit->LeftColumnClass ?>"><?php echo $kontak_client_edit->tgl_kenal->caption() ?><?php echo $kontak_client_edit->tgl_kenal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_client_edit->RightColumnClass ?>"><div <?php echo $kontak_client_edit->tgl_kenal->cellAttributes() ?>>
<span id="el_kontak_client_tgl_kenal">
<input type="text" data-table="kontak_client" data-field="x_tgl_kenal" name="x_tgl_kenal" id="x_tgl_kenal" maxlength="10" placeholder="<?php echo HtmlEncode($kontak_client_edit->tgl_kenal->getPlaceHolder()) ?>" value="<?php echo $kontak_client_edit->tgl_kenal->EditValue ?>"<?php echo $kontak_client_edit->tgl_kenal->editAttributes() ?>>
<?php if (!$kontak_client_edit->tgl_kenal->ReadOnly && !$kontak_client_edit->tgl_kenal->Disabled && !isset($kontak_client_edit->tgl_kenal->EditAttrs["readonly"]) && !isset($kontak_client_edit->tgl_kenal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkontak_clientedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fkontak_clientedit", "x_tgl_kenal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kontak_client_edit->tgl_kenal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kontak_client_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kontak_client_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_client_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kontak_client_edit->showPageFooter();
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
$kontak_client_edit->terminate();
?>