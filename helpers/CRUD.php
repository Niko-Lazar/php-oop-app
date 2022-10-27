<?php

namespace Helpers;

class CRUD {

    public string $tableName;

    public function create(array $valueNames, array $values, string $types) : bool {
    
        $valueNames = implode(',', $valueNames);
        $placeHolders = implode(',', array_map(fn() => $temp[] = "?", $values));

        $sql = "INSERT INTO $this->tableName ($valueNames) VALUES ($placeHolders)";

        $stmt = \Models\Database::$mysqli->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();

        return $result;
    }
    
    public function readRow(string $condition, string $value, string $type) {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM $this->tableName WHERE $condition=?");
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_object();
    }

    public function readAll(string $condition, string $value, string $type) {
        $stmt = \Models\Database::$mysqli->prepare("SELECT * FROM $this->tableName WHERE $condition=?");
        $stmt->bind_param($type, $value);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update(array $columns, array $values, string $condition, string $types) : bool {
        
        $columnsToUpdate = implode("=?,", $columns);

        $sql = "UPDATE $this->tableName SET ";
        $sql .= $columnsToUpdate . "=? WHERE $condition=?";

        $stmt = \Models\Database::$mysqli->prepare($sql);
        $stmt->bind_param($types,...$values);

        $result = $stmt->execute();

        return $result;
    }


    public function delete(string $id) : bool {
        
        $stmt = \Models\Database::$mysqli->prepare("DELETE FROM $this->tableName WHERE id=?");
        $stmt->bind_param("s", $id);

        $result = $stmt->execute();

        return $result;
    }
}

?>