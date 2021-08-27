<?php
class Share extends CI_Controller
{
public function __construct()
{
    parent::__construct();

}
public function index()
{
$my_apikey = "ODOFC8439AIIQNSMBL4N";
$destination = "+6281261382847";
$message = "Ayo Beli Produk Ini";
$api_url = "http://panel.rapiwha.com/send_message.php";
$api_url .= "?apikey=". urlencode ($my_apikey);
$api_url .= "&number=". urlencode ($destination);
$api_url .= "&text=". urlencode ($message);
$my_result_object = json_decode(file_get_contents($api_url, false));
}
}