<?php

/** @var array $rows */
?>
<div class="container mt-5">
    <h1>Оновлення інформації про напій</h1>
    <form method="post" action="/drinks/update">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($rows[0]['id']); ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($rows[0]['name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($rows[0]['price']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="volume" class="form-label">Об'єм</label>
            <input type="text" class="form-control" id="volume" name="volume" value="<?php echo htmlspecialchars($rows[0]['volume']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="manufacturer" class="form-label">Виробник</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($rows[0]['manufacturer']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($rows[0]['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL зображення</label>
            <input type="url" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($rows[0]['image_url']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Кількість на складі</label>
            <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="<?php echo htmlspecialchars($rows[0]['stock_quantity']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Оновити інформацію</button>
    </form>
</div>