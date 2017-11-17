## No that kind of network 

### Description:
I like to write and move all around the world. But do you know my story?

### Author: 
Lucian Nitescu

### Stats: 
1 point  / 227 solvers

### Solution:  

The challenge started with https://dctf.def.camp/quals-2017-kalskflsafkl/kingofstone.pcapng (a pcapng file).

At this point you have to use wget to get your file:

```
mehuser:~$ wget https://dctf.def.camp/quals-2017-kalskflsafkl/kingofstone.pcapng
--2017-10-02 14:13:26--  https://dctf.def.camp/quals-2017-kalskflsafkl/kingofstone.pcapng
Resolving dctf.def.camp (dctf.def.camp)... 108.61.199.109
Connecting to dctf.def.camp (dctf.def.camp)|108.61.199.109|:443... connected.
HTTP request sent, awaiting response... 200 OK
Length: 5985336 (5,7M)
Saving to: ‘kingofstone.pcapng’

kingofstone.pcapng  100%[===================>]   5,71M  3,71MB/s    in 1,5s    

2017-10-02 14:13:28 (3,71 MB/s) - ‘kingofstone.pcapng’ saved [5985336/5985336]

```

After that you could just open the file in whireshark, figure out is a record using an USB monitor and find the flag at frame 2887 (2887 19.986578 host 1.73.2 USBMS 576 CSI: Data Out LUN: 0x00 (Write(10) Request Data) or you could just do a simple commad as:

```
mehuser:~$ strings ./kingofstone.pcapng  | grep DCTF
DCTF{2d9895ecea1081b2241398d1b2c94eaf5be3bfaffec1ad946ed0a68ae95f8ed9}
```
Now use the flag!

DCTF{2d9895ecea1081b2241398d1b2c94eaf5be3bfaffec1ad946ed0a68ae95f8ed9}