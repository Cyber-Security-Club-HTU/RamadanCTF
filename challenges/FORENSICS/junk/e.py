with open("hidden", "rb") as f:
	b = f.read()
	
b1 = bytearray()
b2 = bytearray()

i = 0
l = len(b)
while i < l:
	if i%2==0:
		b1.append(b[i])
	else:
		b2.append(b[i])
	i+=1
with open("1", "wb") as f:
	f.write(b1)
with open("2", "wb") as f:
	f.write(b2)
