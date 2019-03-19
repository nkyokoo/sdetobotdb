<?php
 include "../backend/mailer.php";
  $mailfactory = new Mailer();

  $mailfactory->__constructMail($get['title'], $get['content']);
