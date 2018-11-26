<?php
require_once dirname(__FILE__) . '/src/AmazonPhotoFormatter.php';

$amazonPhotoRenamer = new \amazonphotoformatter\AmazonPhotoFormatter(dirname(__FILE__));
$amazonPhotoRenamer->format();