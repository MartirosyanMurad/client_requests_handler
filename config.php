<?php
declare(strict_types=1);

define('SLEEP_AFTER_START_PROCESS_SECOND', (int) getenv('SLEEP_AFTER_START_PROCESS_SECOND') ?: 3600); // 200 second

define('HANDLER_FILE_NAME', (string) getenv('HANDLER_FILE_NAME') ?: '/var/log/client_requests/requests.txt');

define('LEAD_GENERATE_COUNT', (int) getenv('LEAD_GENERATE_COUNT') ?: 1000);
