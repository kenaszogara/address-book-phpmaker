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
$jurnal_edit = new jurnal_edit();

// Run the page
$jurnal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjurnaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjurnaledit = currentForm = new ew.Form("fjurnaledit", "edit");

	// Validate form
	fjurnaledit.validate = function() {
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
			<?php if ($jurnal_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->id->caption(), $jurnal_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_edit->id_kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->id_kontak->caption(), $jurnal_edit->id_kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_edit->item->Required) { ?>
				elm = this.getElements("x" + infix + "_item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->item->caption(), $jurnal_edit->item->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_edit->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->qty->caption(), $jurnal_edit->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_edit->qty->errorMessage()) ?>");
			<?php if ($jurnal_edit->memo->Required) { ?>
				elm = this.getElements("x" + infix + "_memo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->memo->caption(), $jurnal_edit->memo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->tgl->caption(), $jurnal_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_edit->tgl->errorMessage()) ?>");

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
	fjurnaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjurnaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjurnaledit.lists["x_id_kontak"] = <?php echo $jurnal_edit->id_kontak->Lookup->toClientList($jurnal_edit) ?>;
	fjurnaledit.lists["x_id_kontak"].options = <?php echo JsonEncode($jurnal_edit->id_kontak->lookupOptions()) ?>;
	loadjs.done("fjurnaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jurnal_edit->showPageHeader(); ?>
<?php
$jurnal_edit->showMessage();
?>
<form name="fjurnaledit" id="fjurnaledit" class="<?php echo $jurnal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jurnal_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_jurnal_id" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->id->caption() ?><?php echo $jurnal_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->id->cellAttributes() ?>>
<span id="el_jurnal_id">
<span<?php echo $jurnal_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jurnal_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jurnal" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($jurnal_edit->id->CurrentValue) ?>">
<?php echo $jurnal_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->id_kontak->Visible) { // id_kontak ?>
	<div id="r_id_kontak" class="form-group row">
		<label id="elh_jurnal_id_kontak" for="x_id_kontak" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->id_kontak->caption() ?><?php echo $jurnal_edit->id_kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->id_kontak->cellAttributes() ?>>
<span id="el_jurnal_id_kontak">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_kontak"><?php echo EmptyValue(strval($jurnal_edit->id_kontak->ViewValue)) ? $Language->phrase("PleaseSelect") : $jurnal_edit->id_kontak->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jurnal_edit->id_kontak->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jurnal_edit->id_kontak->ReadOnly || $jurnal_edit->id_kontak->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_kontak',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jurnal_edit->id_kontak->Lookup->getParamTag($jurnal_edit, "p_x_id_kontak") ?>
<input type="hidden" data-table="jurnal" data-field="x_id_kontak" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jurnal_edit->id_kontak->displayValueSeparatorAttribute() ?>" name="x_id_kontak" id="x_id_kontak" value="<?php echo $jurnal_edit->id_kontak->CurrentValue ?>"<?php echo $jurnal_edit->id_kontak->editAttributes() ?>>
</span>
<?php echo $jurnal_edit->id_kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->item->Visible) { // item ?>
	<div id="r_item" class="form-group row">
		<label id="elh_jurnal_item" for="x_item" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->item->caption() ?><?php echo $jurnal_edit->item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->item->cellAttributes() ?>>
<span id="el_jurnal_item">
<input type="text" data-table="jurnal" data-field="x_item" name="x_item" id="x_item" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jurnal_edit->item->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->item->EditValue ?>"<?php echo $jurnal_edit->item->editAttributes() ?>>
</span>
<?php echo $jurnal_edit->item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_jurnal_qty" for="x_qty" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->qty->caption() ?><?php echo $jurnal_edit->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->qty->cellAttributes() ?>>
<span id="el_jurnal_qty">
<input type="text" data-table="jurnal" data-field="x_qty" name="x_qty" id="x_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jurnal_edit->qty->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->qty->EditValue ?>"<?php echo $jurnal_edit->qty->editAttributes() ?>>
</span>
<?php echo $jurnal_edit->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_jurnal_memo" for="x_memo" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->memo->caption() ?><?php echo $jurnal_edit->memo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->memo->cellAttributes() ?>>
<span id="el_jurnal_memo">
<input type="text" data-table="jurnal" data-field="x_memo" name="x_memo" id="x_memo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jurnal_edit->memo->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->memo->EditValue ?>"<?php echo $jurnal_edit->memo->editAttributes() ?>>
</span>
<?php echo $jurnal_edit->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_jurnal_tgl" for="x_tgl" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->tgl->caption() ?><?php echo $jurnal_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->tgl->cellAttributes() ?>>
<span id="el_jurnal_tgl">
<input type="text" data-table="jurnal" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($jurnal_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->tgl->EditValue ?>"<?php echo $jurnal_edit->tgl->editAttributes() ?>>
<?php if (!$jurnal_edit->tgl->ReadOnly && !$jurnal_edit->tgl->Disabled && !isset($jurnal_edit->tgl->EditAttrs["readonly"]) && !isset($jurnal_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjurnaledit", "datetimepicker"], function() {
	ew.createDateTimePicker("fjurnaledit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jurnal_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jurnal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jurnal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jurnal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jurnal_edit->showPageFooter();
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
$jurnal_edit->terminate();
?>