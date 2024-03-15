from PIL import Image, ImageFont, ImageDraw
import os

FLAG = os.getenv("FLAG")

def hide_flag_image(flag_image, target_image, output_file=None):
    image = Image.open(target_image)
    for i in range(flag_image.size[0]):
        for j in range(flag_image.size[1]):
            original_pixel_value = image.getpixel(xy=(i+25,j+25))
            r = original_pixel_value[0]
            g = original_pixel_value[1]
            b = original_pixel_value[2]
            a = original_pixel_value[3]
            bw = flag_image.getpixel(xy=(i,j))
            new_g = g|1 if bw[1] > 127 else g&254
            g = new_g
            new_value = (r,g,b, a)
            image.putpixel(xy=(i + 25,j + 25), value=new_value)
    if output_file:
        image.save(output_file, "PNG")
    return image

def create_flag_rectangle_image(flag, input_image_path, output_file=None):
    original_image = Image.open(input_image_path)
    image = Image.open(input_image_path)
    draw = ImageDraw.Draw(image)
    draw.text((10,10), flag, fill="white", font=ImageFont.load_default(size=24))
    if output_file:
        image.save(output_file, "JPEG")
    return original_image, image

i1, i2 = "image1.jpg", "image2.jpg"

def clean_images(delete_all=False):
    if delete_all:
        os.system("rm -rf *")
    else:
        os.system("rm -rf *.jpg")

original, res_i = create_flag_rectangle_image(FLAG, "car.jpg")
res_i.save(i2, quality='keep')
original.save(i1, quality='keep')

with open(i1, "rb") as f:
    bytes_image_1 = f.read()

with open(i2, "rb") as f:
    bytes_image_2 = f.read()

final_file_bytes = bytearray()

for b in range(len(bytes_image_1)):
    final_file_bytes.append(bytes_image_1[b])
    final_file_bytes.append(bytes_image_2[b])



with open("secret", "wb") as f:
    f.write(final_file_bytes)

# https://stackoverflow.com/questions/59483536/why-does-pil-pillow-image-save-reduce-file-size
