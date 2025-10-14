<?php
    $resultValue = "Videoteca PHP";
    $addResult = "Il film NON è stato inserito";
    $updateResult = "Il film NON è stato aggiornato";
    $deleteResult = "Il film NON è stato rimosso";
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (isset($_POST["modField"]) && $_POST["modField"] == "add") {
            $title = $_POST["titleField"] ?? "";
            $author = $_POST["authorField"] ?? "";
            $year = $_POST["yearField"] ?? "";
            $genre = $_POST["genreField"] ?? "";
            try {
                if ($filmManager->addFilm($title, $author, $year, $genre)) {
                    $addResult = "Il film è stato correttamente inserito";
                }
            } catch (PDOException $e) {
                
            }
            $resultValue = $addResult;
        }
        elseif (isset($_POST["modField"]) && $_POST["modField"] == "update") {
            $id = $_POST["idField"] ?? "";
            $title = $_POST["titleField"] ?? "";
            $author = $_POST["authorField"] ?? "";
            $year = $_POST["yearField"] ?? "";
            $genre = $_POST["genreField"] ?? "";
            try {
                if ($filmManager->updateFilm($id, $title, $author, $year, $genre)) {
                    $updateResult = "Il film è stato correttamente aggiornato";
                }
            } catch (PDOException $e) {
                
            }
            $resultValue = $updateResult;
        }
        elseif (isset($_POST["modField"]) && $_POST["modField"] == "delete") {
            $id = $_POST["idField"] ?? "";
            try {
                if ($filmManager->deleteFilm($id)) {
                    $deleteResult = "Il film è stato correttamente rimosso";
                }
            } catch (PDOException $e) {
                
            }
            $resultValue = $deleteResult;
        }
    }
?>