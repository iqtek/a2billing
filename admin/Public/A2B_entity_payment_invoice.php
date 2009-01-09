<?php
include ("../lib/admin.defines.php");
include ("../lib/admin.module.access.php");
include ("../lib/Form/Class.FormHandler.inc.php");
include ("./form_data/FG_var_payment_invoice.inc");
include ("../lib/admin.smarty.php");

if (! has_rights (ACX_INVOICING)){ 
	   Header ("HTTP/1.0 401 Unauthorized");
	   Header ("Location: PP_error.php?c=accessdenied");	   
	   die();	   
}

/***********************************************************************************/

$HD_Form -> setDBHandler (DbConnect());

$HD_Form -> init();

if (!isset($form_action))  $form_action="list"; //ask-add
if (!isset($action)) $action = $form_action;


$list = $HD_Form -> perform_action($form_action);

// #### HEADER SECTION
$smarty->display('main.tpl');

if ($popup_select) {
?>
<SCRIPT LANGUAGE="javascript">
<!-- Begin
function sendValue(selvalue){
	 // redirect browser to the grabbed value (hopefully a URL)	  
	window.opener.location.href= "A2B_invoice_manage_payment?id=17&addpayment="+selvalue;
	self.location.href = "<?php echo $_SERVER['PHP_SELF']."?popup_select=1&invoice=$invoice&card=$card"?>";
}
// End -->
</script>
<?php
}
// #### TOP SECTION PAGE
$HD_Form -> create_toppage ($form_action);

// #### CREATE FORM OR LIST
//$HD_Form -> CV_TOPVIEWER = "menu";
if (strlen($_GET["menu"])>0) $_SESSION["menu"] = $_GET["menu"];

$HD_Form -> create_form ($form_action, $list, $id=null) ;

// #### FOOTER SECTION
$smarty->display('footer.tpl');


?>