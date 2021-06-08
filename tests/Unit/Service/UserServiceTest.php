<?php

namespace Tests\Unit\Service;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;

use Mockery;


class UserServiceTest extends TestCase
{
    /** @test */
    public function can_get_all_users_test()
    {
        $user = new User();
        $user->name = 'Api user';
        $user->email = 'api@user.com';

        $mockedUserRepositoryInterface = Mockery::mock(UserRepositoryInterface::class, function ($mock) use($user) {
            $mock->shouldReceive('getAll')
               ->andReturn(Collection::make($user))
               ->getMock();
        });

        $userService = new UserService($mockedUserRepositoryInterface);
        $result = $userService->index();

        $this->assertJson($result);
    }

    /** @test */
    public function can_save_new_user_test()
    {
        $data = [
            'name' => 'Api user',
            'email' => 'api@user.com',
            'api_token' => 'Ckr5Zr93sdNRJu3F97BrWWHeW9KKGiNIKRbY3VZFO1nB2g8QaCB4rl4fPIsp',
            'password' => 'jCyC6c2LHRY7uZVlA6DTeutRWUWlVBQRFqH9eAXtZ1zuBjz0oJD3FQboenUu'
        ];

        $mockedUserRepositoryInterface = Mockery::mock(UserRepositoryInterface::class, function ($mock) use($data) {
            $mock->shouldReceive('store')
                ->withArgs([Mockery::any()])
                ->andReturn(new User())
                ->getMock();
        });

        $userService = new UserService($mockedUserRepositoryInterface);
        $result = $userService->store($data);
        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function can_get_users_by_id_test()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Api user';
        $user->email = 'api@user.com';

        $mockedUserRepositoryInterface = Mockery::mock(UserRepositoryInterface::class, function ($mock) use($user) {
            $mock->shouldReceive('findById')
                ->withArgs([1])
                ->andReturn($user)
                ->getMock();
        });

        $userService = new UserService($mockedUserRepositoryInterface);
        $result = $userService->findById(1);

        $this->assertEquals($user->name, $result->name);
    }

    /** @test */
    public function can_update_user_test()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Api user';
        $user->email = 'api@user.com';

        $data = [
            'name' => 'Api user new name',
            'email' => 'api@user.com',
        ];

        $mockedUserRepositoryInterface = Mockery::mock(UserRepositoryInterface::class, function ($mock) use($data, $user) {
            $mock->shouldReceive('update')
                ->withArgs([1, $data])
                ->andReturn($user)
                ->getMock();
        });

        $userService = new UserService($mockedUserRepositoryInterface);
        $result = $userService->update(1, $data);
        $this->assertInstanceOf(User::class, $result);
    }

    /** @test */
    public function can_delete_user_test()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Api user';
        $user->email = 'api@user.com';

        $mockedUserRepositoryInterface = Mockery::mock(UserRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('delete')
                ->withArgs([1])
                ->getMock();
        });

        $userService = new UserService($mockedUserRepositoryInterface);
        $result = $userService->delete(1);
        $this->assertNull($result);
    }


}
