<?php

session_start();

include_once('class/DbConnection.class.php');

if (isset($_GET['page']) && is_file('controllers/' . $_GET['page'] . '_C.php'))
{
    include('controllers/' . $_GET['page'] . '_C.php');
}
else
{
    include('controllers/home_C.php');
}
