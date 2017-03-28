<?php
session_start();
require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';

$servername = "213.181.192.70";
$username = "napiforr_wp1";
$password = "Nietzsche001992";
$dbname = "napiforr_access_tokens";

$myfile = fopen("cucc.txt", "w") or die("Unable to open file!");

$token_tomb=array();

$db_handle = mysqli_connect($servername,$username,$password);
$database = $dbname;

$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {

    $SQL = "SELECT * FROM access_tokens_short";
    $result = mysqli_query($db_handle, $SQL);

    while ( $db_field = mysqli_fetch_assoc($result) ) {
        array_push($token_tomb, $db_field['access_token_n']);
        print_r($token_tomb);
        $txt = $db_field['access_token_n'];
        fwrite($myfile, $txt);
    }
}
else{
    print "Database NOT Found";
}
mysqli_close($db_handle);

fclose($myfile);

$fb = new Facebook\Facebook([
    'app_id' => '1109490145833021',
    'app_secret' => 'ea059a8c67731ec82e474ccddec00275',
    'default_graph_version' => 'v2.8',
]);

foreach($token_tomb as $item){
    $acc_token = $item;
    $fb->setDefaultAccessToken($acc_token);

    try {
        // message must come from the user-end
        $data = ['message' => 'testing...'];
        $request = $fb->post('/me/feed', $data);
        $response = $request->getGraphNode()->asArray;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}


$str = $tari;
$new_str = preg_replace_callback('/<img([^>]+)>/', function($img_match){
    if(preg_match('/\bsrc="[^"]+"/i', $img_match[1], $src_match)) {
        return '<img '. $src_match[0] .'>';
    } else {
        return $img_match[1];
    }
}, $str);
echo $new_str;

?>