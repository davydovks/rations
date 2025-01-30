<?php

namespace Database\Seeders;

use App\Models\Tariff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Yaml::parseFile(database_path('tariffs.yaml'));
        Tariff::factory(count($statuses))
            ->sequence(...$statuses)
            ->create();
    }
}
