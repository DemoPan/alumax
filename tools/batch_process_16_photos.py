import os
import random
from PIL import Image, ImageEnhance, ImageFilter

os.makedirs('downloaded_case_images/processed_real', exist_ok=True)

def process_architectural_photo(
    src_path,
    dest_path,
    crop_pct=(0.0, 0.0, 1.0, 1.0), # left, top, right, bottom (0.0 to 1.0)
    color_factor=0.86,
    contrast_factor=1.06,
    brightness_factor=0.98,
    noise_sigma=3.2,
    watermark_patch=None # (x1, y1, x2, y2, sample_x, sample_y)
):
    im = Image.open(src_path).convert('RGB')
    w_orig, h_orig = im.size
    
    # 1. Clean watermark if specified
    if watermark_patch:
        x1, y1, x2, y2, sx, sy = watermark_patch
        w_b = x2 - x1
        h_b = y2 - y1
        patch = im.crop((sx, sy, sx + w_b, sy + h_b))
        im.paste(patch, (x1, y1))
        
    # 2. Crop
    l = int(w_orig * crop_pct[0])
    t = int(h_orig * crop_pct[1])
    r = int(w_orig * crop_pct[2])
    b = int(h_orig * crop_pct[3])
    im = im.crop((l, t, r, b))
    
    w, h = im.size
    
    # 3. Color grading
    im = ImageEnhance.Color(im).enhance(color_factor)
    im = ImageEnhance.Contrast(im).enhance(contrast_factor)
    im = ImageEnhance.Brightness(im).enhance(brightness_factor)
    
    # 4. Optical sharpness & edge softening
    im_soft = im.filter(ImageFilter.GaussianBlur(radius=0.35))
    im_sharp = im_soft.filter(ImageFilter.UnsharpMask(radius=1.2, percent=115, threshold=3))
    
    # 5. CMOS sensor grain
    pix = im_sharp.load()
    random.seed(1337)
    for x in range(w):
        for y in range(h):
            r_c, g_c, b_c = pix[x, y]
            noise = int(random.gauss(0, noise_sigma))
            r_c = min(255, max(0, r_c + noise))
            g_c = min(255, max(0, g_c + noise))
            b_c = min(255, max(0, b_c + noise))
            pix[x, y] = (r_c, g_c, b_c)
            
    # 6. Architectural wide lens vignette
    for x in range(w):
        for y in range(h):
            dx = (x - w / 2) / (w / 2)
            dy = (y - h / 2) / (h / 2)
            dist_sq = dx * dx + dy * dy
            if dist_sq > 0.45:
                vignette = 1.0 - 0.11 * (dist_sq - 0.45) / 1.55
                vignette = max(0.89, min(1.0, vignette))
                r_c, g_c, b_c = pix[x, y]
                pix[x, y] = (int(r_c * vignette), int(g_c * vignette), int(b_c * vignette))
                
    im_sharp.save(dest_path, quality=95)
    print(f"Processed: {src_path} -> {dest_path} ({w}x{h})")

# Let's define the 16 cases processing specifications:
tasks = [
    # 1. Wuhu AUX Smart Manufacturing: use case_28_5 (eye level HQ facade), crop out foreground white car on left and black car on right
    {
        'slug': 'wuhu-aux-smart-manufacturing-industrial-park',
        'src': 'downloaded_case_images/case_28_5.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_28_aux.jpg',
        'crop': (0.16, 0.0, 0.88, 0.90), # crops out left white sedan and right cut car
        'color': 0.85, 'contrast': 1.08, 'noise': 3.2
    },
    # 2. Nanjing Integrated Circuit: use case_25_3 (eye level twin towers), crop out foreground bottom
    {
        'slug': 'nanjing-integrated-circuit-innovation-park',
        'src': 'downloaded_case_images/case_25_3.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_25_nanjing_ic.jpg',
        'crop': (0.0, 0.0, 1.0, 0.88),
        'color': 0.84, 'contrast': 1.07, 'noise': 3.0
    },
    # 3. Lu'an Technical College: case_23_1
    {
        'slug': 'luan-technical-college-campus-development',
        'src': 'downloaded_case_images/case_23_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_23_luan_college.jpg',
        'crop': (0.05, 0.05, 0.95, 0.92),
        'color': 0.86, 'contrast': 1.06, 'noise': 3.3
    },
    # 4. Linquan Agricultural Logistics & Trade Center: case_22_1, crop bottom 12% to remove CGI cars/pedestrians
    {
        'slug': 'linquan-agricultural-logistics-trade-hub',
        'src': 'downloaded_case_images/case_22_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_22_linquan.jpg',
        'crop': (0.0, 0.0, 1.0, 0.87),
        'color': 0.85, 'contrast': 1.08, 'noise': 3.2
    },
    # 5. Lanzhou North Express Toll Plaza Landmark: case_21_1
    {
        'slug': 'lanzhou-north-express-toll-plaza-landmark',
        'src': 'downloaded_case_images/case_21_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_21_lanzhou.jpg',
        'crop': (0.0, 0.0, 1.0, 0.85),
        'color': 0.86, 'contrast': 1.07, 'noise': 3.0
    },
    # 6. Jiangxi Tea Culture Eco-Tourism Grand Complex: case_19_1, crop bottom to remove people
    {
        'slug': 'jiangxi-tea-culture-eco-tourism-complex',
        'src': 'downloaded_case_images/case_19_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_19_jiangxi_tea.jpg',
        'crop': (0.0, 0.0, 1.0, 0.82),
        'color': 0.84, 'contrast': 1.08, 'noise': 3.2
    },
    # 7. Huangshan High-Tech Innovation Center: use case_18_2 (landscape view of tower and lake), crop bottom people
    {
        'slug': 'huangshan-high-tech-innovation-center',
        'src': 'downloaded_case_images/case_18_2.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_18_huangshan.jpg',
        'crop': (0.0, 0.0, 1.0, 0.88),
        'color': 0.84, 'contrast': 1.07, 'noise': 3.0
    },
    # 8. Huaheng Biotechnology Pharmaceutical R&D Complex: use case_16_2 (super clean white curved facade, no people)
    {
        'slug': 'huaheng-biotechnology-pharmaceutical-complex',
        'src': 'downloaded_case_images/case_16_2.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_16_huaheng.jpg',
        'crop': (0.0, 0.0, 1.0, 0.95),
        'color': 0.85, 'contrast': 1.06, 'noise': 3.1
    },
    # 9. East China Normal University Affiliated High School Campus: case_15_1, crop bottom people
    {
        'slug': 'east-china-normal-university-affiliated-campus',
        'src': 'downloaded_case_images/case_15_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_15_ecnu_highschool.jpg',
        'crop': (0.0, 0.0, 1.0, 0.84),
        'color': 0.85, 'contrast': 1.07, 'noise': 3.2
    },
    # 10. Feixi East China Horticultural Expo & Flower City: use case_06_2 (honeycomb screen facade), crop bottom
    {
        'slug': 'feixi-east-china-horticultural-expo-flower-city',
        'src': 'downloaded_case_images/case_06_2.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_06_feixi_flower.jpg',
        'crop': (0.0, 0.0, 1.0, 0.84),
        'color': 0.84, 'contrast': 1.08, 'noise': 3.2
    },
    # 11. Hongda Kunlunyin Luxury Architectural Residences: case_12_1, crop bottom
    {
        'slug': 'hongda-kunlunyin-luxury-architectural-residences',
        'src': 'downloaded_case_images/case_12_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_12_kunlunyin.jpg',
        'crop': (0.0, 0.0, 1.0, 0.85),
        'color': 0.85, 'contrast': 1.08, 'noise': 3.1
    },
    # 12. New Oriental Education Global Headquarters Hefei: case_10_1, crop bottom empty road with 2 tiny figures
    {
        'slug': 'new-oriental-education-global-headquarters-hefei',
        'src': 'downloaded_case_images/case_10_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_10_new_oriental.jpg',
        'crop': (0.10, 0.0, 0.90, 0.94),
        'color': 0.85, 'contrast': 1.07, 'noise': 3.0
    },
    # 13. Hangzhou Mianbeili Historic Waterfront Cultural Complex: case_07_4 with watermark patched
    {
        'slug': 'hangzhou-mianbeili-waterfront-cultural-complex',
        'src': 'downloaded_case_images/case_07_4.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_07_mianbeili.jpg',
        'crop': (0.0, 0.0, 1.0, 0.94),
        'watermark_patch': (1120, 690, 1360, 760, 880, 690), # patch M.A.D logo
        'color': 0.85, 'contrast': 1.08, 'noise': 3.2
    },
    # 14. Chuzhou Vocational & Technical College Campus: case_03_1
    {
        'slug': 'chuzhou-vocational-technical-college-campus',
        'src': 'downloaded_case_images/case_03_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_03_chuzhou.jpg',
        'crop': (0.05, 0.05, 0.95, 0.92),
        'color': 0.86, 'contrast': 1.06, 'noise': 3.2
    },
    # 15. Anhui Grand Provincial Arts Center: case_02_1, crop bottom people & cars
    {
        'slug': 'anhui-grand-provincial-arts-center',
        'src': 'downloaded_case_images/case_02_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_02_anhui_arts.jpg',
        'crop': (0.0, 0.0, 1.0, 0.84),
        'color': 0.84, 'contrast': 1.08, 'noise': 3.2
    },
    # 16. Anhui University Life Sciences Research Complex: case_01_1, crop bottom 15% people & pond
    {
        'slug': 'anhui-university-life-sciences-research-complex',
        'src': 'downloaded_case_images/case_01_1.jpg',
        'dest': 'downloaded_case_images/processed_real/real_photo_01_anhui_univ.jpg',
        'crop': (0.0, 0.0, 1.0, 0.85),
        'color': 0.85, 'contrast': 1.07, 'noise': 3.2
    },
]

for t in tasks:
    process_architectural_photo(
        src_path=t['src'],
        dest_path=t['dest'],
        crop_pct=t['crop'],
        color_factor=t['color'],
        contrast_factor=t['contrast'],
        noise_sigma=t['noise'],
        watermark_patch=t.get('watermark_patch')
    )

print("All 16 cases processed successfully!")
