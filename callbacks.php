<?php
header('Content-type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (isset($data))
{
    require_once('bootstrap.php');

    $json = "{}";

    switch ($data->fn) {
        case 'getEntities':
            $json = getEntities($data, $entityManager);
        break;
        case 'getEntity':
            $json = getEntity($data, $entityManager);
        break;
        case 'deleteEntity':
            $json = deleteEntity($data, $entityManager);
        break;
        case 'aeclue':
            $json = addEditClue($data, $entityManager);
            break;
        case 'aeanswer':
            $json = addEditAnswer($data, $entityManager);
            break;
        case 'linkclues':
            $json = linkClues($data, $entityManager);
            break;
        case 'aehint':
            $json = addEditHint($data, $entityManager);
            break;
        case 'aehunt':
            $json = addEditHunt($data, $entityManager);
            break;
        case 'aestory':
            $json = addEditStory($data, $entityManager);
            break;
        case 'aeparty':
            $json = addEditParty($data, $entityManager);
            break;
        case 'aeuser':
            $json = addEditUser($data, $entityManager);
            break;
        case 'assignAnswer':
            assignAnswer($data, $entityManager);
            break;
        case 'assignNextClue':
            assignNextClue($data, $entityManager);
            break;
        case 'assignClueHint':
            assignClueHint($data, $entityManager);
            break;
        case 'getMap':
            $map = getMap($data, $entityManager);

            $json = json_encode($map);
        break;
        default:
            break;
    }

    echo sprintf("%s", $json);
}