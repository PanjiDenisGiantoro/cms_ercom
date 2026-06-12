<?php

namespace Database\Seeders;

use App\Models\AboutSetting;
use App\Models\CtaBannerSetting;
use App\Models\FooterSetting;
use App\Models\HeroSetting;
use App\Models\SeoSetting;
use App\Models\TeamSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'editor']);

        $user = User::factory()->create([
            'name' => 'Admin ER Comm',
            'email' => 'admin@ercommunication.id',
        ]);
        $user->assignRole($admin);

        HeroSetting::firstOrCreate(['id' => 1]);
        AboutSetting::firstOrCreate(['id' => 1]);
        CtaBannerSetting::firstOrCreate(['id' => 1]);
        FooterSetting::firstOrCreate(['id' => 1]);
        SeoSetting::firstOrCreate(['id' => 1]);
        TeamSetting::firstOrCreate(['id' => 1]);
    }
}
