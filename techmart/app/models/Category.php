<?php

class Category extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("SELECT id, name FROM categories ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lấy tất cả danh mục đang active
    public function getAllActive()
    {
        $sql = "SELECT id, name FROM categories WHERE status = 'active'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
