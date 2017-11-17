## A thousand words

### Description:
I bet your eye can spot the original photo!

### Author: 
Lucian Nitescu

### Stats: 
2 pointa / 165 solvers

### Solution:  

The competitors received a zip with 1154 images and they had to get the original one.

The very easy solution because the flag is written with exiftools:

```
mehuser:~$ strings *.png | grep DCTF{
DCTF{162d6e3865b2be32851fb8bd3cca73bdc1a052f9da75d8680c471eb45af522df}
``` 

The hard way:

```
mehuser:~$ md5sum *.png
6124bbaf600e186e41716697b8108404  0001.png
6124bbaf600e186e41716697b8108404  0002.png
6124bbaf600e186e41716697b8108404  0003.png
e91e735b1cb99fa6f9d36f1c38a1b18b  0004.png
6124bbaf600e186e41716697b8108404  0005.png
6124bbaf600e186e41716697b8108404  0006.png
6c2393a1042c8f3c721d2f882aa59186  0007.png
e91e735b1cb99fa6f9d36f1c38a1b18b  0008.png
37e6495fb30e87d1b47913f8051c848c  0009.png
e91e735b1cb99fa6f9d36f1c38a1b18b  0010.png
<sniiiiip>
d880f1b14c94202fcb1df30d6ac46fa4  1022.png
c3c4f45abccc36a595487f4f8ef52cff  1023.png
4a5a71fb20c780ab1e686ef533720008  1024.png
<sniiiiip>
960b71563f44ec4f4fda4b7e1fe8cda1  1153.png
5a611bb3ab368f9addf3a75be45e45e6  1154.png
```

And you shall see that "4a5a71fb20c780ab1e686ef533720008  1024.png" is unique.
Then you should do this:

```
mehuser:~$ strings 1024.png | grep DCTF
DCTF{162d6e3865b2be32851fb8bd3cca73bdc1a052f9da75d8680c471eb45af522df}
``` 

The flag is: DCTF{162d6e3865b2be32851fb8bd3cca73bdc1a052f9da75d8680c471eb45af522df}
