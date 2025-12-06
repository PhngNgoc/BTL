<?php

class Faq extends Model
{
    protected $table = 'faqs';

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM faqs ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO faqs (question, answer)
            VALUES (:question, :answer)
        ");
        return $stmt->execute([
            'question' => $data['question'],
            'answer'   => $data['answer'],
        ]);
    }

    public function updateFaq($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE faqs
            SET question = :question, answer = :answer
            WHERE id = :id
        ");
        return $stmt->execute([
            'id'       => $id,
            'question' => $data['question'],
            'answer'   => $data['answer'],
        ]);
    }

    public function deleteFaq($id)
    {
        $stmt = $this->db->prepare("DELETE FROM faqs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
