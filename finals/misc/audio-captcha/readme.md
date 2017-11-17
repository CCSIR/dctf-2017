## audio-captcha

### Description

Last some of you proved they have good skills of breaking captchas based on images, but what about sounds? 
Target: https://audio-captcha.dctf-f1nals-2017.def.camp/ 

### Author: 
Andrei

### Stats: 
382 points / 5 solvers

### Solution

You get a link to a webpage that has a voice captcha and you need to solve it many times without any failure in a short amount of time. Althought the sounds are pre-recorded from Google Translate, products like Google Speech API are useless.

The main idea would be to record as many sounds as possible and do some pattern analysis on cuts. This is possible because you receive .wav files (which are bassically row sounds) and moreover, you will only have 16 possibilities of characters (from 0 to 9 and a to f).

A full write-up was published by the finalist team p4 [here](https://github.com/p4-team/ctf/tree/master/2017-11-09-defcamp-final/audio_captcha).