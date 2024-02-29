from scapy.all import IP, ICMP, send
from scapy.sendrecv import sr

flag = "CSC{w_or_t_shark?}"
for i in flag:
    p = IP(dst='192.168.8.1')/ICMP(id=ord(i))
    sr(p)

# with oe