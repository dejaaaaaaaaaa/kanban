<?php

namespace App\Providers;

use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\SearchTicketRepositoryInterface;
use App\Repositories\Interfaces\SearchUserRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\PriorityRepository;
use App\Repositories\SearchTicketRepository;
use App\Repositories\SearchUserRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->bind(PriorityRepositoryInterface::class, PriorityRepository::class);
        $this->app->bind(SearchTicketRepositoryInterface::class, SearchTicketRepository::class);
        $this->app->bind(SearchUserRepositoryInterface::class, SearchUserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
