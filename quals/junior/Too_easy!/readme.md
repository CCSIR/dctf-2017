## Too easy!

### Description:
Ah man... I hate when I forget my password... Do you know it?

### Author: 
Lucian Nitescu

### Stats: 
1 point / 273 solvers

### Solution:  

The challenge started with a simple 64-bit ELF called looksgood.exe.

```
mehuser:~$ file looksgood.exe 
looksgood.exe: ELF 64-bit LSB executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, for GNU/Linux 2.6.32, BuildID[sha1]=5895d074bfc9c7835b9e8f06face0451e04c5004, not stripped
```

After that you have to give him some permissions:

```
mehuser:~$ chmod +x looksgood.exe 
```

After that just run it!

```
mehuser:~$ ./looksgood.exe 
Enter password:what password?
Wrong password
```

As the description told us we have to get the password! Simple task, let's get all the writable strings of the file.

```
mehuser:~$ strings ./looksgood.exe 
/lib64/ld-linux-x86-64.so.2
CyIk
libstdc++.so.6
< the output was sniped here >
44435446H
7b366436H
65313736H
30633161H
33616539H
65346564H
65323435H
37643864H
32346230H
62636632H
30376561H
33376538H
33646362H
34643039H
65326437H
34656639H
35386232H
ATSH
[A\]
AWAVA
AUATL
[]A\A]A^A_
strongpassword_as_a_pro
Enter password:
 ... now decrypt hex.
Wrong password
;*3$"
zPLR

< the output was sniped here >
```

At this point we got the password (strongpassword_as_a_pro) and something else you are going to see in the next step (those hex):

```
mehuser:~$ ./looksgood.exe 
Enter password:strongpassword_as_a_pro
444354467b366436653137363063316133616539653465646532343537643864323462306263663230376561383337653833646362346430396532643734656639353862327d ... now decrypt hex
```

Yes you could also decrypt the hex strings of the flag without getting the password!

Open a python console and type:

```
mehuser:~$ python
Python 2.7.12 (default, Nov 19 2016, 06:48:10) 
[GCC 5.4.0 20160609] on linux2
Type "help", "copyright", "credits" or "license" for more information.
>>> buf = "444354467b366436653137363063316133616539653465646532343537643864323462306263663230376561383337653833646362346430396532643734656639353862327d"
>>> buf.decode("hex")
'DCTF{6d6e1760c1a3ae9e4ede2457d8d24b0bcf207ea837e83dcb4d09e2d74ef958b2}'
>>> 
```

And you got your flag!

DCTF{6d6e1760c1a3ae9e4ede2457d8d24b0bcf207ea837e83dcb4d09e2d74ef958b2}