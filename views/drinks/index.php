<?php
/** @var array $rows Записи товарів */
/** @var int $category_id Вибрана категорія */
/** @var string $sort_price Вибраний порядок сортування ціни */
/** @var string $volume Вибраний об'єм */
/** @var string $search_name Введене значення для пошуку */
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
                <input type="text" name="search_name" class="form-control" placeholder="Пошук за назвою" value="<?php echo htmlspecialchars($search_name ?? ''); ?>">
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
                        <input class="form-check-input" type="radio" name="category_id" id="category<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" <?php if (isset($category_id) && $category_id == $category['id']) echo 'checked'; ?>>
                        <label class="form-check-label" for="category<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-4">
                <h5>Сортувати за ціною:</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sort_price" id="priceAsc" value="asc" <?php if (isset($sort_price) && $sort_price == 'asc') echo 'checked'; ?>>
                    <label class="form-check-label" for="priceAsc">
                        Від найнижчої до найвищої
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sort_price" id="priceDesc" value="desc" <?php if (isset($sort_price) && $sort_price == 'desc') echo 'checked'; ?>>
                    <label class="form-check-label" for="priceDesc">
                        Від найвищої до найнижчої
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <h5>Фільтрувати за об'ємом:</h5>
                <select class="form-select" name="volume">
                    <option value="">Всі</option>
                    <option value="0.2">0.2 л</option>
                    <option value="0.25">0.25 л</option>
                    <option value="0.33">0.33 л</option>
                    <option value="0.35">0.35 л</option>
                    <option value="0.355">0.355 л</option>
                    <option value="0.46">0.46 л</option>
                    <option value="0.5">0.5 л</option>
                    <option value="0.7">0.7 л</option>
                    <option value="0.75">0.75 л</option>
                    <option value="0.95">0.95 л</option>
                    <option value="1">1.0 л</option>
                    <option value="1.25">1.25 л</option>
                    <option value="1.5">1.5 л</option>
                    <option value="1.75">1.75 л</option>
                    <option value="2">2.0 л</option>
                    <option value="3">3.0 л</option>
                    <option value="20 пакетів">20 пакетів</option>
                    <option value="24 пакети">24 пакети</option>
                    <option value="200 г">200 г</option>
                    <option value="250 г">250 г</option>
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
                                        <form method="post" action="/drinks/addToCart">
                                            <input type="hidden" name="product_id" value="<?php echo $value['id']; ?>">
                                            <button type="submit" class="btn btn-primary">Купити</button>
                                        </form>
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