<?php

require '../../boot.php';

Cart::removeFromCart($_GET['id']);

require '../partials/bucket.php';
