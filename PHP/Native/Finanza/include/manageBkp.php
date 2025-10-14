<?php
if (isset($_POST['file'])) {
    $file = $_POST['file'];
    $method = $_POST['method'] ?? '';
    switch ($method) {
        case 'delete': {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            break;
        case 'reload': {
                #   reload DB DUMP
            }
            break;
        default:
            break;
    }
}
