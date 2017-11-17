import sys
def xor_strings(xs, ys):
	return "".join(chr(ord(x) ^ ord(y)) for x, y in zip(xs, ys))

buf = "2134929ff2028ac3b58ba08148e0469333349095b353f4b4dbefbdd81eb3549b77379691bd14d2c5b6cff6d94fe1529d73389096ba14d296bb9ea3d94be302c9706897c3e810d492b79af08f1ee50798243997c3e840d195bf99f0900bbc1792743485cbe81cd5d5b4dafcd513a534c42177c2d7a94092ccfc93f3d70be905c5253c859efa4b88cdadf9aa8c50e21688722c9cd6b3448ad5fccaa99f4ca55fc17a3e9cd6b3478ad5fccaa99f4cb546932934979ef4"
key = "400ea7a58971b0f78fa9c6ed298764a8"

while len(buf) > 32:

	binary_a = buf.decode("hex")
	binary_b = key.decode("hex")
	xored = xor_strings(binary_a, binary_b).encode("hex")
	xored = xored.decode("hex")
	print xored
	buf = buf[len(key):]