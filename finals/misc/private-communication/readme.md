## Private Communication

### Description

I've tried to prank one of my "security" specialists and see what images is sending to his girlfriend. However, it seems he learned her how to use encrypted files. Can you help me to retrieve this image?  

### Author: 
Andrei

### Stats: 
356 points / 11 solvers

### Solution

Most of the .png file have a common header which is almost always ```89 50 4E 47 0D 0A 1A 0A 00 00 00```. Thus, we can try doing a simple xor against this, recover the password and then simply continue doing XOR against the remaining file content.
