<?php

if (!defined('CONST_ROOM_STATUS')) {
    define('CONST_ROOM_STATUS',[
        1 => 'Blocked', // for maintainance
        2 => 'Reserved',
        3 => 'Available',
        4 => 'Occupied',
        5 => 'Checkout',
        6 => 'Hold', // for unconfirmed web reservations
        7 => 'Deleted',
    ]);
}


?>
