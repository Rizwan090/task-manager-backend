<?php
namespace Modules\Core\Database\factories;

use Modules\Core\Entities\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;


    /**
     * @return string[]
     */
    public function definition(): array
    {

        return [
            "name" => "Writer"
        ];
    }

}

