<?php

/*
 | Demo menu. Each item: name, desc, price (int, or "half/full" string),
 | veg (bool), tags (chef|best|spicy|new), optional img for the homepage.
 */
function menu(): array
{
    return [
        [
            'id' => 'chaat', 'title' => 'Chaat & Snacks', 'img' => 'chaat',
            'intro' => 'Tangy, crunchy, street-style favourites from the lanes of Delhi.',
            'items' => [
                ['name' => 'Samosa (2 pcs)', 'desc' => 'Crisp pastry stuffed with spiced potato and peas, mint & tamarind chutney.', 'price' => 99, 'veg' => true, 'tags' => []],
                ['name' => 'Papdi Chaat', 'desc' => 'Wheat crisps, chickpeas, whipped dahi, sweet & green chutneys, sev.', 'price' => 149, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Aloo Tikki Chaat', 'desc' => 'Pan-crisped potato patties topped with chole, curd and chutneys.', 'price' => 149, 'veg' => true, 'tags' => []],
                ['name' => 'Dahi Bhalla', 'desc' => 'Soft lentil dumplings soaked in chilled, lightly sweetened yoghurt.', 'price' => 159, 'veg' => true, 'tags' => []],
                ['name' => 'Pav Bhaji', 'desc' => 'Buttery Mumbai-style mashed vegetable curry with toasted pav.', 'price' => 199, 'veg' => true, 'tags' => ['best'], 'img' => 'pav-bhaji'],
                ['name' => 'Chole Bhature', 'desc' => 'Pindi chole with two fluffy bhature, pickled onions and achaar.', 'price' => 219, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'veg-starters', 'title' => 'Veg Starters', 'img' => 'paneer-tikka',
            'intro' => 'Fired in our clay tandoor or tossed hot off the tawa.',
            'items' => [
                ['name' => 'Paneer Tikka', 'desc' => 'Cottage cheese cubes in hung-curd marinade, charred with peppers and onion.', 'price' => 349, 'veg' => true, 'tags' => ['chef', 'best'], 'img' => 'paneer-tikka'],
                ['name' => 'Hara Bhara Kebab', 'desc' => 'Spinach, green peas and potato patties with a cashew centre.', 'price' => 279, 'veg' => true, 'tags' => []],
                ['name' => 'Malai Soya Chaap', 'desc' => 'Tandoor-roasted soya chaap in a creamy cardamom marinade.', 'price' => 299, 'veg' => true, 'tags' => []],
                ['name' => 'Dahi Ke Kebab', 'desc' => 'Melt-in-the-mouth hung-curd kebabs with a crisp crumb.', 'price' => 299, 'veg' => true, 'tags' => ['new']],
                ['name' => 'Tandoori Mushroom', 'desc' => 'Button mushrooms in smoky achari spices, finished with chaat masala.', 'price' => 299, 'veg' => true, 'tags' => []],
                ['name' => 'Crispy Corn Pepper Salt', 'desc' => 'Golden fried corn tossed with garlic, spring onion and black pepper.', 'price' => 249, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'tandoor', 'title' => 'Non-Veg Starters & Tandoor', 'img' => 'seekh-kebab',
            'intro' => 'Marinated overnight, skewered by hand, kissed by charcoal.',
            'items' => [
                ['name' => 'Tandoori Chicken', 'desc' => 'The classic — bone-in chicken in red chilli & yoghurt marinade. Half / Full.', 'price' => '399/699', 'veg' => false, 'tags' => ['best']],
                ['name' => 'Chicken Tikka', 'desc' => 'Boneless chicken thigh, Kashmiri chilli, mustard oil and smoked garlic.', 'price' => 429, 'veg' => false, 'tags' => []],
                ['name' => 'Murgh Malai Tikka', 'desc' => 'Cream cheese, cardamom and white pepper — mild, rich and juicy.', 'price' => 449, 'veg' => false, 'tags' => ['chef']],
                ['name' => 'Mutton Seekh Kebab', 'desc' => 'Minced lamb with ginger, green chilli and fresh mint, cooked on skewers.', 'price' => 529, 'veg' => false, 'tags' => ['chef'], 'img' => 'seekh-kebab'],
                ['name' => 'Amritsari Fish Fry', 'desc' => 'Basa fillets in a spiced gram-flour batter, ajwain and lemon.', 'price' => 499, 'veg' => false, 'tags' => []],
                ['name' => 'Afghani Chicken', 'desc' => 'Creamy, nutty marinade with cashew paste, slow roasted.', 'price' => 459, 'veg' => false, 'tags' => []],
            ],
        ],
        [
            'id' => 'veg-mains', 'title' => 'Veg Main Course', 'img' => 'paneer-curry',
            'intro' => 'Slow-cooked gravies, hand-ground masalas, generous portions.',
            'items' => [
                ['name' => 'Dal Makhani', 'desc' => 'Black urad simmered overnight on the tandoor with butter and cream.', 'price' => 329, 'veg' => true, 'tags' => ['chef', 'best']],
                ['name' => 'Paneer Butter Masala', 'desc' => 'Soft paneer in a velvety tomato, butter and fenugreek gravy.', 'price' => 369, 'veg' => true, 'tags' => ['best'], 'img' => 'paneer-curry'],
                ['name' => 'Kadhai Paneer', 'desc' => 'Paneer, capsicum and onion tossed in freshly pounded kadhai masala.', 'price' => 369, 'veg' => true, 'tags' => ['spicy']],
                ['name' => 'Malai Kofta', 'desc' => 'Paneer & potato dumplings in a rich, mildly sweet cashew gravy.', 'price' => 349, 'veg' => true, 'tags' => []],
                ['name' => 'Amritsari Chole', 'desc' => 'Dark, tangy chickpea curry cooked with tea leaves and whole spices.', 'price' => 279, 'veg' => true, 'tags' => []],
                ['name' => 'Dal Tadka', 'desc' => 'Yellow lentils tempered with ghee, cumin, garlic and red chilli.', 'price' => 269, 'veg' => true, 'tags' => []],
                ['name' => 'Subz Miloni', 'desc' => 'Seasonal vegetables in a spinach and fenugreek gravy.', 'price' => 289, 'veg' => true, 'tags' => []],
                ['name' => 'Jeera Aloo', 'desc' => 'Baby potatoes tossed with cumin, green chilli and coriander.', 'price' => 229, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'nonveg-mains', 'title' => 'Non-Veg Main Course', 'img' => 'butter-chicken',
            'intro' => 'From Old Delhi butter chicken to fiery Rajasthani laal maas.',
            'items' => [
                ['name' => 'Butter Chicken', 'desc' => 'Tandoori chicken in silky makhani gravy — the dish that made Delhi famous.', 'price' => 449, 'veg' => false, 'tags' => ['chef', 'best'], 'img' => 'butter-chicken'],
                ['name' => 'Kadhai Chicken', 'desc' => 'Chicken with peppers and onions in a robust, spicy kadhai masala.', 'price' => 429, 'veg' => false, 'tags' => ['spicy']],
                ['name' => 'Chicken Changezi', 'desc' => 'Old Delhi-style creamy, smoky curry with tandoori chicken.', 'price' => 449, 'veg' => false, 'tags' => []],
                ['name' => 'Rara Mutton', 'desc' => 'Tender mutton cooked with its own mince — a Punjabi dhaba legend.', 'price' => 579, 'veg' => false, 'tags' => ['chef']],
                ['name' => 'Laal Maas', 'desc' => 'Rajasthani mutton curry fired with Mathania red chillies.', 'price' => 589, 'veg' => false, 'tags' => ['spicy']],
                ['name' => 'Goan Fish Curry', 'desc' => 'Basa simmered in coconut, kokum and red chilli.', 'price' => 499, 'veg' => false, 'tags' => []],
                ['name' => 'Egg Curry', 'desc' => 'Boiled eggs in a homestyle onion-tomato masala.', 'price' => 279, 'veg' => false, 'tags' => []],
            ],
        ],
        [
            'id' => 'biryani', 'title' => 'Biryani & Rice', 'img' => 'biryani',
            'intro' => 'Long-grain basmati, sealed with dough and finished on dum.',
            'items' => [
                ['name' => 'Mutton Dum Biryani', 'desc' => 'Lucknowi-style with saffron, kewra and caramelised onions. Served with raita.', 'price' => 499, 'veg' => false, 'tags' => ['chef', 'best'], 'img' => 'biryani'],
                ['name' => 'Chicken Dum Biryani', 'desc' => 'Bone-in chicken layered with fragrant basmati and whole spices.', 'price' => 399, 'veg' => false, 'tags' => ['best']],
                ['name' => 'Subz Dum Biryani', 'desc' => 'Seasonal vegetables and paneer on dum with mint and fried onions.', 'price' => 329, 'veg' => true, 'tags' => []],
                ['name' => 'Jeera Rice', 'desc' => 'Basmati tempered with cumin and ghee.', 'price' => 199, 'veg' => true, 'tags' => []],
                ['name' => 'Veg Pulao', 'desc' => 'Basmati cooked with garden vegetables and whole spices.', 'price' => 229, 'veg' => true, 'tags' => []],
                ['name' => 'Steamed Rice', 'desc' => 'Plain long-grain basmati.', 'price' => 159, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'breads', 'title' => 'Breads from the Tandoor', 'img' => 'naan-curry',
            'intro' => 'Slapped onto the clay walls of our tandoor, made to order.',
            'items' => [
                ['name' => 'Tandoori Roti', 'desc' => 'Whole-wheat flatbread. Add butter +₹10.', 'price' => 35, 'veg' => true, 'tags' => []],
                ['name' => 'Butter Naan', 'desc' => 'Soft leavened bread brushed with white butter.', 'price' => 69, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Garlic Naan', 'desc' => 'Topped with chopped garlic and fresh coriander.', 'price' => 89, 'veg' => true, 'tags' => []],
                ['name' => 'Laccha Paratha', 'desc' => 'Flaky, layered whole-wheat paratha.', 'price' => 79, 'veg' => true, 'tags' => []],
                ['name' => 'Amritsari Kulcha', 'desc' => 'Stuffed with spiced potato and onion, served with chole.', 'price' => 149, 'veg' => true, 'tags' => ['chef']],
                ['name' => 'Missi Roti', 'desc' => 'Gram-flour roti with onion, ajwain and green chilli.', 'price' => 69, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'thali', 'title' => 'Thalis', 'img' => 'thali',
            'intro' => 'A complete meal on one plate — perfect for a working lunch.',
            'items' => [
                ['name' => 'Executive Veg Thali', 'desc' => 'Paneer dish, dal makhani, seasonal sabzi, rice, 2 rotis, raita, salad, gulab jamun.', 'price' => 349, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Executive Non-Veg Thali', 'desc' => 'Butter chicken, dal makhani, sabzi, rice, 2 rotis, raita, salad, gulab jamun.', 'price' => 449, 'veg' => false, 'tags' => []],
                ['name' => 'Maharaja Thali', 'desc' => 'Starter, two curries, dal, biryani, choice of breads, raita, papad and two desserts.', 'price' => 599, 'veg' => true, 'tags' => ['chef']],
            ],
        ],
        [
            'id' => 'south-indian', 'title' => 'South Indian', 'img' => 'idli',
            'intro' => 'Served all day with fresh coconut chutney and hot sambar.',
            'items' => [
                ['name' => 'Idli Sambar (3 pcs)', 'desc' => 'Steamed rice cakes, light as a cloud.', 'price' => 149, 'veg' => true, 'tags' => []],
                ['name' => 'Masala Dosa', 'desc' => 'Golden crisp dosa filled with tempered potato masala.', 'price' => 199, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Mysore Masala Dosa', 'desc' => 'Spread with fiery red garlic chutney.', 'price' => 229, 'veg' => true, 'tags' => ['spicy']],
                ['name' => 'Medu Vada (2 pcs)', 'desc' => 'Crisp lentil doughnuts with sambar.', 'price' => 159, 'veg' => true, 'tags' => []],
                ['name' => 'Onion Uttapam', 'desc' => 'Thick rice pancake topped with onion, tomato and chilli.', 'price' => 199, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'indo-chinese', 'title' => 'Indo-Chinese', 'img' => 'chilli-chicken',
            'intro' => 'The Indian street take on Chinese — wok-tossed and full of punch.',
            'items' => [
                ['name' => 'Chilli Chicken (Dry / Gravy)', 'desc' => 'Crispy chicken tossed with peppers, onion, soy and green chilli.', 'price' => 399, 'veg' => false, 'tags' => ['spicy', 'best']],
                ['name' => 'Chilli Paneer', 'desc' => 'Paneer cubes wok-tossed with capsicum and spring onion.', 'price' => 329, 'veg' => true, 'tags' => ['spicy']],
                ['name' => 'Veg Manchurian', 'desc' => 'Vegetable dumplings in a garlicky soy-ginger sauce.', 'price' => 269, 'veg' => true, 'tags' => []],
                ['name' => 'Veg Hakka Noodles', 'desc' => 'Thin noodles with crunchy vegetables, soy and pepper.', 'price' => 249, 'veg' => true, 'tags' => []],
                ['name' => 'Chicken Fried Rice', 'desc' => 'Wok-fried rice with egg, chicken and spring onion.', 'price' => 299, 'veg' => false, 'tags' => []],
            ],
        ],
        [
            'id' => 'desserts', 'title' => 'Meetha', 'img' => null,
            'intro' => 'Every good Indian meal ends on a sweet note.',
            'items' => [
                ['name' => 'Gulab Jamun (2 pcs)', 'desc' => 'Warm khoya dumplings in cardamom-rose syrup.', 'price' => 129, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Rasmalai', 'desc' => 'Soft chenna discs in chilled saffron milk with pistachio.', 'price' => 159, 'veg' => true, 'tags' => []],
                ['name' => 'Moong Dal Halwa', 'desc' => 'Slow-roasted in pure ghee, topped with nuts. Seasonal.', 'price' => 179, 'veg' => true, 'tags' => ['chef']],
                ['name' => 'Kesar Phirni', 'desc' => 'Ground-rice pudding set in a clay pot.', 'price' => 149, 'veg' => true, 'tags' => []],
                ['name' => 'Kulfi Falooda', 'desc' => 'Malai kulfi with falooda, rose syrup and basil seeds.', 'price' => 179, 'veg' => true, 'tags' => []],
            ],
        ],
        [
            'id' => 'drinks', 'title' => 'Drinks & Mocktails', 'img' => 'cocktail',
            'intro' => 'Coolers, lassi and chai. Full bar menu available on request.',
            'items' => [
                ['name' => 'Sweet / Salted Lassi', 'desc' => 'Thick Punjabi lassi churned with malai.', 'price' => 129, 'veg' => true, 'tags' => ['best']],
                ['name' => 'Masala Chaas', 'desc' => 'Spiced buttermilk with roasted cumin and mint.', 'price' => 99, 'veg' => true, 'tags' => []],
                ['name' => 'Kokum Cooler', 'desc' => 'Tangy kokum, black salt and soda.', 'price' => 169, 'veg' => true, 'tags' => ['new']],
                ['name' => 'Virgin Mojito', 'desc' => 'Fresh mint, lime and soda over crushed ice.', 'price' => 179, 'veg' => true, 'tags' => []],
                ['name' => 'Cold Coffee', 'desc' => 'Thick, creamy and blended with ice cream.', 'price' => 159, 'veg' => true, 'tags' => []],
                ['name' => 'Masala Chai', 'desc' => 'Ginger, cardamom and a lot of love.', 'price' => 69, 'veg' => true, 'tags' => []],
            ],
        ],
    ];
}

/** Dishes that have a photo — used for the homepage "signatures" grid. */
function signature_dishes(): array
{
    $dishes = [];
    foreach (menu() as $cat) {
        foreach ($cat['items'] as $item) {
            if (!empty($item['img'])) {
                $dishes[] = $item + ['category' => $cat['title']];
            }
        }
    }
    return $dishes;
}
