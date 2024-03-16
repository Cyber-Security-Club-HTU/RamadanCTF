import threading
from scapy.all import IP, ICMP, wrpcap, sniff
from scapy.sendrecv import sr
import os

# hi = ICMP()
# print(type(hi.chksum))
print(os.getenv("FLAG"))