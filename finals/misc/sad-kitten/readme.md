## Sad Kitten

### Description

A kitten is sad because it can't find its flag. Can you help it? 

### Author: 
Dogtors

### Stats: 
391 points / 3 solvers

### Solution

* Open jpeg file using a hex editor and find the of the image. Then you will see there is another file that needs to be extracted.
* Based on the new file headers you can see there is a LUKS (Linux Unified Key Setup). 
* The key to decrypt is the second comment from the initial JPEG
* After mounting the disk image you will find another .png file
* The .png file is a classic problem of steganography which hides in LSB a second image that contains the flag