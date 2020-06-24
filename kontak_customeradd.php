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
$kontak_customer_add = new kontak_customer_add();

// Run the page
$kontak_customer_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_customer_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkontak_customeradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fkontak_customeradd = currentForm = new ew.Form("fkontak_customeradd", "add");

	// Validate form
	fkontak_customeradd.validate = function() {
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
			<?php if ($kontak_customer_add->id_kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->id_kontak->caption(), $kontak_customer_add->id_kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->id_nuskin->Required) { ?>
				elm = this.getElements("x" + infix + "_id_nuskin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->id_nuskin->caption(), $kontak_customer_add->id_nuskin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->nama->caption(), $kontak_customer_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->no_hp->Required) { ?>
				elm = this.getElements("x" + infix + "_no_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->no_hp->caption(), $kontak_customer_add->no_hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->_email->caption(), $kontak_customer_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->gender->Required) { ?>
				elm = this.getElements("x" + infix + "_gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->gender->caption(), $kontak_customer_add->gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kontak_customer_add->tgl_lahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->tgl_lahir->caption(), $kontak_customer_add->tgl_lahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kontak_customer_add->tgl_lahir->errorMessage()) ?>");
			<?php if ($kontak_customer_add->tgl_kenal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_kenal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kontak_customer_add->tgl_kenal->caption(), $kontak_customer_add->tgl_kenal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_kenal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kontak_customer_add->tgl_kenal->errorMessage()) ?>");

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
	fkontak_customeradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkontak_customeradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkontak_customeradd.lists["x_id_kontak"] = <?php echo $kontak_customer_add->id_kontak->Lookup->toClientList($kontak_customer_add) ?>;
	fkontak_customeradd.lists["x_id_kontak"].options = <?php echo JsonEncode($kontak_customer_add->id_kontak->lookupOptions()) ?>;
	fkontak_customeradd.lists["x_gender"] = <?php echo $kontak_customer_add->gender->Lookup->toClientList($kontak_customer_add) ?>;
	fkontak_customeradd.lists["x_gender"].options = <?php echo JsonEncode($kontak_customer_add->gender->options(FALSE, TRUE)) ?>;
	loadjs.done("fkontak_customeradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kontak_customer_add->showPageHeader(); ?>
<?php
$kontak_customer_add->showMessage();
?>
<form name="fkontak_customeradd" id="fkontak_customeradd" class="<?php echo $kontak_customer_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak_customer">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$kontak_customer_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($kontak_customer_add->id_kontak->Visible) { // id_kontak ?>
	<div id="r_id_kontak" class="form-group row">
		<label id="elh_kontak_customer_id_kontak" for="x_id_kontak" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->id_kontak->caption() ?><?php echo $kontak_customer_add->id_kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->id_kontak->cellAttributes() ?>>
<span id="el_kontak_customer_id_kontak">
<?php $kontak_customer_add->id_kontak->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_kontak"><?php echo EmptyValue(strval($kontak_customer_add->id_kontak->ViewValue)) ? $Language->phrase("PleaseSelect") : $kontak_customer_add->id_kontak->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kontak_customer_add->id_kontak->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($kontak_customer_add->id_kontak->ReadOnly || $kontak_customer_add->id_kontak->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_kontak',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $kontak_customer_add->id_kontak->Lookup->getParamTag($kontak_customer_add, "p_x_id_kontak") ?>
<input type="hidden" data-table="kontak_customer" data-field="x_id_kontak" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kontak_customer_add->id_kontak->displayValueSeparatorAttribute() ?>" name="x_id_kontak" id="x_id_kontak" value="<?php echo $kontak_customer_add->id_kontak->CurrentValue ?>"<?php echo $kontak_customer_add->id_kontak->editAttributes() ?>>
</span>
<?php echo $kontak_customer_add->id_kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->id_nuskin->Visible) { // id_nuskin ?>
	<div id="r_id_nuskin" class="form-group row">
		<label id="elh_kontak_customer_id_nuskin" for="x_id_nuskin" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->id_nuskin->caption() ?><?php echo $kontak_customer_add->id_nuskin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->id_nuskin->cellAttributes() ?>>
<span id="el_kontak_customer_id_nuskin">
<input type="text" data-table="kontak_customer" data-field="x_id_nuskin" name="x_id_nuskin" id="x_id_nuskin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_customer_add->id_nuskin->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->id_nuskin->EditValue ?>"<?php echo $kontak_customer_add->id_nuskin->editAttributes() ?>>
</span>
<?php echo $kontak_customer_add->id_nuskin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_kontak_customer_nama" for="x_nama" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->nama->caption() ?><?php echo $kontak_customer_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->nama->cellAttributes() ?>>
<span id="el_kontak_customer_nama">
<input type="text" data-table="kontak_customer" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_customer_add->nama->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->nama->EditValue ?>"<?php echo $kontak_customer_add->nama->editAttributes() ?>>
</span>
<?php echo $kontak_customer_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->no_hp->Visible) { // no_hp ?>
	<div id="r_no_hp" class="form-group row">
		<label id="elh_kontak_customer_no_hp" for="x_no_hp" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->no_hp->caption() ?><?php echo $kontak_customer_add->no_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->no_hp->cellAttributes() ?>>
<span id="el_kontak_customer_no_hp">
<input type="text" data-table="kontak_customer" data-field="x_no_hp" name="x_no_hp" id="x_no_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_customer_add->no_hp->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->no_hp->EditValue ?>"<?php echo $kontak_customer_add->no_hp->editAttributes() ?>>
</span>
<?php echo $kontak_customer_add->no_hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_kontak_customer__email" for="x__email" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->_email->caption() ?><?php echo $kontak_customer_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->_email->cellAttributes() ?>>
<span id="el_kontak_customer__email">
<input type="text" data-table="kontak_customer" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($kontak_customer_add->_email->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->_email->EditValue ?>"<?php echo $kontak_customer_add->_email->editAttributes() ?>>
</span>
<?php echo $kontak_customer_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_kontak_customer_gender" for="x_gender" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->gender->caption() ?><?php echo $kontak_customer_add->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->gender->cellAttributes() ?>>
<span id="el_kontak_customer_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kontak_customer" data-field="x_gender" data-value-separator="<?php echo $kontak_customer_add->gender->displayValueSeparatorAttribute() ?>" id="x_gender" name="x_gender"<?php echo $kontak_customer_add->gender->editAttributes() ?>>
			<?php echo $kontak_customer_add->gender->selectOptionListHtml("x_gender") ?>
		</select>
</div>
</span>
<?php echo $kontak_customer_add->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->tgl_lahir->Visible) { // tgl_lahir ?>
	<div id="r_tgl_lahir" class="form-group row">
		<label id="elh_kontak_customer_tgl_lahir" for="x_tgl_lahir" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->tgl_lahir->caption() ?><?php echo $kontak_customer_add->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->tgl_lahir->cellAttributes() ?>>
<span id="el_kontak_customer_tgl_lahir">
<input type="text" data-table="kontak_customer" data-field="x_tgl_lahir" name="x_tgl_lahir" id="x_tgl_lahir" maxlength="10" placeholder="<?php echo HtmlEncode($kontak_customer_add->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->tgl_lahir->EditValue ?>"<?php echo $kontak_customer_add->tgl_lahir->editAttributes() ?>>
<?php if (!$kontak_customer_add->tgl_lahir->ReadOnly && !$kontak_customer_add->tgl_lahir->Disabled && !isset($kontak_customer_add->tgl_lahir->EditAttrs["readonly"]) && !isset($kontak_customer_add->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkontak_customeradd", "datetimepicker"], function() {
	ew.createDateTimePicker("fkontak_customeradd", "x_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kontak_customer_add->tgl_lahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kontak_customer_add->tgl_kenal->Visible) { // tgl_kenal ?>
	<div id="r_tgl_kenal" class="form-group row">
		<label id="elh_kontak_customer_tgl_kenal" for="x_tgl_kenal" class="<?php echo $kontak_customer_add->LeftColumnClass ?>"><?php echo $kontak_customer_add->tgl_kenal->caption() ?><?php echo $kontak_customer_add->tgl_kenal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kontak_customer_add->RightColumnClass ?>"><div <?php echo $kontak_customer_add->tgl_kenal->cellAttributes() ?>>
<span id="el_kontak_customer_tgl_kenal">
<input type="text" data-table="kontak_customer" data-field="x_tgl_kenal" name="x_tgl_kenal" id="x_tgl_kenal" maxlength="10" placeholder="<?php echo HtmlEncode($kontak_customer_add->tgl_kenal->getPlaceHolder()) ?>" value="<?php echo $kontak_customer_add->tgl_kenal->EditValue ?>"<?php echo $kontak_customer_add->tgl_kenal->editAttributes() ?>>
<?php if (!$kontak_customer_add->tgl_kenal->ReadOnly && !$kontak_customer_add->tgl_kenal->Disabled && !isset($kontak_customer_add->tgl_kenal->EditAttrs["readonly"]) && !isset($kontak_customer_add->tgl_kenal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkontak_customeradd", "datetimepicker"], function() {
	ew.createDateTimePicker("fkontak_customeradd", "x_tgl_kenal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kontak_customer_add->tgl_kenal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kontak_customer_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kontak_customer_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kontak_customer_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kontak_customer_add->showPageFooter();
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
$kontak_customer_add->terminate();
?>