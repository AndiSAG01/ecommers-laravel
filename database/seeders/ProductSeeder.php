<?php

namespace Database\Seeders;

use App\Models\Product;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = public_path('datajson/product.json');

        // Check if the file exists
        if (!File::exists($path)) {
            Log::error("File not found: $path");
            return;
        }

        // Read the JSON file
        $json = File::get($path);

        // Decode JSON data to PHP array
        $data = json_decode($json, true);

        // Check if JSON decoding was successful
        if ($data === null) {
            Log::error("Error decoding JSON file: $path");
            return;
        }

        // Initialize Guzzle product
        $client = new Client();
        foreach ($data as $item) {
            try {
                // Trim spaces from the URL
                $imageUrl = trim($item['image']);
                $imageName = basename($imageUrl);
                $imagePath = 'public/images/' . $imageName;

                // Download the image using Guzzle
                $response = $client->get($imageUrl);

                if ($response->getStatusCode() !== 200) {
                    throw new Exception("Failed to download image from $imageUrl");
                }

                $imageData = $response->getBody()->getContents();

                // Save the image to storage
                Storage::put($imagePath, $imageData);

                // Create car entry
                $product = Product::create([
                    'image' => 'images/'. $imageName,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'slug' => $item['slug'],
                    'category_id' => $item['category_id'],
                    'color' => $item['color'],
                    'nicotine' => $item['nicotine'],
                    'weight' => $item['weight'],
                    'qty' => $item['qty'],
                    'description' => $item['description'],
                    'status' => $item['status'],
                ]);


                $this->command->info('Tambah Product ' . $product->name);
            } catch (Exception $e) {
                Log::error("Error processing item: " . $e->getMessage());
            }
        }
    }
}
