from PIL import Image

# 1. Clean Huaibei West Station (case_17_1.jpg)
im17 = Image.open('downloaded_case_images/case_17_1.jpg').convert('RGB')
w, h = im17.size
pixels = im17.load()

# The text region is x: 20..680, y: 160..330
is_text = [[False for _ in range(h)] for _ in range(w)]
for x in range(20, 680):
    for y in range(160, 330):
        r, g, b = pixels[x, y]
        if r < 125 and g < 125 and b < 125:
            is_text[x][y] = True

expanded = [[False for _ in range(h)] for _ in range(w)]
for x in range(20, 680):
    for y in range(160, 330):
        if is_text[x][y]:
            for dx in range(-3, 4):
                for dy in range(-3, 4):
                    nx, ny = x + dx, y + dy
                    if 0 <= nx < w and 0 <= ny < h:
                        expanded[nx][ny] = True

for x in range(20, 680):
    y = 160
    while y < 330:
        if expanded[x][y]:
            y_start = y
            while y < 330 and expanded[x][y]:
                y += 1
            y_end = y
            
            ty = max(0, y_start - 3)
            by = min(h - 1, y_end + 3)
            tr, tg, tb = pixels[x, ty]
            br, bg, bb = pixels[x, by]
            
            span = by - ty
            if span <= 0: span = 1
            for yi in range(y_start, y_end):
                t = (yi - ty) / span
                r = int((1 - t) * tr + t * br)
                g = int((1 - t) * tg + t * br)
                b = int((1 - t) * tb + t * bb)
                pixels[x, yi] = (r, g, b)
        else:
            y += 1

im17.save('downloaded_case_images/case_17_1_clean.jpg', quality=95)
print("Saved case_17_1_clean.jpg")

# 2. Check logo in Hangzhou Mianbeili (case_07_1.jpg)
# Size is 1400x788. Red logo is in bottom right. Let's crop x: 1100..1380, y: 680..780
im7 = Image.open('downloaded_case_images/case_07_1.jpg').convert('RGB')
crop7 = im7.crop((1100, 680, 1380, 780))
crop7.save('downloaded_case_images/test_crop_07.jpg')
print("Saved test_crop_07.jpg")
