<?php

namespace Tests\Unit\Service;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class UserTest
 * @package Tests\Unit\Service
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_users()
    {
        $data = [
            'name' => 'Api user',
            'email' => 'api@api.api',
            'created_at' => '08-06-2021 11:00',
            'updated_at' => '08-06-2021 11:00'
        ];
        $user = User::factory()->create($data);

        $this->json('GET', '/api/users?api_token='.$user->api_token)
            ->assertStatus(200)
            ->assertJson([array_merge(
                ['id' => $user->id],
                $data
            )]);
    }

    /** @test */
    public function can_get_user_by_id()
    {
        $data = [
            'name' => 'Api user',
            'email' => 'api@api.api',
            'created_at' => '08-06-2021 11:00',
            'updated_at' => '08-06-2021 11:00'
        ];
        $user = User::factory()->create($data);

        $this->json('GET', '/api/users/'.$user->id.'?api_token='.$user->api_token)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /** @test */
    public function can_save_user()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Api user',
            'email' => 'api@api.api',
        ];

        $this->json('POST', '/api/users?api_token='.$user->api_token, $data)
            ->assertStatus(200);
    }

    /** @test */
    public function can_update_user()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Api user',
            'email' => 'api@api.api',
        ];

        $this->json('PUT', '/api/users/'.$user->id.'?api_token='.$user->api_token, $data)
            ->assertStatus(200);
    }

    /** @test */
    public function can_delete_user()
    {
        $user = User::factory()->create();

        $this->json('DELETE', '/api/users/'.$user->id.'?api_token='.$user->api_token)
            ->assertStatus(200);
    }

}
