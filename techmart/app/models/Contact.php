<?php

class Contact extends Model
{
    // lưu contact từ form liên hệ
    public function create($data)
    {
        $sql = "INSERT INTO contacts (name, email, phone, subject, message, status)
                VALUES (:name, :email, :phone, :subject, :message, 'new')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name'    => $data['name'],
            ':email'   => $data['email'],
            ':phone'   => $data['phone'],
            ':subject' => $data['subject'],
            ':message' => $data['message'],
        ]);
    }

    // lấy danh sách liên hệ (nếu $status = null thì lấy tất cả)
    public function getAll($status = null)
    {
        if ($status) {
            $stmt = $this->db->prepare("SELECT * FROM contacts WHERE status = :st ORDER BY created_at DESC");
            $stmt->execute([':st' => $status]);
        } else {
            $stmt = $this->db->query("SELECT * FROM contacts ORDER BY created_at DESC");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markReplied($id)
    {
        $stmt = $this->db->prepare("UPDATE contacts SET status = 'replied' WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function deleteById($id)
    {
        $stmt = $this->db->prepare("DELETE FROM contacts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
