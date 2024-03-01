from PIL import Image, ImageFont, ImageDraw
import os

flag = "CSC{n0_l0ng3r_scr1p7_k1dd0}"

original_image = Image.open("car.jpg")
new_image = Image.open("car.jpg")
draw = ImageDraw.Draw(new_image)
draw.text((10,10), flag, fill="white", font=ImageFont.load_default(size=24))

original_image.save("image1.jpg", qualit="keep")
new_image.save("image2.jpg", qualit="keep")


with open("image1.jpg", "rb") as f:
    b1 = f.read()

with open("image2.jpg", "rb") as f:
    b2 = f.read()

combined = bytearray()

for i in range(len(b1)):
    combined.append(b1[i])
    combined.append(b2[i])
    
with open("hidden", "wb") as f:
    f.write(combined)
