<?php

class PostComment extends Model
{
    public function getByPost($postId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM post_comments
            WHERE post_id = :id AND is_approved = 1
            ORDER BY created_at DESC
        ");
        $stmt->execute(['id' => $postId]);
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO post_comments (post_id, user_name, user_email, content, rating)
            VALUES (:post_id, :user_name, :user_email, :content, :rating)
        ");
        return $stmt->execute($data);
    }

    // cho admin
    public function getAll($keyword = '')
    {
        $sql = "
            SELECT c.*, p.title AS post_title
            FROM post_comments c
            JOIN posts p ON c.post_id = p.id
            WHERE 1
        ";
        $params = [];
        if ($keyword !== '') {
            $sql .= " AND p.title LIKE :kw";
            $params['kw'] = '%' . $keyword . '%';
        }
        $sql .= " ORDER BY c.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function updateApprove($id, $approve)
    {
        $stmt = $this->db->prepare("
            UPDATE post_comments
            SET is_approved = :ap
            WHERE id = :id
        ");
        return $stmt->execute(['ap' => $approve ? 1 : 0, 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM post_comments WHERE id=:id");
        return $stmt->execute(['id' => $id]);
    }
}
