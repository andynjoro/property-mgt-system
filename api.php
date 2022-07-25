<?php
include __DIR__ . '/bootstrap.php';

include __DIR__ . '/PropertyService.php';

$PropertyService = new PropertyService();

$properties = $PropertyService->getAPIProperties();
