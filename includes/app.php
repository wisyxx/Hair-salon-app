<?php 

require 'functions.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

// DB connection
use Model\ActiveRecord;
ActiveRecord::setDB($db);