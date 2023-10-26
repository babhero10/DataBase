<?php
require('../Model/RegistrationDB.php');
require('../Model/UserModel.php');

$db = getDatabaseConnection();

$userModel = new UserModel($db);

$users = $userModel->getRows();

foreach ($users as $user) {
    (($user))->print();
}


// Pass $users to the View or perform other actions

?>