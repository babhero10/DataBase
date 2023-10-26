<?php
require('../Model/RegistrationDB.php');
require('../Model/UserModel.php');

$db = getDatabaseConnection();
$userModel = new UserModel($db);

$users = $userModel->getRows();
echo $users[0][1];

// Pass $users to the View or perform other actions

?>