## Forgot my Key

### Description
I forgot my flag & key. Help me recover them.
```
/* 
	5616f5962674d26741d2810600a6c5647620c4e3d2870177f09716b2379012c342d3b584c5672195d653722443f1c39254360007010381b721c741a532b03504d2849382d375c0d6806251a2946335a67365020100f160f17640c6a05583f49645d3b557856221b2
*/
function my_encrypt($flag, $key) {
	$key = md5($key);
	$message = $flag . "|" . $key;

	$encrypted = chr(rand(0, 126));
	for($i=0;$i<strlen($message);$i++) {
		$encrypted .= chr((ord($message[$i]) + ord($key[$i % strlen($key)]) + ord($encrypted[$i])) % 126);
	}
	$hexstr = unpack('h*', $encrypted);
	return array_shift($hexstr);
}
```

### Author: 
Andrei

### Stats: 
50 points / 110 solvers

### Solution

There are two ways to solve this problem: either by considering that you know the first 5 chars (DCTF{) and the last } or either by considering that we know the character between the merged flag & key which is |. From this you just need to step by step obtain each unknown characters.
