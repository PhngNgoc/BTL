<?php

class Post extends Model
{
    public function getAll($keyword = '')
    {
        $sql = "SELECT * FROM posts WHERE status = 'published'";

        $params = [];
        if ($keyword !== '') {
            $sql .= " AND title LIKE :kw";
            $params['kw'] = '%' . $keyword . '%';
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // dùng cho admin (lấy cả draft)
    public function getAllAdmin($keyword = '')
    {
        $sql = "SELECT * FROM posts WHERE 1";
        $params = [];
        if ($keyword !== '') {
            $sql .= " AND title LIKE :kw";
            $params['kw'] = '%' . $keyword . '%';
        }
        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO posts (title, slug, excerpt, content, thumbnail, status)
            VALUES (:title, :slug, :excerpt, :content, :thumbnail, :status)
        ");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare("
            UPDATE posts
            SET title=:title, slug=:slug, excerpt=:excerpt,
                content=:content, thumbnail=:thumbnail, status=:status
            WHERE id=:id
        ");
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id=:id");
        return $stmt->execute(['id' => $id]);
    }

    protected $table = 'posts';

    public function getLatest($limit = 3)
    {
        $sql = "SELECT * FROM posts 
                WHERE status = 'published' 
                ORDER BY created_at DESC 
                LIMIT $limit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
