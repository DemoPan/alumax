<?php
if (!defined('ABSPATH')) {
    exit;
}

$contact = get_option('alumax_contact', []);
if (is_array($contact)) {
    $contact['hero_image'] = '/wp-content/uploads/solid-aluminum-cladding-hero-building.jpg';
    update_option('alumax_contact', $contact);
    echo "Updated alumax_contact hero_image.\n";
}
