<?php

namespace App\Providers;

use App\Repositories\CategoryRepo;
use App\Repositories\CollectionRepo;
use App\Repositories\GroupRepo;
use App\Repositories\ImageRepo;
use App\Repositories\impl\CategoryRepositoryImpl;
use App\Repositories\impl\CollectionRepositoryImpl;
use App\Repositories\impl\GroupRepositoryImpl;
use App\Repositories\impl\ImageRepositoryImpl;
use App\Repositories\impl\ProductRepositoryImpl;
use App\Repositories\impl\SupplierRepositoryImpl;
use App\Repositories\impl\UserRepositoryImpl;
use App\Repositories\impl\UsingImageRepositoryImpl;
use App\Repositories\impl\UsingTypeRepositoryImpl;
use App\Repositories\ProductRepo;
use App\Repositories\SupplierRepo;
use App\Repositories\UserRepo;
use App\Repositories\UsingImageRepo;
use App\Repositories\UsingTypeRepo;
use App\Services\AuthenticationService;
use App\Services\CollectionService;
use App\Services\GroupService;
use App\Services\Impl\AuthenticationServiceImpl;
use App\Services\Impl\CollectionServiceImpl;
use App\Services\Impl\GroupServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use App\Services\Impl\StorageServiceImpl;
use App\Services\Impl\UserServiceImpl;
use App\Services\ProductService;
use App\Services\StorageService;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        foreach ([
//                     CollectionDataAccessService::class,
//                     CollectionDAO::class,
//                     CollectionService::class,
//                 ] as $service) {
//            $this->app->singleton($service);
//        }

//        $this->app->singleton(CollectionService::class);

//        $this->app->singleton(
//            CollectionService::class,
//            CollectionServiceImpl::class
//        );

        $this->app->bind(
            CollectionService::class,
            CollectionServiceImpl::class
        );

        $this->app->bind(
            UserService::class,
            UserServiceImpl::class
        );

        $this->app->bind(
            ProductService::class,
            ProductServiceImpl::class
        );

        $this->app->bind(
            StorageService::class,
            StorageServiceImpl::class
        );

        $this->app->bind(
            GroupService::class,
            GroupServiceImpl::class
        );

        $this->app->bind(
            AuthenticationService::class,
            AuthenticationServiceImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping(); // Hủy bọc 'data' khi trả về
        $this->app->bind(CollectionRepo::class, CollectionRepositoryImpl::class);
        $this->app->bind(UserRepo::class, UserRepositoryImpl::class);
        $this->app->bind(ProductRepo::class, ProductRepositoryImpl::class);
        $this->app->bind(UsingTypeRepo::class, UsingTypeRepositoryImpl::class);
        $this->app->bind(ImageRepo::class, ImageRepositoryImpl::class);
        $this->app->bind(UsingImageRepo::class, UsingImageRepositoryImpl::class);
        $this->app->bind(CategoryRepo::class, CategoryRepositoryImpl::class);
        $this->app->bind(SupplierRepo::class, SupplierRepositoryImpl::class);
        $this->app->bind(GroupRepo::class, GroupRepositoryImpl::class);
    }
}
