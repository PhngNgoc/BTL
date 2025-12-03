<?php

class Product extends Model {

    public function getAll($keyword = '', $category = null) {
        $sql = "SELECT * FROM products WHERE status = 'active'";

        if ($keyword !== '') {
            $sql .= " AND name LIKE :kw";
        }
        if ($category !== null) {
            $sql .= " AND category_id = :cate";
        }

        $stmt = $this->db->prepare($sql);

        if ($keyword !== '') {
            $stmt->bindValue(':kw', "%{$keyword}%");
        }
        if ($category !== null) {
            $stmt->bindValue(':cate', $category, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function createSimple($data)
{
    $sql = "INSERT INTO products (name, price, short_desc, description, stock, status, thumbnail, category_id)
            VALUES (:name, :price, :short_desc, :description, :stock, :status, :thumbnail, 1)"; // tạm category_id=1
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
}

public function updateSimple($id, $data)
{
    $sql = "UPDATE products
            SET name=:name, price=:price, short_desc=:short_desc,
                description=:description, stock=:stock, status=:status, thumbnail=:thumbnail
            WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data['id'] = $id;
    $stmt->execute($data);
}

public function deleteSimple($id)
{
    $stmt = $this->db->prepare("DELETE FROM products WHERE id=:id");
    $stmt->execute(['id' => $id]);
}

public function getFeatured($limit = 4)
{
    $sql = "SELECT * FROM products 
            ORDER BY created_at DESC 
            LIMIT :lim";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

