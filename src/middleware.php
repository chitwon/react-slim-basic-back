<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

use MathCart\ApiAccess;

$checkToken =  function ($request, $response, $next) {
    $mc = new ApiAccess();
    $body = $request->getParsedBody();
    if (isset($body['token'] )&& isset($body['email']))
    {
        if ($mc->checkToken($body['token'], $body['email'])) return  $next($request, $response);
    }
    $data = array('error' => 'bad token', 'id' => 40);
    $newResponse = $response->withJson($data);
    return $newResponse;
};