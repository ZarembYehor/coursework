<?php
/** @var array $cart Товари у кошику */
/** @var float $total Загальна вартість */
$this->Title = '';
?>
<div class="container mt-5">
    <h1 class="mb-4">Кошик</h1>
    <?php if (!empty($cart)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Назва</th>
                    <th scope="col">Ціна</th>
                    <th scope="col">Об'єм</th>
                    <th scope="col">Виробник</th>
                    <th scope="col">Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $index => $product): ?>
                    <tr>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?> грн.</td>
                        <td><?php echo $product['volume']; ?></td>
                        <td><?php echo $product['manufacturer']; ?></td>
                        <td>
                            <form method="post" action="/drinks/removeFromCart">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Загальна вартість: <?php echo $total; ?> грн.</h3>
        <form method="post" action="/drinks/clearCart">
            <button type="submit" class="btn btn-warning">Очистити кошик</button>
        </form>
    <?php else: ?>
        <p>Ваш кошик порожній.</p>
    <?php endif; ?>
</div>
