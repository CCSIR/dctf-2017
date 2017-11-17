## Are you brave?

### Description
You have a simple challenge, proove your web skills and get the flag.
Target: brave.dctf-quals-17.def.camp

*Update 10:00 EEST: Check index.php~.*

### Author: 
Andrei

### Stats: 
70 points / 76 solvers

### Solution

1. You get the source code of index.php by accessing index.php~.
2. The task is to perform an sql injection by bypassing the filters proposed by the organisers. There are many ways to do this:
```
index.php?id=`id`;%00
index.php?id=0xc-0xa;%00
```