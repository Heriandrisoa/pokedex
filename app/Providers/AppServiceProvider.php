<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


public function boot(): void
{
    view()->share('colors', [
        'Ice' => '#B3C2F2',
        'Water' => '#5E82F7',
        'Grass' => '#97DB4F',
        'Dragon' => '#a13d3dff',
        'Fairy' => '#ff9191ff',
        'Normal' => '#cacfd8ff',
        'Electric' => '#f3ff4cff',
        'Psychic' => '#ff0080ff',
        'Bug' => '#0c6900ff',
        'Fire' => '#ff9900ff',
        'Poison' => '#9720a7ff',
        'Steel' => '#646464ff',
        'Fighting' => '#eb0303ff',
        'Dark' => '#312727ff',
        'Ground' => '#9b5a2ec0',
        'Ghost' => '#000000ff',
        'Rock' => '#682a00ff',
        'Flying' => '#1190afff',
    ]);

    view()->share('text_colors', [
        'Ice'      => '#111827',
        'Water'    => '#111827',
        'Grass'    => '#111827',
        'Dragon'   => '#FFFFFF',
        'Fairy'    => '#111827',
        'Normal'   => '#111827',
        'Electric' => '#111827',
        'Psychic'  => '#FFFFFF',
        'Bug'      => '#FFFFFF',
        'Fire'     => '#111827',
        'Poison'   => '#FFFFFF',
        'Steel'    => '#FFFFFF',
        'Fighting' => '#FFFFFF',
        'Dark'     => '#FFFFFF',
        'Ground'   => '#FFFFFF',
        'Ghost'    => '#FFFFFF',
        'Rock'     => '#FFFFFF',
        'Flying'   => '#111827',
    ]);
}
}