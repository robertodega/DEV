<?php
    $subject = $_POST['subject'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $note = $_POST['note'] ?? '';

    if (empty($subject) || empty($username) || empty($password)) {
        echo "Subject, Username, and Password are required.";
        return;
    }

    $data = [
        'subject' => htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'),
        'username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
        'password' => htmlspecialchars($password, ENT_QUOTES, 'UTF-8'),
        'note' => htmlspecialchars($note, ENT_QUOTES, 'UTF-8')
    ];

    if($formAction == 'addRecord') {
        try{
            if ($manager->getDataByValue(RUBRICA_TBL, $data['subject'])) {
                $addedResult = "Data <strong>" . htmlspecialchars($data['subject'], ENT_QUOTES, 'UTF-8') . "</strong> already exists.";
            } elseif ($manager->addData(RUBRICA_TBL, $data)) {
                $addedResult = "Data added successfully.";
            } else {
                $addedResult = "Failed to add data.";
            }
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return;
        }
    }
?>