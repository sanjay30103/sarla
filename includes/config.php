<?php

/*
 | Site-wide settings. Update these values for the client and every page
 | (header, footer, contact, booking, WhatsApp links) picks them up.
 */
const SITE = [
    'name'      => 'Sarla',
    'title'     => 'Sarla — Indian Kitchen & Bar, Sector 62 Noida',
    'tagline'   => 'Indian Kitchen · Bar · Banquets',
    'quote'     => 'Good food is the warmest welcome.',

    'phone'      => '+91-9711555502',
    'phone_href' => '+919711555502',
    'whatsapp'   => '919711555502',
    'email'      => 'hotelsarlainnnoida62@gmail.com',

    'address'    => [
        'Plot No. 132, Khora Rd, opp. Tower I',
        'Industrial Area, Sector 62',
        'Noida, Uttar Pradesh',
    ],
    'landmark'   => 'Inside Hotel Sarla Inn · Sector 62 Noida',
    'maps_query' => 'Hotel Sarla Inn, Plot 132, Khora Rd, Sector 62, Noida, Uttar Pradesh',

    // Service sessions (24h). "last" = last order for the kitchen.
    'hours' => [
        ['name' => 'Lunch',  'open' => '12:00', 'last' => '15:00', 'close' => '15:30'],
        ['name' => 'Dinner', 'open' => '19:00', 'last' => '23:00', 'close' => '23:30'],
    ],
    'bar_last_order' => '23:15',

    // Replace with the restaurant's real listing URLs.
    'delivery' => [
        ['name' => 'Zomato', 'note' => 'Order online · 30–40 min', 'url' => 'https://www.zomato.com/', 'color' => '#E23744'],
        ['name' => 'Swiggy', 'note' => 'Order online · 30–40 min', 'url' => 'https://www.swiggy.com/', 'color' => '#FC8019'],
    ],

    'instagram'        => 'https://www.instagram.com/',
    'instagram_handle' => '@sarla.noida',
    'facebook'         => 'https://www.facebook.com/',

    'credit' => 'Pulse n Pixels',
];
