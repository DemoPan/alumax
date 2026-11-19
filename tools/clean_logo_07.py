from PIL import Image

im7 = Image.open('downloaded_case_images/case_07_1.jpg').convert('RGB')
w, h = im7.size

# Logo is from x: 1120..1360, y: 690..760 (width ~240, height ~70)
# Clean asphalt is right next to it: x: 900..1120, y: 690..760
asphalt_patch = im7.crop((880, 690, 1120, 760))

# Paste asphalt over logo with subtle feather / blending
im7.paste(asphalt_patch, (1120, 690))
im7.save('downloaded_case_images/case_07_1_clean.jpg', quality=95)
print("Saved case_07_1_clean.jpg")
