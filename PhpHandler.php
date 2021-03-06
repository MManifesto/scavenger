<?php
require_once('lib/ScavengerHandler.php');
require_once('lib/TwiMLHelper.php');

include_once('lib/AuthenticationHandler.php');
do_authenticate();

// header("content-type: text/xml");

$message = $_GET;
$format = $message["format"];

$Scavenger = new ScavengerHandler($message, $entityManager);

$response_body = $Scavenger->CreateResponse($message);

if (!empty($response_body["body"]))
{
    $output = "";

    if ($format == "xml")
    {
        $xml = format_TwiML($response_body);
        $xmlDoc = new DOMDocument();
        $xmlDoc->loadXML($xml);
        $xmlDoc->formatOutput=true;

        $output = "<pre style='white-space: pre-wrap'>" . htmlentities($xmlDoc->saveXML()) . "</pre>";
    }
    else
    {
        $output = $response_body["body"];
    }

    echo $output;
}

?>