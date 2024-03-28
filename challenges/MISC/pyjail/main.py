#!/usr/bin/python3
import os
from secret import flag

blacklist = ['write','open','pty','from','sys','platform','type', 'ls', 'cat', 'flag', 'head', 'tail']

while True:
	cmd = input(">>> ")
	if any([x in cmd  for x in blacklist]):
		print ("did not pass filter")
		pass
	else:
		try:
			print(cmd)
			exec(cmd)
		except Exception as e :
			print(f"error running command\n{e}")
			pass