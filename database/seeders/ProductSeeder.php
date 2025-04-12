<?php

namespace Database\Seeders;

// database/seeders/ProductSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder {
    public function run(): void {
     // Commented out the Mini Fuzzy Flower seeding
        /*
        Product::create([
            'name' => 'Mini Fuzzy Flower',
            'description' => 'Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!',
            'price' => 40.00,
            'rating' => 4.9,
            'sold' => 300,
            'available_colors' => json_encode(['white', 'pink', 'lightblue', 'purple', 'blue', 'red']),
            'stock' => 100,
            'images' => json_encode([
                'image/fuzzy1.jpg',
                'image/fuzzy-flower.jpg',
                'image/fuzzypink.jpg',
                'image/fuzzyred.jpg',
                'image/fuzzylightblue.jpg'
            ]),
        ]);
        */
   // Commented out the Mini Fuzzy Flower seeding
        /*
        Product::create([
            'name' => 'Fuzzy Lily',
            'slug' => Str::slug('Fuzzy Lily'), // Add this line
            'description' => 'Soft and elegant Fuzzy Lily. Perfect as a gift or decoration!',
            'price' => 249.99,
            'rating' => 4.9,
            'sold' => 180,
            'available_colors' => json_encode(['Pink', 'White', 'Purple']),
            'stock' => 30,
            'images' => json_encode([
                'images/fuzzyflower.jpg',
                'images/fuzzypink.jpg',
                'images/fuzzy1.jpg',
                'images/fuzzyred.jpg',
                'images/fuzzylightblue.jpg'
            ]),
        ]);
        */
   /*
        Product::create([
            'name' => 'Single Tulip Crochet Bouquet',
            'slug' => Str::slug('Single Tulip'), 
            'description' => 'Adorable crochet bouquet, perfect for adding a soft, handmade touch to your space!',
            'price' => 130.00,
            'rating' => 4.7,
            'sold' => 20,
            'stock' => 30,
            'images' => json_encode([
                'image/single-tulip.jpg'
               
            ]),
        ]);
        */

        /*
        Product::create([
            'name' => 'Cute Baby Mushroom',
            'slug' => Str::slug('Baby Mushroom'), 
            'description' => 'Adorable baby mushroom crochet bouquet, perfect for adding a soft, whimsical touch to your space!',
            'price' => 55.00,
            'rating' => 4.7,
            'sold' => 20,
            'stock' => 10,
            'images' => json_encode([
                'image/baby-mushroom.jpg'
               
            ]),
        ]);
        */
        /*
        Product::create([
            'name' => 'Handmade Crochet Top',
            'slug' => Str::slug('Crochet Top'), 
            'description' => 'Beautifully crafted handmade crochet top, perfect for adding a stylish and breathable touch to your wardrobe!',
            'price' => 300.00,
            'rating' => 4.7,
            'sold' => 3,
            'stock' => 10,
            'images' => json_encode([
                'image/crochet-top.jpg'
               
            ]),
        ]);
        */

         /*
        Product::create([
            'name' => 'Crochet Sunflower Bouquet',
            'slug' => Str::slug('sunflower'), 
            'description' => 'Brighten up any room with this vibrant and cheerful sunflower bouquet, perfect for adding a touch of nature to your space!',
            'price' => 160.00,
            'rating' => 4.8,
            'sold' => 5,
            'stock' => 10,
            'images' => json_encode([
                'image/sunflower.jpg'
               
            ]),
        ]);
         */
        /*
         Product::create([
            'name' => 'Tulip Earrings',
            'slug' => Str::slug('earrings'), 
            'description' => 'elicate tulip earrings, perfect for adding a subtle floral touch to any outfit. A must-have accessory for nature lovers!',
            'price' => 40.00,
            'rating' => 4.8,
            'sold' => 50,
            'stock' => 5,
            'images' => json_encode([
                'image/earrings.jpg'
               
            ]),
        ]);
        */
        /*
        Product::create([
            'name' => 'Tulip Headband',
            'slug' => Str::slug('headband'), 
            'description' => 'Charming tulip headband, a perfect accessory to bring a touch of nature to your look. Ideal for adding a playful, floral vibe to any outfit!',
            'price' => 90.00,
            'rating' => 4.8,
            'sold' => 10,
            'stock' => 5,
            'images' => json_encode([
                'image/headband.jpg'
               
            ]),
        ]);
       */

       Product::create([
        'name' => 'Daisy Bracelet',
        'slug' => Str::slug('daisybracelet'), 
        'description' => 'Delicate daisy bracelet, handcrafted with love to add a sweet floral charm to your everyday wear. Lightweight, cute, and perfect for gifting!',
        'price' => 49.00,
        'rating' => 4.6,
        'sold' => 87,
        'stock' => 15,
        'images' => json_encode([
            'image/daisy-bracelet.jpg'
           
        ]),
    ]);
    }
    
    
}
