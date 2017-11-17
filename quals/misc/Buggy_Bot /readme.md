## Buggy Bot

### Description:
You know that sometime a bot can beat you at a game of chess. But today that but is also bugged.

Update: The code for the Buggy Bot has been updated to give more explicit information about the task and the flag has been also modified, because we mistaken the order of positions at flag generation. (Sep 30 2017 18:05:32 UTC)

### Author: 
Lucian Nitescu

### Stats: 
211 points / 44 solvers

### Solution:  

First of all the task was the following:

1. Make king ("K") move from e1 to another position.
2. Let the bot make moves (the bug occurs only once).
3. If king survived after those moves, add the position of the king in the right order ("where $positions is a semicolon-separated list of board positions where the king can survive the first set of bot moves; the board positions must be sorted primarily by row number ascending, and secondarily by file letter alphabetically. Ex: DCTF{SHA256(a1;b1;c3...)}") to your list ($list)

Get the flag as: DCTF{SHA256($list)}

So here all the posible moves:
```
e1-a1
e1-a2 = d2
e1-a3
e1-a4 = d4
e1-a5 = d5
e1-a6 = d6
e1-a7 = d7
e1-a8 = a8
e1-b1
e1-b2
e1-b3
e1-b4 = d4
e1-b5 = d5
e1-b6 = d6
e1-b7
e1-b8 = c8
e1-c1
e1-c2
e1-c3
e1-c4 = d4
e1-c5 = d5
e1-c6 = d6
e1-c7
e1-c8 = c8
e1-d1
e1-d2
e1-d3
e1-d4 = d4
e1-d5 = d5
e1-d6 = d6
e1-d7
e1-d8 = d8
e1-e1 = d3
e1-e2 = d1
e1-e3
e1-e4 = d5
e1-e5 = d6
e1-e6 = d7
e1-e7 = h7
e1-e8 = e8
e1-f1 = d3
e1-f2
e1-f3 = d4
e1-f4 = d5
e1-f5 = d6
e1-f6 = d7
e1-f7
e1-f8 = f8
e1-g1
e1-g2
e1-g3 = d4
e1-g4 = d5
e1-g5 = d6
e1-g6 = d7
e1-g7
e1-g8 = g8
e1-h1
e1-h2
e1-h3 = d4
e1-h4 = d5
e1-h5 = d6
e1-h6 = d7
e1-h7
e1-h8 = h8
```
So in other words we got:

```
mehuser:~$ echo -n 'd1;d2;d3;d4;d5;d6;d7;h7;a8;b8;c8;d8;e8;f8;g8;h8' | sha256sum 
1bdd0a4382410d33cd0a0bf0e8193345babc608ea0ddd83dccbcb4763d67c67b  -

```
The flag is: DCTF{1bdd0a4382410d33cd0a0bf0e8193345babc608ea0ddd83dccbcb4763d67c67b}