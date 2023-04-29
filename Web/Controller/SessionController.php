<?php
function Session($FIRST,$EMAIL,$POSITION,$GENDER,$ID,$PHONE,$BIRTHDAY,$ABOUT,$STATUS)
{
    session_start();
    $_SESSION['user_name'] = $FIRST;
    $_SESSION['user_email'] = $EMAIL;
    $_SESSION['user_position'] = $POSITION;
    $_SESSION['user_gender'] = $GENDER;
    $_SESSION['user_id'] = $ID;
    $_SESSION['user_phone'] = $PHONE;
    $_SESSION['user_date'] = $BIRTHDAY;
    $_SESSION['user_about'] = $ABOUT;
    $_SESSION['user_status'] = $STATUS;
}
?>