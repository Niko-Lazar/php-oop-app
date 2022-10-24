<?php

namespace Helpers;

class CRUD {

    #public string $tableName;

    public function create(string $tableName, array $valueNames, array $values, string $types) : bool {
    
        $valueNames = implode(',', $valueNames);
        $placeHolders = '';

        for($i=0;$i<sizeof($values); $i++){
            $placeHolders .= '?';

            if($i == sizeof($values)-1){
                break;
            }
            $placeHolders .= ',';
        }

        $sql = "INSERT INTO $tableName ($valueNames) VALUES ($placeHolders)";

        $stmt = \Models\Database::$mysqli->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();

        return $result;
    }
    
    public function readRow(string $tableName, string $condition, string $value, string $type) {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM $tableName WHERE $condition=?");
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_object();
    }

    public function readAll(string $tableName, string $condition, string $value, string $type) {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM $tableName WHERE $condition=?");
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update(string $tableName, array $columns, array $values, string $condition, string $types) : bool {
        
        $columnsToUpdate = implode("=?,", $columns);

        $sql = "UPDATE $tableName SET ";
        $sql .= $columnsToUpdate . "=? WHERE $condition=?";

        $stmt = \Models\Database::$mysqli->prepare($sql);
        $stmt->bind_param($types,...$values);

        $result = $stmt->execute();

        return $result;
    }


    public function delete(string $tableName, string $id) : bool {
        
        $stmt = \Models\Database::$mysqli->prepare("DELETE FROM $tableName WHERE id=?");
        $stmt->bind_param("s", $id);

        $result = $stmt->execute();

        return $result;
    }
}

?>