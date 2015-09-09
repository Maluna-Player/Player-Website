<?php

if (isset($_SESSION['id']))
{
    include('views/connectedHeader_V.php');
}
else
{
    include('views/guestHeader_V.php');
}
