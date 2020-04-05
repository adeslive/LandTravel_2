<?php
use React\Http\Response;

$response = new Response();
/**
 * Returns the server response; The response is not unique and its shared amongst the server
 * @return Response
 */

function initResponse() {
    global $response;
    if ($response == null){
        $response = new Response(200, ['Content-Type' => 'text/html']);
    }
}

function getResponse() : Response
{
    global $response;
    if ($response == null){
        initResponse();
    }
    return $response;
}

function defaultResponse() : Response
{
    return morphResponse( new Response(200, ['Content-Type' => 'text/html']));;
}

function morphResponse(Response $new_response) : Response
{
    global $response;
    return ($response = $new_response);
}

function addBody($body){
    global $response;
    $new_response = new Response($response->getStatusCode(), $response->getHeaders(), $body);
    return morphResponse($new_response);
}

function redirect(string $url): Response
{
    return new Response(302, ['Location'=> $url]);
}