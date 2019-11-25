<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\AnimalsRepository;
use App\Repositories\AdoptionsRepository;
use App\Repositories\CallsRepository;
use App\Repositories\FostersRepository;
use App\Repositories\LivingAreasRepository;
use App\Repositories\PeopleRepository;
use App\Repositories\ProceduresRepository;
use App\Repositories\ReclaimsRepository;
use App\Repositories\SpeciesRepository;
use App\Repositories\ColorsRepository;
use App\Repositories\StaffRepository;
use App\Repositories\ProcedureTypesRepository;
use App\Repositories\IntakeTypesRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\ImagesRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IAdoptionsRepository;
use App\Repositories\Interfaces\ICallsRepository;
use App\Repositories\Interfaces\IFostersRepository;
use App\Repositories\Interfaces\ILivingAreasRepository;
use App\Repositories\Interfaces\IPeopleRepository;
use App\Repositories\Interfaces\IProceduresRepository;
use App\Repositories\Interfaces\IReclaimsRepository;
use App\Repositories\Interfaces\ISpeciesRepository;
use App\Repositories\Interfaces\IColorsRepository;
use App\Repositories\Interfaces\IStaffRepository;
use App\Repositories\Interfaces\IProcedureTypesRepository;
use App\Repositories\Interfaces\IIntakeTypesRepository;
use App\Repositories\Interfaces\ISettingsRepository;
use App\Repositories\Interfaces\IUsersRepository;
use App\Repositories\Interfaces\IImagesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IAnimalsRepository::class, 
            AnimalsRepository::class
        );

        $this->app->bind(
            IAdoptionsRepository::class, 
            AdoptionsRepository::class
        );

        $this->app->bind(
            ICallsRepository::class, 
            CallsRepository::class
        );

        $this->app->bind(
            IFostersRepository::class, 
            FostersRepository::class
        );

        $this->app->bind(
            ILivingAreasRepository::class, 
            LivingAreasRepository::class
        );

        $this->app->bind(
            IPeopleRepository::class, 
            PeopleRepository::class
        );

        $this->app->bind(
            IProceduresRepository::class, 
            ProceduresRepository::class
        );

        $this->app->bind(
            IReclaimsRepository::class, 
            ReclaimsRepository::class
        );

        $this->app->bind(
            ISpeciesRepository::class, 
            SpeciesRepository::class
        );

        $this->app->bind(
            IColorsRepository::class, 
            ColorsRepository::class
        );

        $this->app->bind(
            IStaffRepository::class, 
            StaffRepository::class
        );

        $this->app->bind(
            IProcedureTypesRepository::class, 
            ProcedureTypesRepository::class
        );

        $this->app->bind(
            IIntakeTypesRepository::class, 
            IntakeTypesRepository::class
        );

        $this->app->bind(
            ISettingsRepository::class, 
            SettingsRepository::class
        );

        $this->app->bind(
            IUsersRepository::class, 
            UsersRepository::class
        );

        $this->app->bind(
            IImagesRepository::class, 
            ImagesRepository::class
        );
    }
}
