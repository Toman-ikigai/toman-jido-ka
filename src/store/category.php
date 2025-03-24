<?php

class Category
{
    private $conn;

    public function __construct(mysqli $db)
    {
        $this->conn = $db;
    }

    public function query($sql)
    {
        try {
            $result = $this->conn->query($sql);
            return $result;
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function create($name, $description)
    {
        $sql = $this->conn->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $sql->bind_param("ss", $name, $description);
        $result = $sql->execute();
        return $result;
    }

    public function update($id, $name, $description)
    {
        $sql = $this->conn->prepare("UPDATE categorias SET nombre=?, descripcion=? WHERE id=?");
        $sql->bind_param("ssi", $name, $description, $id);
        $result = $sql->execute();
        return $result;
    }

    public function remove($id)
    {
        $sql = $this->conn->prepare("DELETE FROM categorias WHERE id=?");
        $sql->bind_param("i", $id);
        $result = $sql->execute();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categorias";
        $result = $this->query($sql);

        if ($result === false) return [];

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }

    public function getById($id)
    {
        $sql = $this->conn->prepare("SELECT * FROM categorias WHERE id=?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $result = $sql->get_result();
        $rows = $result->fetch_assoc();
        $result->free();

        return $rows;
    }
}
