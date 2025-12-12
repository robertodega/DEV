<?php
if (isset($_POST['filename'])) {
    $file = $_POST['filename'] ?? '';
    $method = $_POST['method'] ?? '';
    switch ($method) {
        case 'delete': {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            break;
        default:
            break;
    }
}
