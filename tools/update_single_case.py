with open('wp-content/themes/alumax/single.php', 'r', encoding='utf-8') as f:
    c = f.read()

old_block = """                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">GCC
                    Benchmark Case Study</span>
                  <span class="material-symbols-outlined text-[20px] text-secondary">apartment</span>
                </div>
                <div class="h-40 overflow-hidden relative">
                  <img class="w-full h-full object-cover"
                    data-alt="King Abdullah Financial District KAFD Tower 3 in Riyadh, Saudi Arabia, towering under clear skies with bespoke champagne-bronze aluminum facade cladding and continuous solar louvers."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDh4sAG3n6o3l9CIIgYmQ3Z_FVYsEZunyCARxZDydQ1Ol7bgaStG6TDRXdK9EtwlX4KBz57bZVVRt43DcrUmjks2gn70qua-Uw3P1I3lSqjpm4iRPM78AnukrC2ZMnkjOSsTebPH5hhlTtOjWLXN_R7ZTRtTx-kxpKEVQxK1JTGFWzVQD4lwfI69qRAoFaMfkOEHT_t_qgKp7ywfrdadmfgUs9Fo6-N7gNcQHS6BvHPl8iDya10aMKs" />
                </div>
                <div>
                  <h4 class="font-headline-sm text-headline-sm font-bold uppercase text-on-primary">KAFD Financial Tower
                    3</h4>
                  <p class="font-label-sm text-label-sm text-on-primary-container mt-1">Riyadh, Kingdom of Saudi Arabia
                  </p>
                  <p class="font-body-sm text-body-sm text-on-primary-container mt-2">
                    Supplied 42,000 m² of custom 3.0mm solid PVDF cladding cassettes and intelligent horizontal solar
                    louvers certified to GCC wind-load standards.
                  </p>
                </div>"""

new_block = """                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">Featured
                    Benchmark Case Study</span>
                  <span class="material-symbols-outlined text-[20px] text-secondary">apartment</span>
                </div>
                <div class="h-40 overflow-hidden relative">
                  <img class="w-full h-full object-cover"
                    data-alt="Zhejiang University International Innovation Institute in Hangzhou, Zhejiang."
                    src="/wp-content/uploads/2026/11/case_32_1.jpg" />
                </div>
                <div>
                  <h4 class="font-headline-sm text-headline-sm font-bold uppercase text-on-primary">ZJU International
                    Innovation Institute</h4>
                  <p class="font-label-sm text-label-sm text-on-primary-container mt-1">Hangzhou, Zhejiang
                  </p>
                  <p class="font-body-sm text-body-sm text-on-primary-container mt-2">
                    Supplied 48,000 m² of precision 3.0mm solid PVDF cladding cassettes and architectural solar louvers for high-efficiency thermal performance.
                  </p>
                </div>"""

old_lf = old_block.replace('\r\n', '\n')
old_crlf = old_block.replace('\r\n', '\n').replace('\n', '\r\n')
if old_crlf in c:
    c = c.replace(old_crlf, new_block.replace('\r\n', '\n').replace('\n', '\r\n'))
    with open('wp-content/themes/alumax/single.php', 'w', encoding='utf-8') as f:
        f.write(c)
    print('Replaced CRLF in single.php')
elif old_lf in c:
    c = c.replace(old_lf, new_block.replace('\r\n', '\n'))
    with open('wp-content/themes/alumax/single.php', 'w', encoding='utf-8') as f:
        f.write(c)
    print('Replaced LF in single.php')
else:
    print('Not found in single.php')
