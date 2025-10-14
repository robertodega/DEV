<?php

#   session_start();

$host = DB_HOST;
$db = DB_NAME;
$user = DB_USER;
$pass = DB_PWD;

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$loginAction = isset($_POST['loginAction']) ? $_POST['loginAction'] : '';
if ($loginAction) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM " . LOGIN_TABLE_NAME . " WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    switch ($loginAction) {
        case 'login':
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $username;
                }
            }
            break;

        case 'register':
            if ($result->num_rows > 0) {
                echo "<div class='loginResultDiv loginErrorDiv'>Username già esistente.</div>";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insertSql = "INSERT INTO " . LOGIN_TABLE_NAME . " (username, password) VALUES (?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("ss", $username, $hashedPassword);
                if ($insertStmt->execute()) {
                    echo "<div class='loginResultDiv loginSuccessDiv'>Registrazione completata con successo.</div>";
                } else {
                    echo "<div class='loginResultDiv loginErrorDiv'>Errore nella registrazione: " . $insertStmt->error . "</div>";
                }
            }
            break;

        default:
            echo "Azione non riconosciuta.";
            break;
    }
    header("Location: " . ROOT_PATH);
}

$conn->close();
?>
<div class='loginHeader'><a href='<?= ROOT_PATH ?>'><h1>Finance Utility</h1> <h2>by <strong>DeGa</strong></h2></a></div>
<div class='loginFormDiv' id='loginFormDiv'>
    <form name="loginForm" id='loginForm' action="<?= ROOT_PATH ?>" method="POST">
        <input type="hidden" name="loginAction" id="loginAction" value="">
        <input class='form-control loginFormField' type="text" name="username" id="username" placeholder="Username" required>
        <input class='form-control loginFormField' type="password" name="password" id="password" placeholder="Password" required>
        <button class='btn btn-secondary loginFormField loginBtn' type="button" id='loginBtn' actionRef='login'>Login</button>
    </form>
</div>