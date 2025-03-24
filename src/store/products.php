<?php

class Products
{
    private $conn;

    public function __construct(mysqli $connexion)
    {
        $this->conn = $connexion;
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

    public function create($name, $price, $image, $description, $quantity, $sku, $category, $brand, $id_product, $archivo)
    {
        $stmt = $this->conn->prepare("INSERT INTO productos (id_product,sku,nombre,descripcion,imagen,precio,stock,categoria_id,marca_id,archivo) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssdiiis", $id_product, $sku, $name, $description, $image, $price, $quantity, $category, $brand, $archivo);

        return $stmt->execute();
    }

    public function update($id, $name, $price, $image, $description, $quantity, $sku, $category, $brand, $archivo)
    {
        $stmt = $this->conn->prepare("UPDATE productos SET sku=?,nombre=?,descripcion=?,imagen=?,precio=?,stock=?,categoria_id=?,marca_id=?,archivo=? WHERE id_product=?");
        $stmt->bind_param("ssssdiiiss", $sku, $name, $description, $image, $price, $quantity, $category, $brand, $archivo, $id);

        return $stmt->execute();
    }

    public function remove($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id_product=?");
        $stmt->bind_param("s", $id);

        return $stmt->execute();
    }

    public function getAll($lang)
    {
        $sql = "SELECT p.id,p.id_product, p.sku, p.nombre, p.descripcion, p.imagen, p.precio, p.stock,p.archivo, c.nombre as categoria, m.nombre as marca 
        FROM productos p 
        INNER JOIN categorias c ON p.categoria_id = c.id 
        INNER JOIN marcas m ON p.marca_id = m.id";

        $result = $this->query($sql);

        if ($result === false) return [];
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }

    public function getAllQ($lang, $offset = 0, $limit = 20)
    {
        $sql = "SELECT p.id, p.id_product, p.sku, p.nombre, p.descripcion, p.imagen, p.precio, p.stock, p.archivo, c.nombre as categoria, m.nombre as marca 
        FROM productos p 
        INNER JOIN categorias c ON p.categoria_id = c.id 
        INNER JOIN marcas m ON p.marca_id = m.id
        LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            return [];
        }

        $stmt->bind_param("ii", $limit, $offset);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            return [];
        }

        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Liberar el resultado
        $result->free();

        // Cerrar la sentencia
        $stmt->close();

        // Devolver las filas
        return $rows;
    }

    public function getCount()
    {
        $sql = "SELECT COUNT(*) as total FROM productos";
        $result = $this->query($sql);

        if ($result === false) return 0;
        $rows = $result->fetch_assoc();
        $result->free();
        return $rows['total'];
    }


    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT p.id, p.id_product, p.sku, p.nombre, p.descripcion, p.imagen, p.precio, p.stock, p.categoria_id, p.marca_id, p.archivo FROM productos p WHERE id_product=?");
        $stmt->bind_param("s", $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_assoc();
        $result->free();

        return $rows;
    }
}
