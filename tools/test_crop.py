from PIL import Image, ImageFilter

im = Image.open('downloaded_case_images/case_17_1.jpg')
w, h = im.size

# Let's check text box:
# "项目名称：淮北高铁西站"
# "供货单位：安徽皖创新材料有限公司"
# In a 1400x1050 image, text is approximately from x=30 to x=680, y=170 to y=320.
# The ceiling panel extends from x=0 to x=720, y=120 to y=340.
# We can sample the ceiling above or to the right of the text (e.g. x: 500..700, y: 15..120 or blurred gradient)
# Let's inspect a crop of the text area and save as a test
crop_test = im.crop((20, 160, 680, 330))
crop_test.save('downloaded_case_images/test_crop_17.jpg')
print("Saved crop test")
