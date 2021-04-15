<?php
  if (isset($_POST['ip-submit'])) {
    header('Location: index.php?ip='.$_POST['ip']);
  } else {
    header('Location: index.php');
  }
?>