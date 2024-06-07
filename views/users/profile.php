<div class="container mt-4">
    <h2>Профіль користувача</h2>
    <form method="POST" action="/users/updateProfile">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="login">Логін</label>
                    <input type="text" class="form-control" id="login" name="login" value="<?= htmlspecialchars($_SESSION['user']['login']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($_SESSION['user']['password']) ?>">
                </div>
                <div class="form-group">
                    <label for="firstName">Ім'я</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($_SESSION['user']['firstName']) ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Прізвище</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($_SESSION['user']['lastName']) ?>">
                </div>
                <button type="submit" class="btn btn-primary">Оновити</button>
            </div>
        </div>
    </form>

    <h3 class="mt-4">Ваші замовлення</h3>
    <?php if (!empty($rows)) : ?>
        <table class="table table-bordered">
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
                <?php for ($i = 0; $i < count($rows[0]); $i++) : ?>
                    <tr>
                        <td><?= $rows[0][$i]['id'] ?></td>
                        <td><?= $rows[0][$i]['name'] ?></td>
                        <td><?= $rows[0][$i]['email'] ?></td>
                        <td><?= $rows[0][$i]['address'] ?></td>
                        <td><?= $rows[0][$i]['phone'] ?></td>
                        <td><?= $rows[0][$i]['created_at'] ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>У вас немає замовлень.</p>
    <?php endif; ?>
</div>