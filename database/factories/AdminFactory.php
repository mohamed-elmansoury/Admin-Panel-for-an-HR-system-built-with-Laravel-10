<?php 
namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'email' => 'momo@gmail.com',
            'user_name' => "momo",
            'name' => $this->faker->unique()->name,
            'password' => '123456789', // Default password for testing
            'added_by' => 1, // Assuming admin creation is done by the first admin
            'updated_by' => 1,
            'active' => $this->faker->boolean,
            'date' => now(),
            'com_code' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}