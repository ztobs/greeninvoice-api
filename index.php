<?php

require_once 'receipt.php';

$arr = array();
$arr['token'] = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
$arr['language'] = filter_input(INPUT_GET, 'language', FILTER_SANITIZE_STRING);
$arr['last_name'] = filter_input(INPUT_GET, 'last_name', FILTER_SANITIZE_STRING);
$arr['first_name'] = filter_input(INPUT_GET, 'first_name', FILTER_SANITIZE_STRING);
$arr['order'] = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING);
$arr['address'] = filter_input(INPUT_GET, 'address', FILTER_SANITIZE_STRING);
$arr['city'] = filter_input(INPUT_GET, 'city', FILTER_SANITIZE_STRING);
$arr['pob'] = filter_input(INPUT_GET, 'pob', FILTER_SANITIZE_STRING);
$arr['zipcode'] = filter_input(INPUT_GET, 'zipcode', FILTER_SANITIZE_STRING);
$arr['phone_area_code'] = filter_input(INPUT_GET, 'phone_area_code', FILTER_SANITIZE_STRING);
$arr['phone_number'] = filter_input(INPUT_GET, 'phone_number', FILTER_SANITIZE_STRING);
$arr['fax_number'] = filter_input(INPUT_GET, 'fax_number', FILTER_SANITIZE_STRING);
$arr['email'] = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
$arr['id_number'] = filter_input(INPUT_GET, 'id_number', FILTER_SANITIZE_NUMBER_INT);
$arr['vat_number'] = filter_input(INPUT_GET, 'vat_number', FILTER_SANITIZE_NUMBER_INT);
$arr['agent_id'] = filter_input(INPUT_GET, 'agent_id', FILTER_SANITIZE_NUMBER_INT);
$arr['project_id'] = filter_input(INPUT_GET, 'project_id', FILTER_SANITIZE_NUMBER_INT);
$arr['paying_customer_id'] = filter_input(INPUT_GET, 'paying_customer_id', FILTER_SANITIZE_NUMBER_INT);
$arr['pricelist_id'] = filter_input(INPUT_GET, 'pricelist_id', FILTER_SANITIZE_NUMBER_INT);
$arr['comments'] = filter_input(INPUT_GET, 'comments', FILTER_SANITIZE_STRING);
$arr['customer_type'] = filter_input(INPUT_GET, 'customer_type', FILTER_SANITIZE_NUMBER_INT);
$arr['pal_code'] = filter_input(INPUT_GET, 'pal_code', FILTER_SANITIZE_NUMBER_INT);
$arr['include_vat'] = filter_input(INPUT_GET, 'include_vat', FILTER_SANITIZE_NUMBER_INT);
$arr['document_type'] = filter_input(INPUT_GET, 'document_type', FILTER_SANITIZE_NUMBER_INT);
if(is_array($_GET['catalog_number'])) {
    $arr['catalog_number'] = array();
    foreach ($_GET['catalog_number'] as $k => $cat) {
        $arr['catalog_number'][$k] = $cat;
    }
}
if(is_array($_GET['quantity'])) {
    $arr['quantity'] = array();
    foreach ($_GET['quantity'] as $k => $cat) {
        $arr['quantity'][$k] = $cat;
    }
}
if(is_array($_GET['price_nis'])) {
    $arr['price_nis'] = array();
    foreach ($_GET['price_nis'] as $k => $cat) {
        $arr['price_nis'][$k] = $cat;
    }
}
if(is_array($_GET['description'])) {
    $arr['description'] = array();
    foreach ($_GET['description'] as $k => $cat) {
        $arr['description'][$k] = $cat;
    }
}

if(is_array($_GET['payment_type'])) {
    $arr['payment_type'] = array();
    foreach ($_GET['payment_type'] as $k => $cat) {
        $arr['payment_type'][$k] = $cat;
        $arr['amount_nis'][$k] = $_GET['amount_nis'][$k];
        if($cat == 1){
            $arr['bank_account_number'][$k] = $_GET['bank_account_number'][$k];
            $arr['bank_code'][$k] = $_GET['bank_code'][$k];
            $arr['check_number'][$k] = $_GET['check_number'][$k];
            $arr['branch_number'][$k] = $_GET['branch_number'][$k];
        }
    }
}

$res = new receipt();
$a = $res->createReceipt($arr);
//echo '<script>window.location = "'. $result_json->data->document_link .'";</script>';
//print_r($a->data->document_link);
//http://localhost/rivhit/?
//token=decd03e5-e35c-41e8-84f7-fba2fb483928
//&first_name=dffdf
//&last_name=%D7%A2%D7%99%D7%A2%D7%9B%D7%A2%D7%99
//&address=hbhb
//&city=tel%20aviv
//&phone=0502002921
//&comments=dsf%20fasfas%20sfsdfds%20asfsdf
//&email=ruartel@gmail.com
//&include_vat=1


#####
# http://localhost/rivhit/?token=decd03e5-e35c-41e8-84f7-fba2fb483928&first_name=dffdf&last_name=%D7%A2%D7%99%D7%A2%D7%9B%D7%A2%D7%99&address=hbhb&city=tel%20aviv&phone=0502002921&comments=dsf%20fasfas%20sfsdfds%20asfsdf&email=ruartel@gmail.com&include_vat=1&itemsQ=2&catalog_number[]=SKU11&catalog_number[]=SKU22&quantity[]=1&quantity[]=3&price_nis[]=12&price_nis[]=55&description[]=hhh%20hh%20%20h&description[]=lklkl%20lkkk%20koo&payment_type[]=6&payment_type[]=2&amount_nis[]=12&amount_nis[]=165&document_type=2
#####