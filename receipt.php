<?php
/**
 * Created by PhpStorm.
 * User: ruartel
 * Date: 6/28/15
 * Time: 11:37 PM
 */

class receipt {

    private $token = '‫‪decd03e5-e35c-41e8-84f7-fba2fb483928‬‬‬‬';
    private $user = '‫‪demo‬‬';
    private $pass = '123‬‬';
    private $company_id = '123‬‬';

    public function createReceipt($arr)
    {
        $dataItem = array();
        if(isset($arr['catalog_number'])) {
            foreach ($arr['catalog_number'] as $k => $cat) {
                $dataItem[$k] = array();
                $dataItem[$k]['catalog_number'] = $cat;
            }
        }
        if(isset($arr['quantity'])) {
            foreach ($arr['quantity'] as $k => $cat) {
                $dataItem[$k]['quantity'] = $cat;
            }
        }
        if(isset($arr['price_nis'])) {
            foreach ($arr['price_nis'] as $k => $cat) {
                $dataItem[$k]['price_nis'] = $cat;
            }
        }
        if(isset($arr['description'])) {
            foreach ($arr['description'] as $k => $cat) {
                $dataItem[$k]['description'] = $cat;
            }
        }

        $payments = array();
        if(isset($arr['payment_type'])) {
            foreach ($arr['payment_type'] as $k => $cat) {
                $payments[$k] = array();
                $payments[$k]['payment_type'] = $cat;
                $payments[$k]['amount_nis'] = $arr['amount_nis'][$k];
            }
        }
        $data = array(
            "api_token" => $arr["token"],
            "document_type" => $arr["document_type"],
            "customer_id" => 0,
            "last_name" => $arr["first_name"],
            "first_name" => $arr["last_name"],
            "address" => $arr['address'],
            "city" => $arr['city'],
            "phone" => $arr['phone_number'],
            "order" => $arr['order'],
            "comments" => $arr['comments'],
            "email_to" => $arr['email'],
            "language" => $arr['language'],
            "price_include_vat" => $arr['include_vat'],
            "items" => $dataItem,
            "payments" => $payments
        );
//
//        print_r($data);


        $url = "https://api.rivhit.co.il/online/RivhitOnlineAPI.svc/Document.New";
        $post = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        curl_close($ch);

        $result_json = json_decode($result);
        $status = $result_json->error_code;
//        return $result_json;
//print_r($result);
//        die();
//        echo 'AAAAAAAAAAAAAAAA';
        if ($status == 0){
            $resp = array();
            $resp[0] = $result_json->data->document_identity;
            $resp[1] = $result_json->data->document_link;

            echo json_encode($resp);
//            echo '<script>window.location = "'. $result_json->data->document_link .'";</script>';
//            return $result_json;
        }else {
            echo $result_json->client_message;
            echo '</br> FAILED';
//            return $result_json->client_message;
        }
    }



}