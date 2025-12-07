<?php

class Product extends Model {

public function getAll($keyword = '', $category = null)
{
    $sql = "SELECT * FROM products WHERE 1 ";

    if ($keyword) {
        $sql .= " AND name LIKE :keyword ";
    }

    if ($category) {
        $sql .= " AND category_id = :category ";
    }

    $stmt = $this->db->prepare($sql);

    if ($keyword) {
        $stmt->bindValue(':keyword', "%$keyword%");
    }

    if ($category) {
        $stmt->bindValue(':category', $category, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Hàm tạo slug đơn giản từ tên
    private function toSlug($str)
    {
        $str = strtolower(trim($str));
        // Nếu muốn xử lý tiếng Việt chuẩn hơn có thể thêm iconv ở đây
        $str = preg_replace('/[^a-z0-9]+/', '-', $str);
        return trim($str, '-');
    }

    // (tuỳ chọn) kiểm tra slug đã tồn tại hay chưa
    private function slugExists($slug)
    {
        $stmt = $this->db->prepare("SELECT id FROM products WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchColumn() !== false;
    }

    public function createSimple($data)
    {
        // Tạo slug từ name
        $slugBase = $this->toSlug($data['name']);
        $slug     = $slugBase;

        // Nếu muốn đảm bảo không trùng slug:
        $i = 1;
        while ($this->slugExists($slug)) {
            $slug = $slugBase . '-' . $i++;
        }

        $sql = "INSERT INTO products 
                (name, slug, price, short_desc, description, stock, status, thumbnail, category_id)
                VALUES 
                (:name, :slug, :price, :short_desc, :description, :stock, :status, :thumbnail, :category_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name'        => $data['name'],
            ':slug'        => $slug,
            ':price'       => $data['price'],
            ':short_desc'  => $data['short_desc'],
            ':description' => $data['description'],
            ':stock'       => $data['stock'],
            ':status'      => $data['status'],
            ':thumbnail'   => $data['thumbnail'],
            ':category_id' => $data['category_id'],
        ]);
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
public function countAll()
{
    $stmt = $this->db->query("SELECT COUNT(*) FROM products");
    return (int)$stmt->fetchColumn();
}

}

