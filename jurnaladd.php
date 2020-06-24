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
$jurnal_add = new jurnal_add();

// Run the page
$jurnal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjurnaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fjurnaladd = currentForm = new ew.Form("fjurnaladd", "add");

	// Validate form
	fjurnaladd.validate = function() {
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
			<?php if ($jurnal_add->id_kontak->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kontak");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->id_kontak->caption(), $jurnal_add->id_kontak->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_add->item->Required) { ?>
				elm = this.getElements("x" + infix + "_item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->item->caption(), $jurnal_add->item->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_add->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->qty->caption(), $jurnal_add->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_add->qty->errorMessage()) ?>");
			<?php if ($jurnal_add->memo->Required) { ?>
				elm = this.getElements("x" + infix + "_memo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->memo->caption(), $jurnal_add->memo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->tgl->caption(), $jurnal_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_add->tgl->errorMessage()) ?>");

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
	fjurnaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjurnaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjurnaladd.lists["x_id_kontak"] = <?php echo $jurnal_add->id_kontak->Lookup->toClientList($jurnal_add) ?>;
	fjurnaladd.lists["x_id_kontak"].options = <?php echo JsonEncode($jurnal_add->id_kontak->lookupOptions()) ?>;
	loadjs.done("fjurnaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jurnal_add->showPageHeader(); ?>
<?php
$jurnal_add->showMessage();
?>
<form name="fjurnaladd" id="fjurnaladd" class="<?php echo $jurnal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($jurnal_add->id_kontak->Visible) { // id_kontak ?>
	<div id="r_id_kontak" class="form-group row">
		<label id="elh_jurnal_id_kontak" for="x_id_kontak" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->id_kontak->caption() ?><?php echo $jurnal_add->id_kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->id_kontak->cellAttributes() ?>>
<span id="el_jurnal_id_kontak">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_kontak"><?php echo EmptyValue(strval($jurnal_add->id_kontak->ViewValue)) ? $Language->phrase("PleaseSelect") : $jurnal_add->id_kontak->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jurnal_add->id_kontak->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jurnal_add->id_kontak->ReadOnly || $jurnal_add->id_kontak->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_kontak',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jurnal_add->id_kontak->Lookup->getParamTag($jurnal_add, "p_x_id_kontak") ?>
<input type="hidden" data-table="jurnal" data-field="x_id_kontak" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jurnal_add->id_kontak->displayValueSeparatorAttribute() ?>" name="x_id_kontak" id="x_id_kontak" value="<?php echo $jurnal_add->id_kontak->CurrentValue ?>"<?php echo $jurnal_add->id_kontak->editAttributes() ?>>
</span>
<?php echo $jurnal_add->id_kontak->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_add->item->Visible) { // item ?>
	<div id="r_item" class="form-group row">
		<label id="elh_jurnal_item" for="x_item" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->item->caption() ?><?php echo $jurnal_add->item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->item->cellAttributes() ?>>
<span id="el_jurnal_item">
<input type="text" data-table="jurnal" data-field="x_item" name="x_item" id="x_item" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jurnal_add->item->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->item->EditValue ?>"<?php echo $jurnal_add->item->editAttributes() ?>>
</span>
<?php echo $jurnal_add->item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_add->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_jurnal_qty" for="x_qty" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->qty->caption() ?><?php echo $jurnal_add->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->qty->cellAttributes() ?>>
<span id="el_jurnal_qty">
<input type="text" data-table="jurnal" data-field="x_qty" name="x_qty" id="x_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jurnal_add->qty->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->qty->EditValue ?>"<?php echo $jurnal_add->qty->editAttributes() ?>>
</span>
<?php echo $jurnal_add->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_add->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_jurnal_memo" for="x_memo" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->memo->caption() ?><?php echo $jurnal_add->memo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->memo->cellAttributes() ?>>
<span id="el_jurnal_memo">
<input type="text" data-table="jurnal" data-field="x_memo" name="x_memo" id="x_memo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jurnal_add->memo->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->memo->EditValue ?>"<?php echo $jurnal_add->memo->editAttributes() ?>>
</span>
<?php echo $jurnal_add->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_jurnal_tgl" for="x_tgl" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->tgl->caption() ?><?php echo $jurnal_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->tgl->cellAttributes() ?>>
<span id="el_jurnal_tgl">
<input type="text" data-table="jurnal" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($jurnal_add->tgl->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->tgl->EditValue ?>"<?php echo $jurnal_add->tgl->editAttributes() ?>>
<?php if (!$jurnal_add->tgl->ReadOnly && !$jurnal_add->tgl->Disabled && !isset($jurnal_add->tgl->EditAttrs["readonly"]) && !isset($jurnal_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjurnaladd", "datetimepicker"], function() {
	ew.createDateTimePicker("fjurnaladd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jurnal_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jurnal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jurnal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jurnal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jurnal_add->showPageFooter();
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
$jurnal_add->terminate();
?>