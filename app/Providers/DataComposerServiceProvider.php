<?php

namespace App\Providers;

use App\Models\Booked;
use App\Models\DataField;
use App\Models\FieldList;
use App\Models\SocmedLinks;
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
            $socmedLinks = SocmedLinks::all();
            $facebookLink = $socmedLinks->where('name', 'Facebook')->first();
            $instagramLink = $socmedLinks->where('name', 'Instagram')->first();
            $linkedinLink = $socmedLinks->where('name', 'Linkedin')->first();
            $twitterLink = $socmedLinks->where('name', 'Twitter')->first();
            $youtubeLink = $socmedLinks->where('name', 'Youtube')->first();

            $data = [
                'fieldLists' => FieldList::all(),
                'facebookLink' => $facebookLink,
                'linkedinLink' => $linkedinLink,
                'instagramLink' => $instagramLink,
                'twitterLink' => $twitterLink,
                'youtubeLink' => $youtubeLink,
            ];

            $view->with($data);
        });
    }
}
