<?php
header("Access-Control-Allow-Origin: *");

define('SHOPIFY_DOMAIN', 'order-sample.myshopify.com');
define('SHOPIFY_API_KEY', '12bc2c160cb389b0fcffc441bd6574dd');
define('SHOPIFY_API_PASS', '6dbc938ee1474b30cb54cc401336a6b4');
define('SHOPIFY_SECRET', '21fe9f5d3ddc62e02c54b0d66090be4a');

require 'shopifyclient.php';
$resp = array();
$sc = new ShopifyClient(SHOPIFY_DOMAIN, SHOPIFY_API_PASS, SHOPIFY_API_KEY, SHOPIFY_SECRET);
$action = $_POST['action'];
if ($action == "get_style") {
	$chk_box = $_POST['chk_box'];
	$ord_id = $_POST['ord_id'];
	try{ 
		$resp_ord = $sc->call("GET", "/admin/api/2019-04/orders/{$ord_id}.json?fields=tags");
		$tags=$resp_ord['tags'].",Send_Reminder";
		$orders = array(
	                "order" => array(
	                    "id" => $ord_id,
	                    "tags" => $tags
	                )
	            );
		$resp_ord = $sc->call("PUT", "/admin/api/2019-04/orders/{$ord_id}.json", $orders);
		$resp['status']='success'; 
 	} catch (ShopifyApiException $e) {
        $resp['status']='false';
        $resp['msg']='Error: Try again Or contact Developer';
    } 
    echo json_encode($resp);
}	
?>