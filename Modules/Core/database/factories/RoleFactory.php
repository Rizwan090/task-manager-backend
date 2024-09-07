<?php
namespace Modules\Core\Database\factories;

use Modules\Core\Entities\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;


    /**
     * @return string[]
     */
    public function definition(): array
    {

        return [
            "name" => "Admin"
        ];
    }

}

