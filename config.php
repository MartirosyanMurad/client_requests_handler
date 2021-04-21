<?php
declare(strict_types=1);

define('SLEEP_BEFORE_START_PROCESS_MICRO_SECOND', (int) getenv('SLEEP_BEFORE_START_PROCESS_MICRO_SECOND') ?: 2000000); // 2 second
define('SLEEP_AFTER_START_PROCESS_MICRO_SECOND', (int) getenv('SLEEP_AFTER_START_PROCESS_MICRO_SECOND') ?: 200000000); // 200 second

define('HANDLER_FILE_NAME', (string) getenv('HANDLER_FILE_NAME') ?: '/var/log/client_requests/requests.txt');

define('LEAD_GENERATE_COUNT', (int) getenv('LEAD_GENERATE_COUNT') ?: 1000);
