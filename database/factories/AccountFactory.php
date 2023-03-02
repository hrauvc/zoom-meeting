<?php 

namespace LaravelersAcademy\ZoomMeeting\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelersAcademy\ZoomMeeting\Models\Account;

class AccountFactory extends Factory
{

	protected $model = Account::class;

	public function definition()
	{
		return [
			'account' => $this->faker->word(),
			'client' => $this->faker->word(),
			'secret' => $this->faker->word(),
			'owner_id' => $this->faker->randomDigitNotNull(),
		];
	}

}