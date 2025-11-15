<?php

function render($view, $arResult = '', $title = '', $pagination = '')
{
  include_once(__DIR__ . "/header.php");
  include_once(__DIR__ . "/view/$view.php");
  include_once(__DIR__ . "/footer.php");
}

function replacement($str)
{
  switch ($str) {
    case "men":
      return "Мужчинам";
      break;

    case "woman":
      return "Женщинам";
      break;

    case "children":
      return "Детям";
      break;

    case "new":
      return "Новинки";
      break;
  }
}


function sendMail($title,  $message, $mail)
{

  $mailSMTP = new SendMailSmtpClass('tte577es7@yandex.ru', 'INordicSchool', 'ssl://smtp.yandex.ru', 465, "UTF-8");


  $from = array(
    "Александр",
    "tte577es7@yandex.ru"
  );

  $result =  $mailSMTP->send($mail,  $title,  $message, $from);

  return $result;
}

function resultSucces()
{
  echo "<script>alert('Вы успешно зарегестрировались. Письмо с подтверждением авторизации, отправлено вам на почту.')</script>";
}
