<?php

//mulai session
session_start();

// hilangkan session yang sudah selesai
unset($_SESSION['id_admin']);
unset($_SESSION['username']);
unset($_SESSION['password']);


session_destroy();

echo "<script>
	document.location='index.php';
      </script>";
