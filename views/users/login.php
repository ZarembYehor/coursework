<?php

/** @var string $error_message Повідомлення про помилку*/
$this->Title = 'Вхід на сайт';
?>
<div class="container my-5">
    <form method="post" action="">
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message ?>
            </div>
        <?php endif ?>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Логін/email</label>
            <input name="login" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="inputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
</div>