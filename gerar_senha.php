<?php
$senha = "1234";
$hash_admin = password_hash($senha, PASSWORD_DEFAULT);
$hash_usuario = password_hash($senha, PASSWORD_DEFAULT);

// echo e para aparecer na tela
echo "Hash para admin: " . $hash_admin . "\n";
echo "Hash para usuario: " . $hash_usuario . "\n";
echo $senha;