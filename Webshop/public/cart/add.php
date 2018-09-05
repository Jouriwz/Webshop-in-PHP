<?php

require '../../boot.php';

Cart::addToCart($_GET['id']);

require '../partials/bucket.php';
