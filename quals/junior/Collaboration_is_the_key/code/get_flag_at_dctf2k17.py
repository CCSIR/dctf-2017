secret_song = '0\x10\\U`R\x07Q`kKfZ\x10VYVVLfYX\naOU\x14mYb\x07SUb\n_LScjO_\x07d\\]]\rIQg]M\rM\\U[\nSY_a\x14Wf\x07cc\x14LNZYW\x14O[Jbmd^VV^"\x14+[K\x10UW^bH\\`m\nfVe\x14ZYbUT\x14]^\rP^\x14mYbY\x10ckX\r^Qm"\n6\x07Qdd\\RJYUhO\r[XUh\x18\r>U``\n:`\x10ZfSRUT\x14hRVZ\x10]g\nfVef\x14UR`*\x142(+%.22(+%\x1087>3bQ+)\x1c&\x1c(Y)OSIQU,\x1a%K(W%! J)X&\x1b\x1f\x17(Z$ &\x19\'X%K\x1d "-X\x1cS\x1a *,ON\x17(\'W &\x19%%\'Lj\x07,00&)#,00&)#\x1e\x14BYd\x079\x14kSYS\x10^i]a\x07c]bQ\rH\x10gcXT\x07Yb\x14Y_KUf\x14^\\\x07`fYV\\UW\x14hRR\x07\\YbQaO\x10cZ\naOYg\x14WRZcU[O\x1b\x071\x146\n0\x074\x149\n3\x077\x147YZL\x10UbN\rZYb[\nNS_b[\ndPd\\\x14WR\x078\x14=\n7\x07;\x14@\n:\x07>\x14C\n=\x07DY`V\rTU\x14kRN[\x10mc_\r^Qbh\naV\x10VY\n>\x07B\x14G\nA\x07E\x14J\nD\x07H\x14M\nNUT\x14N8\\^\x10=\x14U[Vg\x14ac\r(27g\n;Lhh\x14^VTU\x14kY[\x07d\x14mYb\x07c]bQ\r^Yh\\\nZL\x105\x14,\r*\x108\x14/\r-\x10;\x142\r0\x10>\x145\r3\x10A\x148\r6\x10D\x14;\r9\x10G\x14>\r<\x10J\x14A\r?\x10M\x14K[K\x10N\x148\\^\x10=\x14U[Vg\x14ac\r(27g\n;Lhh\x14^VTU\x14kY[\x07d\x14mYb\x07c]bQ\r^Yh\\\nZL\x11\x14C82\x07=CF/\r;9A9\x0b\r(\x106\x14-\r+\x109\x140\r.\x107cWR\x07QbX\n`P^[\x14KYV^[\x14aV[X\x14aO\r/\x10=\x144\r2\x10@\x147\r5\x10C\x14:\r;U``\nZL\x10k\\Ka\x07ici\ndH^h\x14^\\\x07RY\x14;\r9\x10G\x14>\r<\x10J\x14A\r?\x10M\x14K[K\x10NBYd\x079\x14_X\\^\x10am\n.)3g\x148R_d\x14hSZL\x10kcX\r[\x10mc_\rZYb[\ndPd\\\x14WR\x071\x146\n0\x074\x149\n3\x077\x14<\n6\x07:\x14?\n9\x07=\x14B\n<\x07@\x14E\n?\x07C\x14H\nB\x07F\x14K\nE\x07I\x14UXQ\x07J\x14BYd\x079\x14_X\\^\x10am\n.)3g\x148R_d\x14hSZL\x10kcX\r[\x10mc_\rZYb[\ndPd\\\x14WR\x08'

def decrypt(key, encryped):
    msg = []
    for i, c in enumerate(encryped):
        key_c = ord(key[i % len(key)])
        enc_c = ord(c)
        msg.append(chr((enc_c - key_c) % 127))
    return ''.join(msg)
# ---------------------------------------------------------------------
f = open ("jaksjkljaflk124.dctf.def.camp", "r")
buf =f.read()
f.close()
if __name__ == '__main__':
    key = buf
    encrypted = secret_song
    decrypted = decrypt(key, encrypted)

    print 'Key:', repr(key)
    print 'Decrypted:', repr(decrypted)