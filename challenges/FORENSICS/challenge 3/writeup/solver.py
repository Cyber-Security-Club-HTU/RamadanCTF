with open("secret", "rb") as f:
    b = f.read()

bytes1, bytes2 = bytearray(), bytearray()

for i in range(len(b)):
    if i%2==0:
        bytes1.append(b[i])
    else:
        bytes2.append(b[i])

with open("image1.jpeg", "wb") as f:
    f.write(bytes1)

with open("image2.jpeg", "wb") as f:
    f.write(bytes2)