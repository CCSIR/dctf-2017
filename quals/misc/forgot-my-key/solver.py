import re

s = '5616f5962674d26741d2810600a6c5647620c4e3d2870177f09716b2379012c342d3b584c5672195d653722443f1c39254360007010381b721c741a532b03504d2849382d375c0d6806251a2946335a67365020100f160f17640c6a05583f49645d3b557856221b2'
s = re.findall(r'.{1,2}',s,re.DOTALL)
s = "".join(list(x[::-1] for x in s)).decode("hex")

# s is the encrypted message
dec1 = [ord(c) for c in s]  
for i in range(len(s) - 1, 1, -1):
  dec1[i] = (dec1[i] - dec1[i-1]) % 126
dec1 = dec1[1:]

key = [0] * 32
c = len(dec1) - 32 - 1  # our current character, we start from the position of the '|' character
key[c % 32] = (dec1[c] - ord('|')) % 126  # recover the key

for _ in range(31):
  c = (c % 32) + len(dec1) - 32   # find the position of the previously recovered character in the encrypted message
  key[c % 32] = (dec1[c] - key[(c - (len(dec1) - 32))]) % 126   # recover the key

message = ''
for i in range(0, len(dec1)):
  message += chr((dec1[i] - key[i % len(key)]) % 126)

print message