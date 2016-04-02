<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Client Login');
    }

    public function testBasicExampleTwo()
    {
        $this->visit('/')
             ->see('Login');
    }

    public function testBasicExampleThree()
    {
        $this->visit('/')
             ->see('Naughton & Ross ClientApp');
    }

    public function testAuth()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->get('/clients')
             ->seeJson([
                 'id' => 1,
             ]);
    }
}
