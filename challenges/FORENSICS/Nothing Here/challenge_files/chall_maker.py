#!/usr/bin/python3
import threading
from scapy.all import IP, ICMP, wrpcap, sniff
from scapy.sendrecv import sr
import os

FLAG = os.getenv("FLAG")
def capture():
    wrpcap("capture.pcap", sniff(iface='eth0', timeout=3))


def send_pings():
    for i in FLAG:
        p = IP(dst='31.41.59.26')/ICMP(chksum=ord(i))
        sr(p, timeout=0, iface='eth0', verbose=False)

threads = []
t = threading.Thread(target=capture)
t.start()
threads.append(t)

t = threading.Thread(target=send_pings)
t.start()
threads.append(t)

for t in threads:
    t.join()

# Resources:
# https://stackoverflow.com/questions/23269226/scapy-in-a-script
# https://stackoverflow.com/questions/26227298/stop-sniffing-after-x-seconds-instead-of-x-packets

