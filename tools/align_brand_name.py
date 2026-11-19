import os

theme_dir = os.path.join(os.path.dirname(__file__), '..', 'wp-content', 'themes', 'alumax')

replacements = [
    ('export@alumax-facade.com', 'export@aluviona.com'),
    ('alumax-facade.com', 'aluviona.com'),
    ('ALUMAX', 'ALUVIONA'),
    ('Why Alumax', 'Why Aluviona'),
    ('Alumax Architectural', 'Aluviona Architectural'),
    ('Alumax architectural', 'Aluviona architectural'),
    ('Author: Alumax', 'Author: Aluviona'),
    ('Theme Name: Alumax', 'Theme Name: Aluviona'),
]

modified_count = 0
total_replacements = 0

for root, dirs, files in os.walk(theme_dir):
    for fname in files:
        if not (fname.endswith('.php') or fname.endswith('.css') or fname.endswith('.js') or fname.endswith('.html')):
            continue
        fpath = os.path.join(root, fname)
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()

        new_content = content
        file_rep = 0
        for old, new in replacements:
            count = new_content.count(old)
            if count > 0:
                new_content = new_content.replace(old, new)
                file_rep += count

        if new_content != content:
            with open(fpath, 'w', encoding='utf-8') as f:
                f.write(new_content)
            modified_count += 1
            total_replacements += file_rep
            rel = os.path.relpath(fpath, theme_dir)
            print(f'Updated {rel}: {file_rep} replacements')

print(f'\nFinished. Updated {modified_count} files with {total_replacements} replacements.')
