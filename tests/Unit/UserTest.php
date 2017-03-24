<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class UserTest
 * @package Tests\Unit
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class)->create([
            'email' => 'edo@example.com',
        ]);

        $this->assertEquals('edo@example.com', $user->email);
        $this->assertNotEquals('edo@example.com', $user->password);
    }
}
