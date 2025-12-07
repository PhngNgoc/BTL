<?php

class Order extends Model
{
    public function getAll()
    {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getItems($orderId)
    {
        $stmt = $this->db->prepare(
            "SELECT oi.*, p.name 
             FROM order_items oi 
             JOIN products p ON oi.product_id = p.id
             WHERE order_id = :id"
        );
        $stmt->execute(['id' => $orderId]);
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE orders SET status=:st WHERE id=:id");
        $stmt->execute(['st' => $status, 'id' => $id]);
    }

public function createFromCart($info, $cart)
{
    // Tính tổng tiền từ giỏ
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    try {
        $this->db->beginTransaction();

        // Insert vào orders
        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id, shipping_name, shipping_phone, shipping_address, total_amount, status)
            VALUES (:user_id, :shipping_name, :shipping_phone, :shipping_address, :total_amount, 'pending')
        ");

        // Cho phép khách vãng lai -> user_id = NULL
        $userId = $info['user_id'] ?? null;

        $stmt->execute([
            'user_id'          => $userId,
            'shipping_name'    => $info['shipping_name'],
            'shipping_phone'   => $info['shipping_phone'],
            'shipping_address' => $info['shipping_address'],
            'total_amount'     => $total,
        ]);

        $orderId = $this->db->lastInsertId();

        // Insert từng dòng vào order_items
        // LƯU Ý: dùng đúng tên cột: unit_price, quantity, total_price
        $stmtItem = $this->db->prepare("
            INSERT INTO order_items (order_id, product_id, unit_price, quantity, total_price)
            VALUES (:order_id, :product_id, :unit_price, :quantity, :total_price)
        ");

        foreach ($cart as $item) {
            $lineTotal = $item['price'] * $item['qty'];

            $stmtItem->execute([
                'order_id'    => $orderId,
                'product_id'  => $item['id'],
                'unit_price'  => $item['price'],
                'quantity'    => $item['qty'],
                'total_price' => $lineTotal,
            ]);
        }

        $this->db->commit();
        return $orderId;

    } catch (Exception $e) {
        $this->db->rollBack();
        throw $e;
    }
}
// Đếm tất cả đơn hàng
public function countAll()
{
    $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
    return (int)$stmt->fetchColumn();
}

// Đếm đơn hàng theo trạng thái (vd: 'pending', 'completed' ...)
public function countByStatus($status)
{
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders WHERE status = :status");
    $stmt->execute([':status' => $status]);
    return (int)$stmt->fetchColumn();
}


}
