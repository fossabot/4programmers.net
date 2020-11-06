<?php

namespace Tests\Feature\Controllers\Job;

use Coyote\Job;
use Faker\Factory;
use Tests\TestCase;

class ApplicationControllerTest extends TestCase
{
    /**
     * @var Job
     */
    private $job;

    public function setUp(): void
    {
        parent::setUp();

        $this->job = factory(Job::class)->create();
    }

    public function testSubmitInvalidApplication()
    {
        $faker = Factory::create();

        $response = $this->json(
            'POST',
            route('job.application', [$this->job->id]),
            [
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'text' => '"Lorem" \'ipsum\'',
                'salary' => 'od 1000 zł m-c',
                'dismissal_period' => '3 dni robocze'
            ]
        );

        $response->assertJsonValidationErrors(['name']);
    }

    public function testSubmitValidApplication()
    {
        $faker = Factory::create();

        $response = $this->json(
            'POST',
            route('job.application', [$this->job->id]),
            [
                'email' => $fakeEmail = $faker->email,
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'text' => '"Lorem" \'ipsum\'',
                'salary' => 'od 1000 zł m-c',
                'dismissal_period' => '3 dni robocze'
            ]
        );

        $response->assertRedirect(route('job.offer', [$this->job->id, $this->job->slug]));

        $this->assertTrue($this->job->applications()->where('email', $fakeEmail)->exists());
    }
}