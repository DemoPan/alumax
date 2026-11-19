from PIL import Image

im = Image.open('downloaded_case_images/test_crop_17.jpg').convert('RGB')
w, h = im.size
pixels = im.load()

# Identify text pixels
is_text = [[False for _ in range(h)] for _ in range(w)]
for x in range(w):
    for y in range(h):
        r, g, b = pixels[x, y]
        # Text is black/dark grey
        if r < 125 and g < 125 and b < 125:
            is_text[x][y] = True

# Expand mask by 3px radius
expanded = [[False for _ in range(h)] for _ in range(w)]
for x in range(w):
    for y in range(h):
        if is_text[x][y]:
            for dx in range(-3, 4):
                for dy in range(-3, 4):
                    nx, ny = x + dx, y + dy
                    if 0 <= nx < w and 0 <= ny < h:
                        expanded[nx][ny] = True

# Inpaint COLUMN-WISE (vertical interpolation from clean top to clean bottom)
for x in range(w):
    y = 0
    while y < h:
        if expanded[x][y]:
            y_start = y
            while y < h and expanded[x][y]:
                y += 1
            y_end = y
            
            # Top clean pixel
            ty = max(0, y_start - 3)
            by = min(h - 1, y_end + 3)
            tr, tg, tb = pixels[x, ty]
            br, bg, bb = pixels[x, by]
            
            span = by - ty
            if span <= 0: span = 1
            for yi in range(y_start, y_end):
                t = (yi - ty) / span
                r = int((1 - t) * tr + t * br)
                g = int((1 - t) * tg + t * bg)
                b = int((1 - t) * tb + t * bb)
                pixels[x, yi] = (r, g, b)
        else:
            y += 1

im.save('downloaded_case_images/test_crop_inpaint.jpg')
print("Vertical inpaint complete")
