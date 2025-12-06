<?php

class Setting extends Model
{
    // Lấy toàn bộ settings dưới dạng key => value
    public function getAll()
    {
        $stmt = $this->db->query("SELECT `key`, `value` FROM settings");
        $rows = $stmt->fetchAll();
        $result = [];
        foreach ($rows as $r) {
            $result[$r['key']] = $r['value'];
        }
        return $result;
    }

    public function get($key, $default = null)
    {
        $stmt = $this->db->prepare("SELECT value FROM settings WHERE `key`=:k");
        $stmt->execute(['k' => $key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }

    public function set($key, $value)
    {
        // INSERT nếu chưa có, UPDATE nếu đã có
        $stmt = $this->db->prepare("
            INSERT INTO settings(`key`, `value`)
            VALUES (:k, :v)
            ON DUPLICATE KEY UPDATE `value` = :v2
        ");
        $stmt->execute([
            'k' => $key,
            'v' => $value,
            'v2' => $value
        ]);
    }
}
