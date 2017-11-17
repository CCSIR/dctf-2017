from pydub import AudioSegment
import sys
#print sys.argv
t1 = int(sys.argv[1])
t2 = int(sys.argv[2])
newAudio = AudioSegment.from_wav("0-9a-z-slow.wav")
newAudio = newAudio[t1:t2]
newAudio.export(sys.argv[3] + '.wav', format="wav")