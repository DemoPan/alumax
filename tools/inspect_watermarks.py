from PIL import Image

# 1. Clean Huaibei West Station (case_17_1.jpg)
# Text is in top-left: "项目名称：淮北高铁西站 \n 供货单位：安徽皖创新材料有限公司"
im17 = Image.open('downloaded_case_images/case_17_1.jpg')
w, h = im17.size
print(f"case_17_1: {w}x{h}")

# The text is located around x: 20..680, y: 150..320
# Let's sample a clean area of the ceiling panel: e.g. x: 500..800, y: 40..120 or similar
# Let's inspect patch coordinates
clean_patch = im17.crop((w * 0.45, int(h * 0.05), int(w * 0.55), int(h * 0.15)))
print(f"Clean patch size: {clean_patch.size}")

# 2. Clean Hangzhou Mianbeili (case_07_1.jpg)
# Red logo is in bottom right: M.A.D logo around x: 1100..1320, y: 650..740 (if 1344x756 or similar)
im7 = Image.open('downloaded_case_images/case_07_1.jpg')
w7, h7 = im7.size
print(f"case_07_1: {w7}x{h7}")
