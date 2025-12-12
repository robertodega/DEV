<?php
class Manager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getData($table)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateData($year, $month, $tableName, $column, $value, $name)
    {
        $value = str_replace(',', '.', $value);
        
        $query_exist = "SELECT COUNT(*) FROM $tableName WHERE ref_year = :year AND ref_month = :month";
        $queryUpdate = "UPDATE $tableName SET $column = :value WHERE ref_year = :year AND ref_month = :month";
        $queryInsert = "INSERT INTO $tableName (ref_year, ref_month, $column) VALUES (:year, :month, :value)";
        
        if (in_array($tableName, ['bills', 'overview'])) {
            $query_exist .= " AND name = :target";
            $queryUpdate .= " AND name = :target";
            $queryInsert = "INSERT INTO $tableName (ref_year, ref_month, name, $column) VALUES (:year, :month, :target, :value)";
        }

        $stmt = $this->conn->prepare($query_exist);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':month', $month);

        if (strpos($query_exist, ':target') !== false) {
            $stmt->bindParam(':target', $name);
        }

        $stmt->execute();
        $exists = $stmt->fetchColumn();

        try {
            $q = ($exists && $exists > 0) ? $queryUpdate : $queryInsert;

            $stmt = $this->conn->prepare($q);

            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':month', $month);
            $stmt->bindParam(':value', $value);
            if (strpos($q, ':target') !== false) {
                $stmt->bindParam(':target', $name);
            }

            // /* DEBUG */ $this->printQ($q, $value, $year, $month, "".$name."");die(); /* */

            $stmt->execute();

        } catch (PDOException $e) {
            $updateResult = $e;
            #   throw new Exception("Update data error: " . $e->getMessage());
        }
        return true;
    }

    public function backupDb()
    {
        $backup_file = DB_PATH . date('Y_m_d-H_i_s') . '.sql';
        $dumpPath = trim(shell_exec('which mysqldump'));
        if (empty($dumpPath)) {
            $dumpPath = trim(shell_exec('whereis mysqldump'));
            if (empty($dumpPath)) {
                echo "
                    <pre>Errore: mysqldump non trovato nel PATH di sistema.</pre><hr />
                    <button type='button' class='btn btn-primary btn-sm' ref='home' id='homeButton' onclick=\"location.href='" . ROOT_PATH . "'\">Home</button>
                ";
                exit;
            }
        }
        $dumpPath = substr($dumpPath, strlen("mysqldump: "));
        $command = escapeshellcmd($dumpPath) . " --user=" . escapeshellarg(DB_USER) . " --password=" . escapeshellarg(DB_PWD) . " --host=" . escapeshellarg(DB_HOST) . " " . escapeshellarg(DB_NAME) . " 2>&1 > " . escapeshellarg($backup_file);
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
    }

    function scanContentDir($folder, $multilevel = false)
    {
        $res = [];
        $content = scandir($folder, 1);
        foreach ($content as $c) {
            if (($c != '.') && ($c != '..')) {
                if ($multilevel) {
                    $path = $folder . DIRECTORY_SEPARATOR . $c;
                    if (is_dir($path)) {
                        $res[$c] = scanContentDir($path, $multilevel);
                    } else {
                        $res[] = $c;
                    }
                } else {
                    $res[] = $c;
                }
            }
        }
        return $res;
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
