<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 13:34
 */

function uploadFile()
{
    $tmp_name = $_FILES["image"]["tmp_name"];
    $name = basename($_FILES["image"]["name"]);
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $newName = sha1(uniqid() . $name) . "." . $extension;
    move_uploaded_file($tmp_name, "uploads/$newName");

    return $newName;
}
