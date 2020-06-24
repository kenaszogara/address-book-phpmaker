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
$user_add = new user_add();

// Run the page
$user_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuseradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuseradd = currentForm = new ew.Form("fuseradd", "add");

	// Validate form
	fuseradd.validate = function() {
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
			<?php if ($user_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->pid->caption(), $user_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($user_add->pid->errorMessage()) ?>");
			<?php if ($user_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->username->caption(), $user_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->password->caption(), $user_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->userlevel->caption(), $user_add->userlevel->RequiredErrorMessage)) ?>");
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
	fuseradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuseradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuseradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_add->showPageHeader(); ?>
<?php
$user_add->showMessage();
?>
<form name="fuseradd" id="fuseradd" class="<?php echo $user_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$user_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($user_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_user_pid" for="x_pid" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->pid->caption() ?><?php echo $user_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->pid->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_user_pid">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_pid" data-value-separator="<?php echo $user_add->pid->displayValueSeparatorAttribute() ?>" id="x_pid" name="x_pid"<?php echo $user_add->pid->editAttributes() ?>>
			<?php echo $user_add->pid->selectOptionListHtml("x_pid") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_user_pid">
<input type="text" data-table="user" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($user_add->pid->getPlaceHolder()) ?>" value="<?php echo $user_add->pid->EditValue ?>"<?php echo $user_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $user_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->username->caption() ?><?php echo $user_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->username->cellAttributes() ?>>
<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_add->username->getPlaceHolder()) ?>" value="<?php echo $user_add->username->EditValue ?>"<?php echo $user_add->username->editAttributes() ?>>
</span>
<?php echo $user_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_password" for="x_password" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->password->caption() ?><?php echo $user_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->password->cellAttributes() ?>>
<span id="el_user_password">
<input type="text" data-table="user" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_add->password->getPlaceHolder()) ?>" value="<?php echo $user_add->password->EditValue ?>"<?php echo $user_add->password->editAttributes() ?>>
</span>
<?php echo $user_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label id="elh_user_userlevel" for="x_userlevel" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->userlevel->caption() ?><?php echo $user_add->userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->userlevel->cellAttributes() ?>>
<span id="el_user_userlevel">
<input type="text" data-table="user" data-field="x_userlevel" name="x_userlevel" id="x_userlevel" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($user_add->userlevel->getPlaceHolder()) ?>" value="<?php echo $user_add->userlevel->EditValue ?>"<?php echo $user_add->userlevel->editAttributes() ?>>
</span>
<?php echo $user_add->userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_add->showPageFooter();
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
$user_add->terminate();
?>