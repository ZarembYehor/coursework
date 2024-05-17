<?php
/** @var string $error_message Повідомлення про помилку*/
use core\Core;
$this->Title = 'Реєстрація нового користувача';
?>
<form method="post" action="">
    <?php if(!empty($error_message)) :?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message ?>
        </div>
    <?php endif?>
  <div class="mb-3">
    <label for="inputEmail" class="form-label">Логін/email</label>
    <input name="login" value="<?=$this->controller->post->get('login') ?>" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="inputPassword" class="form-label">Пароль</label>
    <input name="password" type="password" class="form-control" id="inputPassword">
  </div>
  <div class="mb-3">
    <label for="inputPassword2" class="form-label">Пароль(ще раз)</label>
    <input name="password2" type="password" class="form-control" id="inputPassword2">
  </div>
  <div class="mb-3">
    <label for="inputLastName" class="form-label">Прізвище</label>
    <input name="lastname" value="<?=$this->controller->post->get('lastname') ?>"  type="text" class="form-control" id="inputLastName">
  </div>
  <div class="mb-3">
    <label for="inputFirstName" class="form-label">Ім'я</label>
    <input name="firstname" value="<?=$this->controller->post->get('firstname') ?>" type="text" class="form-control" id="inputFirstName">
  </div>
  <button type="submit" class="btn btn-primary">Зареєструватись</button>
</form>