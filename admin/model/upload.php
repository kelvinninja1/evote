<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['xUpload']['tmp_name'])) {
        $sourcePath = $_FILES['xUpload']['tmp_name'];
        $targetPath = "../../assets/images/upload/" . $_FILES['xUpload']['name'];
        if (move_uploaded_file($sourcePath, $targetPath)) {
            header('location: ../index.php?page=kandidat');
            echo 1;
        }else{
            header('location: ../index.php?page=kandidat');
            echo 0;
        }
    }
}
?>