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
$user_edit = new user_edit();

// Run the page
$user_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuseredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fuseredit = currentForm = new ew.Form("fuseredit", "edit");

	// Validate form
	fuseredit.validate = function() {
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
			<?php if ($user_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->id->caption(), $user_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->pid->caption(), $user_edit->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($user_edit->pid->errorMessage()) ?>");
			<?php if ($user_edit->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->username->caption(), $user_edit->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->password->caption(), $user_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->userlevel->caption(), $user_edit->userlevel->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fuseredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuseredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuseredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_edit->showPageHeader(); ?>
<?php
$user_edit->showMessage();
?>
<form name="fuseredit" id="fuseredit" class="<?php echo $user_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$user_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($user_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_user_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->id->caption() ?><?php echo $user_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->id->cellAttributes() ?>>
<span id="el_user_id">
<span<?php echo $user_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($user_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($user_edit->id->CurrentValue) ?>">
<?php echo $user_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_user_pid" for="x_pid" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->pid->caption() ?><?php echo $user_edit->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->pid->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<?php if (SameString($user->id->CurrentValue, CurrentUserID())) { ?>
	<span id="el_user_pid">
	<span<?php echo $user_edit->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($user_edit->pid->EditValue)) ?>"></span>
	</span>
<input type="hidden" data-table="user" data-field="x_pid" name="x_pid" id="x_pid" value="<?php echo HtmlEncode($user_edit->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_user_pid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_pid" data-value-separator="<?php echo $user_edit->pid->displayValueSeparatorAttribute() ?>" id="x_pid" name="x_pid"<?php echo $user_edit->pid->editAttributes() ?>>
			<?php echo $user_edit->pid->selectOptionListHtml("x_pid") ?>
		</select>
</div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_user_pid">
<input type="text" data-table="user" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($user_edit->pid->getPlaceHolder()) ?>" value="<?php echo $user_edit->pid->EditValue ?>"<?php echo $user_edit->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $user_edit->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->username->caption() ?><?php echo $user_edit->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->username->cellAttributes() ?>>
<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->username->getPlaceHolder()) ?>" value="<?php echo $user_edit->username->EditValue ?>"<?php echo $user_edit->username->editAttributes() ?>>
</span>
<?php echo $user_edit->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_password" for="x_password" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->password->caption() ?><?php echo $user_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->password->cellAttributes() ?>>
<span id="el_user_password">
<input type="text" data-table="user" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->password->getPlaceHolder()) ?>" value="<?php echo $user_edit->password->EditValue ?>"<?php echo $user_edit->password->editAttributes() ?>>
</span>
<?php echo $user_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label id="elh_user_userlevel" for="x_userlevel" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->userlevel->caption() ?><?php echo $user_edit->userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->userlevel->cellAttributes() ?>>
<span id="el_user_userlevel">
<input type="text" data-table="user" data-field="x_userlevel" name="x_userlevel" id="x_userlevel" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_edit->userlevel->getPlaceHolder()) ?>" value="<?php echo $user_edit->userlevel->EditValue ?>"<?php echo $user_edit->userlevel->editAttributes() ?>>
</span>
<?php echo $user_edit->userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_edit->showPageFooter();
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
$user_edit->terminate();
?>