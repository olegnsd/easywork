<?php

//$api_auth_key = $_REQUEST[''];

header('Content-Type: text/html; charset=utf-8');
session_start();
ini_set('display_errors',0);

$api_url = 'http://tt.erp2crm.ru/services/deals_import/';
$api_auth_key = 'LMIHI4pRVMFRiLFLsrrAIrETG0p6LAYmdxV';
$api_login = 'api';

$get_name=$_POST['name'];
$get_email=$_POST['email'];
$get_phone=$_POST['phone'];
$get_user_id=10;

$str=strpos($get_phone, "+");
$get_phone = substr($get_phone, $str);

function send_command_server($server_url, $server_command)
{
    $data_string = http_build_query($server_command);

    $ch = curl_init($server_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $json = curl_exec($ch);
    $result = json_decode($json, true);

    curl_close($ch);

    if (count($result)) {
        return $result;
    } else {
        return $json;
    }
}

function auth($auth_key, $login) {
    global $api_url;
    $command_auth_request = array(
        "v" => "1.0",
        "login" => $login
    );
    $result_auth_request = send_command_server($api_url . 'auth_request.php', $command_auth_request);

    $command_auth_auth = array(
        "v" => "1.0",
        "login" => $login,
        "hash" => md5($result_auth_request["salt"] . $auth_key)
    );
    $result_auth_auth = send_command_server($api_url . 'auth_auth.php', $command_auth_auth);

    if(!$result_auth_auth['access_id']) {
        exit();
    }


    $access_id = $result_auth_auth["access_id"];
    $_SESSION['access_id'] = $access_id;

    return $access_id;
}

$access_id = auth($api_auth_key, $api_login);

//$get_phone = '+1111111111';
//$get_name = 'Сделка';
//$get_email = 'ssfs@sdsd.ru';

$command_add =  array(
    "access_id" => $access_id,
    "table_id" => $table_id,
    "cals" => true,
    "data" => array("line" => array(
        "product" => "чат-бот",
        "ref" => "Миелофон",
        "phone" =>$get_phone,
        "name" => $get_name,
        "email" =>$get_email,
        'user_id' => $get_user_id)
    )
);
$command_add= send_command_server($api_url . 'deal_create.php', $command_add);

?>
<?php
exit();
$get_time = date("d.m.Y (H:i:s)", time());
$get_time_name = date("d.m.Y-H:i:s", time());
$get_ip = getenv("REMOTE_ADDR");
$get_browser = getenv("HTTP_USER_AGENT");
$get_port = getenv("REMOTE_PORT");
$get_connect = $_SERVER['HTTP_CONNECTION'];
$get_host = gethostbyaddr(getenv("REMOTE_ADDR"));
$get_referer = @$_SERVER['HTTP_REFERER'];
$s_name=$_SERVER['SERVER_NAME'];
$s_ip=$_SERVER['SERVER_ADDR'];
$s_port=$_SERVER['SERVER_PORT'];
$s_web=$_SERVER['SERVER_SOFTWARE'];
$s_p=$_SERVER['SERVER_PROTOCOL'];
$s_get= $_SERVER['QUERY_STRING'];
echo 2;
$fopen = fopen ("in.txt", "a+");
fputs ($fopen, " ---------- Detected at $get_time-------------- "."\n");
fputs ($fopen, "IP: $get_ip "."\n");
fputs ($fopen, "Browser: $get_browser " ."\n");
fputs ($fopen, "Port: $get_port "."\n");
fputs ($fopen, "Host: $get_host "."\n");
fputs ($fopen, "Connection: $get_connect "."\n");
fputs ($fopen, "Referer: $get_referer "."\n");
fputs ($fopen, " ----------------------ServerInfo-------------------------- "."\n");
fputs ($fopen, "ServerName: $s_name "."\n");
fputs ($fopen, "ServerAdres: $s_ip " ."\n");
fputs ($fopen, "ServerPort: $s_port "."\n");
fputs ($fopen, "WebServer: $s_web "."\n");
fputs ($fopen, "ServerHttpProtocol: $s_p "."\n");
fputs ($fopen, "ServerGet: $s_get "."\n");
fputs ($fopen, " ----------------------VarDumpServer-------------------------- "."\n");
foreach($_SERVER as $k=>$v) {
    fputs ($fopen, "$k: $v"."\n");
}
fputs ($fopen, " ----------------------------------------------------------- "."\n"."\n");
fclose ($fopen);
?>
