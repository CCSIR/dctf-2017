import scipy, random, os, binascii, json
from pydub import AudioSegment
os.chdir('../sounds/')

outfile = "sounds-"+ binascii.hexlify(os.urandom(16)) +".wav"
charset = list('0123456789abcdef')
length  = 10
sounds  = []

for i in range(0, length):
	c = charset[random.randint(0, len(charset)-1)]
	sounds.append(c + '.wav')


data = None
for csound in sounds:
	if data == None:
		data = AudioSegment.from_wav(csound)
	else: 
		data += AudioSegment.from_wav(csound)

data.export(outfile, format="wav")
print json.dumps([outfile, "".join(sounds).replace(".wav","")])