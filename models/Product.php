<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT p.*, c.name as category_name FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT p.*, c.name as category_name FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($query) {
        $query = "%" . $query . "%";
        $sql = "SELECT * FROM " . $this->table_name . " WHERE name LIKE ? OR description LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $query);
        $stmt->bindParam(2, $query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, price=:price, stock=:stock, image=:image, category_id=:category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":price", $data['price']);
        $stmt->bindParam(":stock", $data['stock']);
        $stmt->bindParam(":image", $data['image']);
        $stmt->bindParam(":category_id", $data['category_id']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, stock=:stock, image=:image, category_id=:category_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":price", $data['price']);
        $stmt->bindParam(":stock", $data['stock']);
        $stmt->bindParam(":image", $data['image']);
        $stmt->bindParam(":category_id", $data['category_id']);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>