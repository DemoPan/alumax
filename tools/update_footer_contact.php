<?php
require_once dirname(__DIR__) . '/wp-load.php';

$site = get_option('alumax_site', []);
$site['hq_row1_text'] = "No. 8-1, Yinque Rd, Lu'an Economic Development Zone, Luan, Anhui, China";
$site['hq_row2_text'] = "+86 18930079759 · WhatsApp: +86 18930079759";
$site['hq_row3_text'] = "sales@aluviona.com / info@aluviona.com";
update_option('alumax_site', $site);

$contact = get_option('alumax_contact', []);
$contact['office_row3_line1'] = "sales@aluviona.com / info@aluviona.com";
update_option('alumax_contact', $contact);

echo "SUCCESSFULLY_UPDATED\n";
