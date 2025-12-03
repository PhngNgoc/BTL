<!-- app/views/admin/dashboard/index.php -->
<h1 class="h3 mb-4">Dashboard</h1>

<div class="row row-cards">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="subheader">Tổng số sản phẩm</div>
                <div class="h1 mb-2">
                    <?= (int)($totalProducts ?? 0) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="subheader">Tổng số đơn hàng</div>
                <div class="h1 mb-2">
                    <?= (int)($totalOrders ?? 0) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="subheader">Đơn hàng đang chờ</div>
                <div class="h1 mb-2 text-warning">
                    <?= (int)($pendingOrders ?? 0) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Ghi chú</h3>
    </div>
    <div class="card-body">
        <p>Đây là khu vực quản trị dành cho quản trị viên TechMart:</p>
        <ul>
            <li>Quản lý danh sách sản phẩm, thêm/sửa/xóa.</li>
            <li>Quản lý đơn hàng, xem chi tiết và cập nhật trạng thái.</li>
            <li>Thống kê nhanh số lượng sản phẩm và đơn hàng.</li>
        </ul>
    </div>
</div>
