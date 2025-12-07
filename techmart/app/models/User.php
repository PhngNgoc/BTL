<?php

class User extends Model
{
    // Tìm user theo email
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM users WHERE email = :email LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tìm user theo username
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM users WHERE username = :username LIMIT 1
        ");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo user mới
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, password_hash, email, full_name, phone, address, role, status, created_at)
            VALUES (:username, :password_hash, :email, :full_name, :phone, :address, :role, 'active', NOW())
        ");

        return $stmt->execute([
            ':username'      => $data['username'],
            ':password_hash' => $data['password_hash'],
            ':email'         => $data['email'],
            ':full_name'     => $data['full_name'] ?? null,
            ':phone'         => $data['phone'] ?? null,
            ':address'       => $data['address'] ?? null,
            ':role'          => $data['role'] ?? 'user'
        ]);
    }
}
