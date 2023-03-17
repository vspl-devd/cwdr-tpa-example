<?php

/**
 * @link http://www.vishwayon.com/
 * @copyright Copyright (c) 2023 Vishwayon Software Pvt Ltd
 * @license MIT
 */
require '../vendor/autoload.php';

include '../config.php';

// Create a Ghuzzle Client instance and call authentication
$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => $coreErpUrl,
    // You can set any number of default request options.
    'timeout' => 2.0,
        ]);

$headers = [
    'authid' => $authkey,
    'authsecret' => $authsecret,
    'Content-Type' => 'application/json'
];

$body = $_POST['leadData'];

// Prepare Request with headers
$request = new \GuzzleHttp\Psr7\Request('POST', '?r=tpi/add-lead', $headers, json_encode($body));
$result = ['status' => 'ERR', 'message' => ''];
try {
// Process Response
    $response = $client->send($request);
    $respStatus = $response->getStatusCode();
} catch (\GuzzleHttp\Exception\ClientException $ex) {
    $result['message'] = $ex->getResponse();
} catch (GuzzleHttp\Exception\TransferException $ex) {
    $result['message'] = $ex->getMessage();
}
if ($respStatus === 200) {
    $result['status'] = 'OK';
} elseif ($respStatus === 401) {
    $result['message'] = 'Authentication failed';
} else {
    $result['message'] = 'Server error';
}
echo json_encode($result);
