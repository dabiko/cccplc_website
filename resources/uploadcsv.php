<?php

require_once 'utilities.php';

$RunQuery = new QueryControllers();

if (empty($_FILES['filer']['name'])) {
    $errorMSG = "EMPTY FIELD(S) DETECTED, PLEASE TRY AGAIN";
    $error_msg = [1, $errorMSG];
    echo json_encode($error_msg, JSON_THROW_ON_ERROR);
    exit;
}

$cv = $_FILES['filer']['name'];

if (!empty($cv)) {
    $file = $_FILES["filer"]["tmp_name"];

    // Validate file exists and is readable
    if (!file_exists($file) || !is_readable($file)) {
        $errorMSG = "File not found or not readable";
        $error_msg = [1, $errorMSG];
        echo json_encode($error_msg, JSON_THROW_ON_ERROR);
        exit;
    }

    $file_open = fopen($file, 'rb');

    if ($file_open === false) {
        $errorMSG = "Failed to open CSV file";
        $error_msg = [1, $errorMSG];
        echo json_encode($error_msg, JSON_THROW_ON_ERROR);
        exit;
    }

    $row_count = 0;
    $successful_inserts = 0;
    $errors = [];
    $processed_records = []; // Track processed records to prevent duplicates

    while (($csv = fgetcsv($file_open, 0, ",", '"', "\\")) !== false) {
        $row_count++;

        // Skip empty rows
        if (empty(array_filter($csv))) {
            continue;
        }

        // Validate required fields (assuming columns: client_id, user_id, client_name, card_branch and acc)
        if (count($csv) < 4) {
            $errors[] = "\n Row $row_count: Insufficient columns";
            continue;
        }

        // Trim whitespace and validate each field
        $client_id = trim($csv[0] ?? '');
        $user_id = trim($_SESSION['ccc_username'] ?? '');
        $client_name = trim($csv[1] ?? '');
        $card_branch = trim($csv[2] ?? '');
        $acc = trim($csv[3] ?? '');
        $upload_date = trim(date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa'))) ?? '');

        // Check for empty required fields
        if (empty($client_id)) {
            $errors[] = "\n Row $row_count: Client ID is empty";
            continue;
        }

        if (empty($client_name)) {
            $errors[] = "\n Row $row_count: Client name is empty";
            continue;
        }

        if (empty($card_branch)) {
            $errors[] = "\n Row $row_count: Card branch is empty";
            continue;
        }

        if (empty($acc)) {
            $errors[] = "\n Row $row_count: Account is empty";
            continue;
        }

        // Create a unique key to check for duplicates within the file
        $unique_key = $client_id . '|' . $client_name . '|' . $card_branch . '|' . $acc;

        if (in_array($unique_key, $processed_records, true)) {
            $errors[] = "\n Row $row_count: Duplicate record found in file";
            continue;
        }

        // Check if a record already exists in a database
        $existing_record = $RunQuery->checkDuplicateCardRecord('card_transfers', [
            'client_id' => $client_id,
            'client_name' => $client_name,
            'card_branch' => $card_branch,
            'acc' => $acc
        ]);

        if ($existing_record) {
            $errors[] = "\n Row $row_count: Client with ID: $client_id already exists in a database";
            continue;
        }

        // Prepare data for insertion
        $columns = [
            'client_id',
            'user_id',
            'client_name',
            'card_branch',
            'acc',
            'upload_date'
        ];

        $values = [
            $client_id,
            $_SESSION['ccc_username'] ?? '',
            $client_name,
            $card_branch,
            $acc,
            date('Y-m-d H:i:s')
        ];

        // Attempt to insert the record
        try {
            $InsertQuery = $RunQuery->InsertData('card_transfers', $columns, $values);

            if ($InsertQuery === true) {
                $successful_inserts++;
                $processed_records[] = $unique_key;
            } else {
                $errors[] = "\n Row $row_count: Database insert failed - " . $InsertQuery;
            }
        } catch (Exception $e) {
            $errors[] = "\n Row $row_count: Exception during insert - " . $e->getMessage();
        }
    }

    fclose($file_open);

    // Generate response based on results
    if ($successful_inserts > 0 && empty($errors)) {
        $errorMSG = "\n ALL $successful_inserts CARDS WERE UPLOADED SUCCESSFULLY";
        $error_msg = [0, $errorMSG];
    } elseif ($successful_inserts > 0 && !empty($errors)) {
        $errorMSG = "$successful_inserts cards uploaded successfully. " . count($errors) . " errors occurred: " . implode('; ', array_slice($errors, 0, 5));
        if (count($errors) > 5) {
            $errorMSG .= "; and " . (count($errors) - 5) . " more errors...";
        }
        $error_msg = [0, $errorMSG];
    } else {
        $errorMSG = "\n Upload failed. Errors: " . implode('; ', array_slice($errors, 0, 5));
        if (count($errors) > 5) {
            $errorMSG .= "; and " . (count($errors) - 5) . " more errors...";
        }
        $error_msg = [1, $errorMSG];
    }

    try {
        echo json_encode($error_msg, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        echo $e->getMessage();
    }

} else {
    $errorMSG = "\n Upload Failed: CSV file is empty";
    $error_msg = [1, $errorMSG];
    try {
        echo json_encode($error_msg, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        echo $e->getMessage();
    }
}
