<?php

use MathCart\ApiAccess;
use Slim\Http\Request;
use Slim\Http\Response;
require_once __DIR__ . '/../vendor/autoload.php';

/*
Skeleton  for a post route
add middleware function $checkToken to protect the route.
See examples below
 */
$app->post('/post', function (Request $request, Response $response, array $args) {
    $data = array('example ' => ' of return array to object');
    $newResponse = $response->withJson($data);
    return $newResponse;
});

/*
Route to processes code after user starts the
request to login through google.
It is also an example of an unprotected route, there is no call
to the API's middleware.
 */
$app->post('/google-code', function (Request $request, Response $response, array $args) {
    // first, check we have a code
    $body = $request->getParsedBody();
    if (!isset($body['code'])) {
        $data = array('error' => 'no code sent ', 'id' => 0);
        $newResponse = $response->withJson($data);
        return $newResponse;
    }
    $api = new ApiAccess();
    $data = $api->processGoogleCode($body['code']);
    return $response->withJson($data);
});

/*
A route that is protected through middleware. $checkToken
is defined in slim's middleware.php file.
 */
$app->post('/get_hw', function (Request $request, Response $response, array $args) {
    $body = $request->getParsedBody();
    $api = new ApiAccess();
    $hws = $api->returnHws($body['email']);
    return $response->withJson($hws);
})->add($checkToken);
