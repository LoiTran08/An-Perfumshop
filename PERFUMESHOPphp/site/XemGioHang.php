<?php
/**
 * Created by Loi_Tan
 * User: Tran Huu Loi
 * 
 * 
 */
    session_start();ob_start();

if(isset($_SESSION['cart']) && $_SESSION['cart']!= null)
{
    echo "<pre>";
    print_r($_SESSION['cart']);
}
else echo "rong";

?>

