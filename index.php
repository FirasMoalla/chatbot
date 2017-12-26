<?php
/*
 * Copyright IBM Corp. 2016
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

 /**
  * This PHP file uses the Slim Framework to construct a REST API.
  * See Cloudant.php for the database functionality
  */
require 'vendor/autoload.php';
require_once('./Cloudant.php');
$app = new \Slim\Slim();

$app->get('/', function () {
  global $app;
  $app->render('index.html');
});

//echo 'fix this';





$app->get('/api/visitors', function () {
  global $app;
  $app->contentType('application/json');
  $visitors = array();
  if(Cloudant::Instance()->isConnected()) {
    $visitors = Cloudant::Instance()->get();
  }
  echo json_encode($visitors);
});

$app->post('/api/message', function() {
  global $app;

  $usermsgj = json_decode($app->request()->getBody(), true);
  $usermsg = $usermsgj['input'];
  //echo 'message';


// init
$username = "7dec3b76-0d0e-4f57-96e0-6b7c6e2450a1";
$password = "kgAwqkljW5Mj";
$workspace = "3c5b4a2a-0086-47c8-ba5a-bd15a9528685";
$url = "https://gateway.watsonplatform.net/conversation/api";
$url = $url . "/v1/workspaces/" . $workspace . "/message?version=2016-09-20";


    // http req - options
    $options = array(
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode((['input' => ['text' => $usermsg] ])),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => $username . ":" . $password,
        CURLOPT_URL => $url
    );
    
    // open req
    $curl = curl_init();
    // associate argus to req
    curl_setopt_array($curl, $options);
    // exe post()
    $result = curl_exec($curl);
    
    // err
    if (curl_errno($curl)) 
        echo 'Error:' . curl_error($curl);
    

    // close req
    curl_close($curl);

    // print res 
    //echo $result;

    $watson = json_decode($result,true);
    $ttt = $watson['output'];
    $tt = $ttt['text'];
    $t = $tt[0];

    echo $result;
});


$app->post('/api/visitors', function() {
	global $app;
  $visitor = json_decode($app->request()->getBody(), true);
  if(Cloudant::Instance()->isConnected()) {
    Cloudant::Instance()->post($visitor);
    echo sprintf("Hello %s, I've added you to the database!", $visitor['name']);
  } else {
    echo sprintf("Hello %s!", $visitor['name']);
  }
});

$app->delete('/api/visitors/:id', function($id) {
	global $app;
	Cloudant::Instance()->delete($id);
    $app->response()->status(204);
});

$app->put('/api/visitors/:id', function($id) {
	global $app;
	$visitor = json_decode($app->request()->getBody(), true);
    echo json_encode(Cloudant::Instance()->put($id, $visitor));
});

$app->run();
