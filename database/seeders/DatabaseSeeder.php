<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags'  => 'Laravel, Javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Bostan, MA',
        //     'email' => 'email@email.com',
        //     'website' => 'https://acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, alias. At inventore consequuntur aliquid sapiente maiores error natus neque eum voluptates doloremque? Quia quae, cumque aliquid quo nemo nobis facilis natus eos laudantium ad rerum voluptatem molestias assumenda sed laborum. Voluptatibus odio consequuntur nisi amet autem? Sapiente minus aliquid praesentium.'
        // ]);

        // Listing::create(  [
        //     'title' => 'Full Stack Engineer',
        //     'tags'  => 'Laravel, backen, api',
        //     'company' => 'Stark Industries',
        //     'location' => 'New Yark, UA',
        //     'email' => 'email12@email.com',
        //     'website' => 'https://stark-industries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, alias. At inventore consequuntur aliquid sapiente maiores error natus neque eum voluptates doloremque? Quia quae, cumque aliquid quo nemo nobis facilis natus eos laudantium ad rerum voluptatem molestias assumenda sed laborum. Voluptatibus odio consequuntur nisi amet autem? Sapiente minus aliquid praesentium.'
        // ]);



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
