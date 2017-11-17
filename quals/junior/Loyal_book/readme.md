## Loyal book

### Description:
Every book is unique in its own way! Go and read the story of a brave man!

### Author: 
Lucian Nitescu

### Stats: 
2 points / 204 solvers

### Solution:  

The challenge started with 10 books in an arhive.

The competitor should perform diff (to see where is the difference) of first book with another book (or you can automate this process):

```
mehuser:~$ diff 0001.txt 0002.txt
2217c2217
< glimpse last summer at the Palais-Royal. Some of 
---
> glimpse last summer DC at the Palais-Royal. Some of 
```

=> DC

```
mehuser:~$ diff 0001.txt 0003.txt
3745c3745
< benches ranged along the walls, and in the centre of 
---
> benches ranged along TFthe walls, and in the centre of 
```

=> TF

```
mehuser:~$ diff 0001.txt 0004.txt
27559c27559
< And it must have been very strong to endure after 
---
> And it must h{ave been very strong to endure after
```

=> {

```
mehuser:~$ diff 0001.txt 0005.txt
27559c27559
< And it must have been very strong to endure after 
---
> And it must have been 7ba61 very strong to endure after 
```

=> 7ba61

```
mehuser:~$ diff 0001.txt 0006.txt
5933c5933
< and Frederick, feeling sleepy, was in no great haste 
---
> and Frederick, feeling sleepy, wa0cc5ds in no great haste 
```

=> 0cc5d

```
mehuser:~$ diff 0001.txt 0007.txt
18816c18816
< communicated to him ; and he had only two phrases : 
---
> communicated to him ; aa3966nd he had only two phrases : 
```

=> a3966

```
mehuser:~$ diff 0001.txt 0008.txt
25872c25872
< derstand. She longed for wealth, in order to crush 
---
> derstand. She longed fob7c64r wealth, in order to crush 
```

=> b7c64

```
mehuser:~$ diff 0001.txt 0009.txt
24835c24835
< They all took advantage of the occasion to denounce 
---
> They all took advantage a81c3 of the occasion to denounce 
```

=> a81c3

```
mehuser:~$ diff 0001.txt 0010.txt
749c749
< " Ha ! your chum ! " said Madame Moreau, with a 
---
> " Ha ! your chum ! " said Madame Morcfcdbeau, with a 
769c769
< barely maintained him. Made bitter by continuous 
---
> barely maintained him. 1b1d0 Made bitter by continuous 
3854c3854
< 82 GUSTAVE FLAUBERT 
---
> 82 GUSTAVE FLAUBERT 9e3de
7419c7419
< and the 'longshore-woman exclaimed : 
---
> and the 'longshore-woman exclaimed : 5ad11
9279c9279
< The advocate went on : 
---
> The advocate 89268 went on : 
11727c11727
< ceive either. 
---
> ceive either. bf0e6
14277c14277
< places at which the principals in the duel were to 
---
> places at 18ff7 which the principals in the duel were to 
20565c20565
< deur. 
---
> deur. 1f08}
```

=> cfcdb1b1d09e3de5ad1189268bf0e618ff71f08}


The flag is: DCTF{7ba610cc5da3966b7c64a81c3cfcdb1b1d09e3de5ad1189268bf0e618ff71f08}