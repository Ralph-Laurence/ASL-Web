<?php

header('Content-Type: application/json; charset=utf-8');

require_once "../../globalvars.php";
require_once "../constants.php";
require_once "../db/DatabaseHelper.php";

if (isset($_POST["learner_id"], $_POST["tutor_id"]))
{
    HandleHireTutor($_POST["learner_id"], $_POST["tutor_id"]);
}
else
{
    WriteError();
}

function WriteError($msg = 'A problem has occurred while processing the request. Please try again later.', $statusCode = 500)
{
    http_response_code($statusCode);
    echo json_encode([
        'message' => $msg,
        'status' => $statusCode
    ]);
    exit($statusCode);
}

function HandleHireTutor($learnerId, $tutorId)
{
    $db = new DatabaseHelper();

    // Make sure that the learner exists
    $learnerId = $db->find(TableNames::Users, $learnerId);

    // Make sure that the tutor exists
    $tutorId = $db->find(TableNames::Users, $tutorId);

    if (!$learnerId || !$tutorId)
    {
        WriteError();
    }

    $learnerId = $learnerId['id'];
    $tutorId   = $tutorId['id'];

    $data = [
        'learner_id' => $learnerId,
        'tutor_id'   => $tutorId
    ];
    
    $dbHelper = new DatabaseHelper();

    $insertResult = $dbHelper->insertIfNotExists(TableNames::Transactions, data: $data, conditions: $data);

    if ($insertResult) {
        
        echo json_encode([
            'message' => 'Tutor successfully hired.',
            'status' => 200
        ]);

    }
    else
    {
        WriteError("The tutor has already been hired!");
    }
}
