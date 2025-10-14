<?php
class Manager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function scanContentDir($folder)
    {

        $res = [];
        $content = scandir($folder, 1);

        foreach ($content as $k => $c) {
            if (($c != '.') && ($c != '..')) {
                $res[$k] = $c;
                if (is_dir($c)) {
                    $res[$k]["" . $c . ""] = $this->scanContentDir($folder . $c);
                }
            }
        }
        return $res;
    }

    public function getData($table)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateData($tabId, $tableName, $year, $month, $value, $target, $column)
    {
        $value = str_replace(',', '.', $value);
        if ($tabId == 'overview') {
            $column = 'amount';
            $value = (is_numeric($value) && $value !== '') ? (float)$value : 0.0;
        }

        $query_exist = "SELECT COUNT(*) FROM $tableName WHERE ref_year = :year AND ref_month = :month AND name = :target";
        $queryUpdate = "UPDATE $tableName SET $column = :value WHERE ref_year = :year AND ref_month = :month AND name = :target";
        $queryInsert = "INSERT INTO $tableName (ref_year, ref_month, name, $column) VALUES (:year, :month, :target, :value)";

        if (in_array("$target", ['Acqua', 'stipendio', 'mutuo', 'contocorrente'])) {
            $query_exist = "SELECT COUNT(*) FROM $tableName WHERE ref_year = :year AND ref_month = :month";
            $queryUpdate = "UPDATE $tableName SET $column = :value WHERE ref_year = :year AND ref_month = :month";
            $queryInsert = "INSERT INTO $tableName (ref_year, ref_month, $column) VALUES (:year, :month, :value)";
        }
        $stmt = $this->conn->prepare($query_exist);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':month', $month);

        if (strpos($query_exist, ':target') !== false) {
            $stmt->bindParam(':target', $target);
        }
        $stmt->execute();
        $exists = $stmt->fetchColumn();

        try {
            $q = ($exists && $exists > 0) ? $queryUpdate : $queryInsert;

            $stmt = $this->conn->prepare($q);

            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':month', $month);
            if (strpos($q, ':target') !== false) {
                $stmt->bindParam(':target', $target);
            }
            $stmt->bindParam(':value', $value);

            /* DEBUG * $this->printQ($q, $value, $year, $month, $target); /* */

            $stmt->execute();
        } catch (PDOException $e) {
            #   throw new Exception("Update data error: " . $e->getMessage());
        }

        return true;
    }

    public function backupDb($linkDownload, $dumpWritePermission)
    {
        $backup_file = DB_PATH . date('Y_m_d-H_i_s') . '.sql';
        $dumpPath = trim(shell_exec('which mysqldump'));
        if (empty($dumpPath)) {
            echo "
                <pre>Errore: mysqldump non trovato nel PATH di sistema.</pre><hr />
                <button type='button' class='btn btn-primary btn-sm' ref='home' id='homeButton' onclick=\"location.href='" . ROOT_PATH . "'\">Home</button>
            ";
            exit;
        }
        $command = escapeshellcmd($dumpPath) . " --user=" . escapeshellarg(DB_USER) . " --password=" . escapeshellarg(DB_PWD) . " --host=" . escapeshellarg(DB_HOST_N) . " " . escapeshellarg(DB_NAME) . " 2>&1 > " . escapeshellarg($backup_file);
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);
        if ($return_var !== 0) {
            echo "
                <pre>Errore nel backup (" . $return_var . "):\n" . implode("\n", $output) . "</pre><hr />
                <button type='button' class='btn btn-primary btn-sm' ref='home' id='homeButton' onclick=\"location.href='" . ROOT_PATH . "'\">Home</button>
            ";
            exit;
        }

        #   header setting for download
        if ($linkDownload) {
            header('Content-Type: application/octet-stream');
            header("Content-Disposition: attachment; filename=\"$backup_file\"");
            readfile($backup_file);
        } else {
            header("Location: " . ROOT_PATH . "?backup=1");
            exit;
        }

        if (!$dumpWritePermission) {
            unlink($backup_file);
        }       #   Remove the backup file after download
    }

    public function userManager($userManagerAction, $username, $password = '')
    {
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : '';
        $query_exist = "SELECT COUNT(*) FROM ".LOGIN_TABLE_NAME." WHERE username = :username";
        $queryUpdate = "UPDATE ".LOGIN_TABLE_NAME." SET password = :password WHERE username = :username";
        $queryInsert = "INSERT INTO ".LOGIN_TABLE_NAME." (username, password) VALUES (:username, :password)";

        $stmt = $this->conn->prepare($query_exist);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $exists = $stmt->fetchColumn();

        try {
            $q = ($exists && $exists > 0) ? $queryUpdate : $queryInsert;

            $stmt = $this->conn->prepare($q);

            $stmt->bindParam(':username', $username);
            if (strpos($q, ':password') !== false) {
                $stmt->bindParam(':password', $hashedPassword);
            }

            /* DEBUG * $this->printQ($q, $username, $hashedPassword); /* */

            $stmt->execute();
        } catch (PDOException $e) {
            #   throw new Exception("User manager data error: " . $e->getMessage());
        }

        return true;
    }

    /* DEBUG */
    public function printQ($q, $value, $year, $month, $target)
    {
        $debugQuery = $q;
        $debugQuery = str_replace(':value', var_export($value, true), $debugQuery);
        $debugQuery = str_replace(':year', var_export($year, true), $debugQuery);
        $debugQuery = str_replace(':month', var_export($month, true), $debugQuery);
        if (strpos($q, ':target') !== false) {
            $debugQuery = str_replace(':target', var_export($target, true), $debugQuery);
        }
        echo $debugQuery . PHP_EOL . "<br />";
    }
    /* */
}
