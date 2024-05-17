<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement(['Nasi Goreng','Ayam Goreng','Soto Ayam','Mie Goreng','Nasi Uduk','Rendang','Gado-gado','Martabak','Bakso','Pecel', 'Teh Tarik','Es Teh Manis','Kopi Susu','Jus Alpukat','Es Jeruk','Soda Gembira','Cendol','Kopi Luwak','Bandrek','Es Cincau', 'Kemeja','Celana Jeans','Jaket','Gaun','Kaus','Kemeja Flanel','Kaos Polo','Rok','Hoodie','Kemeja Batik']),
            'description' => fake()->randomElement(['Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit']),
            'price' => fake()->numberBetween(5000, 100000),
            'image' => fake()->randomElement(['https://plus.unsplash.com/premium_photo-1661964088064-dd92eaaa7dcf?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cmFuZG9tJTIwb2JqZWN0c3xlbnwwfHwwfHx8MA%3D%3D', 'https://plus.unsplash.com/premium_photo-1674241387724-dd198d4fd0b1?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'https://plus.unsplash.com/premium_photo-1682310371694-71b2c836eec9?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']),
            'category_id' => fake()->numberBetween(1, 3),
            'expired_at' => now()->addDays(12),
            'modified_by' => fake()->randomElement(['orang@gmail.com', 'user@gmail.com'])
        ];
    }
}
