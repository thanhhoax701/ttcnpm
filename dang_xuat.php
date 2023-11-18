<?php
session_start();

// Hủy toàn bộ session
session_unset();
session_destroy();

echo json_encode(array("success" => true));
exit();
?>
