<?php

class User
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

    public function login($email, $password)
    {
        $sql = $this->conn->prepare("SELECT * FROM usuarios WHERE email=?");
        $sql->bind_param("s", $email);
        $sql->execute();

        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $result->free();

        if (!$row) return false;

        if (password_verify($password, $row['password_hash']) && $row['activo'] === 1) {
            return $row;
        }

        return false;
    }

    public function create($name, $email, $password, $role)
    {
        $sql = $this->conn->prepare("INSERT INTO usuarios (nombre, email, password_hash,rol) VALUES (?, ?, ?,?)");
        $sql->bind_param("ssss", $name, $email, $password, $role);
        $result = $sql->execute();
        return $result;
    }

    public function update($id, $name, $email, $password, $role)
    {
        $sql = $this->conn->prepare("UPDATE usuarios SET nombre=?, email=?, password_hash=?, rol=? WHERE id=?");
        $sql->bind_param("ssssi", $name, $email, $password, $role, $id);
        $result = $sql->execute();
        return $result;
    }

    public function remove($id)
    {
        $sql = $this->conn->prepare("DELETE FROM usuarios WHERE id=?");
        $sql->bind_param("i", $id);
        $result = $sql->execute();
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM usuarios";
        $result = $this->query($sql);

        if ($result === false) return [];

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }

    public function getById($id)
    {
        $sql = $this->conn->prepare("SELECT * FROM usuarios WHERE id=?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $result->free();
        return $row;
    }
}
