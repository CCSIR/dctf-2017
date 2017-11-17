#!/usr/bin/env python

#89 50 4E 47 0D 0A 1A 0A 00 00 00
password = 'Pa#@_1r)DeF' 
plain = open('encrypted.png', 'rb')
dataplain = plain.read()
plain.close()
 

def encrypt(data, password):
	enc  = ""
	prev = 0
	for i in range(0, len(data)):
		enc += chr(ord(data[i]) ^ ord(password[i%len(password)]) % 0xFF)

	return enc

enc = encrypt(dataplain, password)
fh = open('chall/decrypted.png', 'wb')
fh.write(enc)
fh.close()


