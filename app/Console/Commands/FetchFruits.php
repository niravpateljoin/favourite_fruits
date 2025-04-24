<?php

namespace App\Console\Commands;

use App\Models\Fruit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class FetchFruits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fruits:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch fruits from Fruityvice and store them in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching fruits...');
        $response = Http::get('https://fruityvice.com/api/fruit/all');

        if ($response->failed()) {
            $this->error('Failed to fetch fruits.');
            return;
        }

        $fruits = $response->json();

        foreach ($fruits as $fruitData) {
            Fruit::updateOrCreate(
                ['name' => $fruitData['name']],
                [
                    'family' => $fruitData['family'],
                    'genus' => $fruitData['genus'],
                    'order' => $fruitData['order'],
                    'nutritions' => json_encode($fruitData['nutritions']),
                ]
            );
        }

        // Send notification email
        Mail::raw('Fruit fetch completed successfully.', function ($message) {
            $message->to('test@gmail.com')
                ->subject('Fruit Import Complete');
        });

        $this->info('Fruits saved and notification email sent.');
    }
}
