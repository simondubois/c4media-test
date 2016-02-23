<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

    /**
     * Filename for JSON product description in storage folder
     * @var string
     */
    private $filename = 'exempelartiklar.json';

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $path = storage_path($this->filenme);
        $products = $this->readProductsFromJsonFile($path);

        // Insert products into database
        DB::table('products')->insert($products);
    }

    /**
     * Get product from json file
     * @param  string $path Complete path to the JSON file
     * @return array        Products description
     */
    public function readProductsFromJsonFile($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}
