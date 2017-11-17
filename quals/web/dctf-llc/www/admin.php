<?php

if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1','10.13.37.12'])) {
	echo 'DCTF{'.hash('sha256','there-is-no-security-with-bad-csp').'}';
}