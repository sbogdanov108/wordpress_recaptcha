<?php
/*
  Template Name: feedback
*/
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
  $userSubject = $_POST['userSubject'];
  $userName = $_POST['userName'];
  $userEmail = $_POST['userEmail'];
  $userMessage = $_POST['userMessage'];
  
  $result = feedback($userSubject, $userName, $userEmail, $userMessage);
}
?>

<? get_header() ?>

<div class="container">
  <div class="row">
    <section class="col-sm-9 col-md-9">
      <h1>Напишите мне</h1>

      <form class="form-horizontal" id="form-feedback" action="<?= get_page_link() ?>" method="post">
        <? if (isset($result)) : ?>
          <div class="form-group">
            <div class="col-xs-9 col-sm-9 col-md-9">
              <? if ($result === false || is_array($result)) : ?>
                <div class="alert alert-danger">Произошла ошибка при отправке сообщения.</div>
              <? else : ?>
                <div class="alert alert-success">Сообщение успешно оправлено. Благодарю!</div>
              <? endif ?>
            </div>
          </div>
        <? endif ?>

        <div class="form-group">
          <div class="col-xs-9 col-sm-9 col-md-9">
            <input type="text" class="form-control" id="topic" name="userSubject" value="<?= isset($userSubject) ? esc_attr($userSubject) : '' ?>">
          </div>

          <label for="topic" class="col-xs-3 col-sm-3 col-md-3 control-label">Тема</label>
        </div>

        <div class="form-group">
          <div class="col-xs-9 col-sm-9 col-md-9">
            <input type="text" class="form-control" id="name" name="userName" value="<?= isset($userName) ? esc_attr($userName) : '' ?>">
          </div>

          <label for="name" class="col-xs-3 col-sm-3 col-md-3 control-label">Имя</label>
        </div>

        <div class="form-group">
          <div class="col-xs-9 col-sm-9 col-md-9">
            <input type="email" required class="form-control" id="email" name="userEmail" value="<?= isset($userEmail) ? esc_attr($userEmail) : '' ?>">
            <?= !empty($result['userEmail']) ? "<span class='help-block error'>{$result[ 'userEmail' ]}</span>" : '' ?>
          </div>

          <label for="email" class="col-xs-3 col-sm-3 col-md-3 control-label">E-mail <span>*</span></label>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <textarea class="form-control" id="message" name="userMessage" required placeholder="Сообщение..."><?= isset($userMessage) ? esc_textarea($userMessage) : '' ?></textarea>
            <?= !empty($result['userMessage']) ? "<span class='help-block error'>{$result[ 'userMessage' ]}</span>" : '' ?>
          </div>
        </div>

        <div class="help-block help-required">
          <span>*</span> обязательно к заполнению
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <input type="submit" class="btn btn-default" id="form-feedback-send" name="send" value="Отправить">
          </div>
        </div>
      </form>
    </section>
  </div>
</div>

<? get_footer();
