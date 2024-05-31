<?php
/** @var array $rows Записи товарів*/
$this->Title = '';
?>
<div class="container mt-5">
    <style>
        .card-img-container {
            width: 100%;
            height: 500px; 
            overflow: hidden;
        }

        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-body {
            height: 300px;
            overflow-y: auto;
        }

        .btn-container {
            position: relative;
        }

        .btn-container .btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-start;
        }
    </style>
    <h1 class="mb-4">Пропозиції</h1>

    <form method="post" action="/drinks/filter">
        <div class="filter-container">
            <div class="mb-4" style="flex-grow: 1;">
                <input type="text" name="search_name" class="form-control" placeholder="Пошук за назвою" value="<?php echo isset($_POST['search_name']) ? htmlspecialchars($_POST['search_name']) : ''; ?>">
            </div>
            <div class="mb-4">
                <h5>Фільтрувати за категорією:</h5>
                <?php 
                $categories = [
                    ['id' => 1, 'name' => 'Газовані напої'],
                    ['id' => 2, 'name' => 'Сік'],
                    ['id' => 5, 'name' => 'Вода'],
                    ['id' => 6, 'name' => 'Алкоголь'],
                    ['id' => 10, 'name' => 'Чай/кава']
                ];

                foreach ($categories as $category): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category_id" id="category<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" <?php if (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) echo 'checked'; ?>>
                        <label class="form-check-label" for="category<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-4">
                <h5>Сортувати за ціною:</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sort_price" id="priceAsc" value="asc" <?php if (isset($_POST['sort_price']) && $_POST['sort_price'] == 'asc') echo 'checked'; ?>>
                    <label class="form-check-label" for="priceAsc">
                        Від найнижчої до найвищої
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sort_price" id="priceDesc" value="desc" <?php if (isset($_POST['sort_price']) && $_POST['sort_price'] == 'desc') echo 'checked'; ?>>
                    <label class="form-check-label" for="priceDesc">
                        Від найвищої до найнижчої
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <h5>Фільтрувати за об'ємом:</h5>
                <select class="form-select" name="volume">
                    <option value="">Всі</option>
                    <option value="0.5" <?php if (isset($_POST['volume']) && $_POST['volume'] == '0.5') echo 'selected'; ?>>0.5 л</option>
                    <option value="1" <?php if (isset($_POST['volume']) && $_POST['volume'] == '1') echo 'selected'; ?>>1 л</option>
                    <option value="1.5" <?php if (isset($_POST['volume']) && $_POST['volume'] == '1.5') echo 'selected'; ?>>1.5 л</option>
                    <option value="2" <?php if (isset($_POST['volume']) && $_POST['volume'] == '2') echo 'selected'; ?>>2 л</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Фільтрувати</button>
        <a href="/drinks" class="btn btn-secondary mt-3">Очистити фільтр</a>
    </form>

    <div class="row mt-4">
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <?php if (!empty($row)): ?>
                    <?php foreach ($row as $key => $value): ?>
                        <?php if (is_array($value)): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="btn-container">
                                        <a href="#" class="btn btn-primary">Купити</a>
                                    </div>
                                    <div class="card-img-container">
                                        <img src="<?php echo $value['image_url']; ?>" class="card-img-top" alt="<?php echo $value['name']; ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $value['name']; ?></h5>
                                        <p class="card-text">
                                            <strong>Ціна:</strong> <?php echo $value['price']; ?> грн.<br>
                                            <strong>Об'єм:</strong> <?php echo $value['volume']; ?><br>
                                            <strong>Виробник:</strong> <?php echo $value['manufacturer']; ?><br>
                                            <strong>Опис товару:</strong> <?php echo $value['description']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php echo $value; ?><br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Немає доступних напоїв.</p>
        <?php endif; ?>
    </div>
</div>
