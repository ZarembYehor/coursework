<?php
/** @var array $rows Записи товарів*/
$this->Title = 'Товар';
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
    </style>
    <h1 class="mb-4">Пропозиції</h1>
    <div class="row">
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