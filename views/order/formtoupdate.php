<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'created_at' => $_POST['created_at']
    ];
}
?>

<div class="container mt-4">
    <h2>Оновити замовлення #<?= htmlspecialchars($order['id']) ?></h2>
    <form method="POST" action="/order/update" class="bg-light p-4 rounded shadow-sm" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
        <div class="form-group">
            <label for="name">Ім'я</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($order['name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($order['email']) ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Адреса</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($order['address']) ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($order['phone']) ?>" required pattern="\+?\d{10,15}">
        </div>
        <div class="form-group">
            <label for="created_at">Дата створення</label>
            <input type="text" class="form-control" id="created_at" name="created_at" value="<?= htmlspecialchars($order['created_at']) ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
    </form>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const address = document.getElementById('address').value;
            const phone = document.getElementById('phone').value;

            if (name.trim() === '') {
                alert('Будь ласка, введіть ім\'я.');
                return false;
            }

            if (email.trim() === '') {
                alert('Будь ласка, введіть email.');
                return false;
            }

            if (!validateEmail(email)) {
                alert('Будь ласка, введіть дійсний email.');
                return false;
            }

            if (address.trim() === '') {
                alert('Будь ласка, введіть адресу.');
                return false;
            }

            if (phone.trim() === '') {
                alert('Будь ласка, введіть телефон.');
                return false;
            }

            if (!validatePhone(phone)) {
                alert('Будь ласка, введіть дійсний телефон.');
                return false;
            }

            return true;
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePhone(phone) {
            const re = /^\+?\d{10,15}$/;
            return re.test(phone);
        }
    </script>

</div>