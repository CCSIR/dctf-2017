<?php

header("Content-Security-Policy: default-src 'none'; img-src 'self' *.imgur.com *.ibb.co; script-src 'self'; connect-src 'self'; style-src 'self' fonts.googleapis.com fonts.gstatic.com 'unsafe-inline'; font-src 'self' fonts.gstatic.com  fonts.googleapis.com;");
#header("X-Content-Type-Options: sniff");
$db = mysqli_connect('localhost', 'web_llc', '','web_llc');
$file_dir = 'file-secure-1274812412';

$root_url='https://llc.dctf-quals-17.def.camp/';

