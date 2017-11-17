## Adversarial

### Description
Do you know how vulnerable can be a binary classifier? 
Target: adversarial.dctf-f1nals-2017.def.camp:6666 
https://dctf.def.camp/finals-2017-lpmjksalfka/adversarial-public.py 

### Author: 
Andrei

### Stats: 
356 points / 11 solvers

### Solution

The goal is to provide a vector of 100 values from range (-1,1) for which the ```1 - get_probability(x)``` function calculated on the dot product between our vector and the selected matrix row will be < 0.001.

P4 team [published](https://github.com/p4-team/ctf/tree/master/2017-11-09-defcamp-final/adversarial) write-up for this chall.
