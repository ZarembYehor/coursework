<?php

/** @var array $rows */
?>

<?php if (!empty($rows) && isset($rows[0]['id'], $rows[0]['name'], $rows[0]['email'], $rows[0]['address'], $rows[0]['phone'], $rows[0]['created_at'])) : ?>
    <div class="container mt-4">
        <h2>Інформація про замовлення #<?= $rows[0]['id'] ?></h2>
        <p><strong>Ім'я:</strong> <?= $rows[0]['name'] ?></p>
        <p><strong>Email:</strong> <?= $rows[0]['email'] ?></p>
        <p><strong>Адреса:</strong> <?= $rows[0]['address'] ?></p>
        <p><strong>Телефон:</strong> <?= $rows[0]['phone'] ?></p>
        <p><strong>Дата створення:</strong> <?= $rows[0]['created_at'] ?></p>

        <form method="POST" action="/order/formtoupdate">
            <input type="hidden" name="id" value="<?= $rows[0]['id'] ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($rows[0]['name']) ?>">
            <input type="hidden" name="email" value="<?= htmlspecialchars($rows[0]['email']) ?>">
            <input type="hidden" name="address" value="<?= htmlspecialchars($rows[0]['address']) ?>">
            <input type="hidden" name="phone" value="<?= htmlspecialchars($rows[0]['phone']) ?>">
            <input type="hidden" name="created_at" value="<?= htmlspecialchars($rows[0]['created_at']) ?>">
            <div class="row mt-4">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Оновити</button>
                </div>
            </div>
        </form>

        <form method="POST" action="/order/delete">
            <input type="hidden" name="id" value="<?= $rows[0]['id'] ?>">
            <div class="row mt-4">
                <div class="col">
                    <button type="submit" class="btn btn-danger btn-block">Видалити</button>
                </div>
            </div>
        </form>
    </div>
<?php else : ?>
    <?php if (isset($_POST['order_id'])) : ?>
        <div class="alert alert-danger" role="alert">
            Замовлення з ID <?= htmlspecialchars($_POST['order_id']) ?> не знайдено.
        </div>
    <?php endif; ?>
<?php endif; ?>