<?php

header('content-type: text/html; charset=utf-8');


if (isset($_POST)) {
  if (!empty($_POST['text'])) {
    echo transformText($_POST['text']);
  } else {
    if ($_FILES['file']['name'] != '') {
      $response = '';
      $id = $_POST['id'];

      $fileurl = __DIR__ . '/' . $_FILES['file']['name'];
      move_uploaded_file($_FILES['file']['tmp_name'], $fileurl); //загружаем файл


      echo transformText(file_get_contents($fileurl));
    }
  }
}

function transformText($text) {
    $alf_eng = ['e', 't', 'o', 'p', 'a', 'k', 'c', 'x', 'b', 'm'];
    $alf = ['е', 'т', 'о', 'р', 'а', 'к', 'с', 'х', 'в', 'м'];

    $text = preg_replace("/[0-9;\.:]/", "", $text);
    $text = mb_strtolower($text);

  return $text;
}
?>


    <form action="https://badger-residence.ru/functions/transformText.php" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; width: 400px; margin: 100px auto;">
        <input type="file" name="file" id="file" laceholder="Прикрепите файл" style="margin-bottom: 20px;">
        <textarea name="text" id="text" placeholder="Введите текст" style="margin-bottom: 20px; height: 150px"></textarea>
        <input type="submit" value="Нормализовать">
    </form>

