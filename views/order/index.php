<?php
/** @var array $rows */
use models\Users;
use models\Order;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_orders'])) {
    header('Content-Type: application/json');
    if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
        http_response_code(403);
        echo json_encode(['error' => 'Access denied']);
        exit;
    }
    $orders = Order::getAllOrders();
    echo json_encode($orders);
    exit;
}

$rows = Order::getAllOrders();

function renderOrderTable($rows) {
    $values = array_values($rows);
    ob_start();
    ?>
    <div class="container mt-4">
        <h2>Список замовлень</h2>
        <table class="table table-bordered" id="orders-table">
            <thead>
                <tr>
                    <th>ID Замовлення</th>
                    <th>Ім'я</th>
                    <th>Email</th>
                    <th>Адреса</th>
                    <th>Телефон</th>
                    <th>Дата створення</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($values); $i++): ?>
                    <tr>
                        <td><?= htmlspecialchars($values[$i]['id']) ?></td>
                        <td><?= htmlspecialchars($values[$i]['name']) ?></td>
                        <td><?= htmlspecialchars($values[$i]['email']) ?></td>
                        <td><?= htmlspecialchars($values[$i]['address']) ?></td>
                        <td><?= htmlspecialchars($values[$i]['phone']) ?></td>
                        <td><?= htmlspecialchars($values[$i]['created_at']) ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <div class="mt-4">
            <form method="POST" action="/order/showorder">
                <label for="order_id">Введіть ID замовлення:</label>
                <input type="text" id="order_id" name="order_id">
                <button type="submit" class="btn btn-primary">Переглянути</button>
            </form>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?>
<div id="orders-container">
    <?= renderOrderTable($rows) ?>
</div>
<script>
    function fetchOrders() {
        fetch('', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ fetch_orders: 1 })
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'Access denied') {
            console.error('Error fetching orders: Access denied');
            return;
        }
        document.getElementById('orders-container').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching orders:', error);
    });
}

function updateOrders() {
    setInterval(fetchOrders, 10000);
}

document.addEventListener('DOMContentLoaded', function() {
    fetchOrders();
    updateOrders();
});

</script>
