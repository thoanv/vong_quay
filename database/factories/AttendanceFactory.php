<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Attendance;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'phone' => $this->generateOrderNumber(10),
            'code' =>   $this->generateOrderNumber(6),
            'status' => 1
        ];
    }
    public function generateOrderNumber($length = 4)
    {
        $numberID = null;
        while (!$numberID) {
            $randomString = null;
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $exist = Attendance::where('code', $randomString)->exists();
            if (!$exist) {
                $numberID = $randomString;
            }
        }
        return $numberID;
    }

}
