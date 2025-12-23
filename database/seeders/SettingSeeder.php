<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'whatsapp_number',
                'value' => '919876543210',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'whatsapp_message',
                'value' => "Hi, I'm interested in {product_name}. {product_url}",
                'type' => 'textarea',
                'group' => 'contact',
            ],
            [
                'key' => 'catalogs_per_page',
                'value' => '8',
                'type' => 'number',
                'group' => 'general',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
