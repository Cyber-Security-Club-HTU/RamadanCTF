import os
from PIL import Image, ImageDraw

flag = "CSC{345y_r1gh7?_l0l}"
image = Image.new(mode="RGBA", size=(100, 50), color="black")
text_layer = Image.new('RGBA', image.size, (0, 0, 0, 0))
draw = ImageDraw.Draw(text_layer)
draw.text((10,10), flag, fill="white")
res_image = Image.alpha_composite(image.convert("RGBA"), text_layer)

image = Image.open("the_rock.png")
for i in range(res_image.size[0]):
    for j in range(res_image.size[1]):
        original_pixel_value = image.getpixel(xy=(i+25,j+25))
        r = original_pixel_value[0]
        g = original_pixel_value[1]
        b = original_pixel_value[2]
        a = original_pixel_value[3]
        bw = res_image.getpixel(xy=(i,j))
        b = b|1 if bw[0] > 127 else b&254
        new_value = (r,g,b, a)
        image.putpixel(xy=(i + 25,j + 25), value=new_value)

image.save("secret.png")

with open("top_g.png", "rb") as f:
    b1 = bytearray(f.read())

with open("secret.png", "rb") as f:
    b1.extend(f.read())

with open("findme.png", "wb") as f:
    f.write(b1)
