<?php

/** @var string $error_message Повідомлення про помилку*/

use core\Core;
?>
<div class="container mt-5">
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message ?>
        </div>
    <?php endif ?>
    <h1>Додати новий напій</h1>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="volume" class="form-label">Об'єм</label>
            <input type="text" class="form-control" id="volume" name="volume" required>
        </div>
        <div class="mb-3">
            <label for="manufacturer" class="form-label">Виробник</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
        </div>
        <div class="mb-3">
            <label for="manufacturer" class="form-label">ID категорії</label>
            <input type="text" class="form-control" id="category_id" name="category_id" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">URL зображення</label>
            <input type="url" class="form-control" id="image_url" name="image_url" required>
        </div>
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Кількість на складі</label>
            <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Додати</button>
    </form>
</div>