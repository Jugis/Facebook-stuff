<?php
//EAAPxE04GMD0BAMO7dXwljgimzcJheBCZBScudutHpmE1WoD0DwVCZClVQ3XfDUvCezUOUXTc6HgkGnCghZCdDIgJB8C9uInlVP1Y2U3b6lZCAJhA3blQAPrRTPAZCRvfxVmF6g5mcCh2HZBWrn7w1ZC8Ipd7GPsWdwZD
session_start();
require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '\'1109490145833021\',',
    'app_secret' => '\'ea059a8c67731ec82e474ccddec00275\',',
    'default_graph_version' => 'v2.8',
]);
$acc_token = EAAPxE04GMD0BAMO7dXwljgimzcJheBCZBScudutHpmE1WoD0DwVCZClVQ3XfDUvCezUOUXTc6HgkGnCghZCdDIgJB8C9uInlVP1Y2U3b6lZCAJhA3blQAPrRTPAZCRvfxVmF6g5mcCh2HZBWrn7w1ZC8Ipd7GPsWdwZD;
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
?>