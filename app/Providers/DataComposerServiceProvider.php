<?php

namespace App\Providers;

use App\Models\Booked;
use App\Models\DataField;
use App\Models\FieldList;
use App\Models\PlayingTime;
use Illuminate\Support\ServiceProvider;

class DataComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $data = [
                'playingTimes' => PlayingTime::all(),
                'fieldLists' => FieldList::all(),
                'dataFields' => DataField::all(),
                'bookeds' => Booked::all(),
            ];

            $view->with($data);
        });
    }
}
