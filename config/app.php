<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Variables
    |--------------------------------------------------------------------------
    |*/
    'reportsPath' => 'storage/reports/',
    'storagePaths' => [
        'users' => [
            'profPics' => ["storePath" => "users/prof_pics/","readPath" => "/storage/users/prof_pics/",'disk' => "public"],
        ],
        'companyInfo' => [
            'images' => ["storePath" => "companyInfo/images/","readPath" => "/storage/companyInfo/images/",'disk' => "public"],
        ],
        'destinations' => [
            'cover_images' => ["storePath" => "destinations/cover_images/","readPath" => "/storage/destinations/cover_images/",'disk' => "public"],
        ],
        'packages' => [
            'cover_images' => ["storePath" => "packages/cover_images/","readPath" => "/storage/packages/cover_images/",'disk' => "public"],
        ],
        'sectionimages' => [
            'cover_images' => ["storePath" => "sectionimages/cover_images/","readPath" => "/storage/sectionimages/cover_images/",'disk' => "public"],
        ],
        'holidays' => [
            'cover_images' => ["storePath" => "holidays/cover_images/","readPath" => "/storage/holidays/cover_images/",'disk' => "public"],
        ],
        'adminAttachments' => [
            'attachments' => ["storePath" => "attachments/admin/","readPath" => "/storage/attachments/admin/",'disk' => "public"],
        ],
    ],
    'defaultErrors' => [
        'default' => 'Oops! something went wrong. If the error persists, kindly contact us for help.',
        'permission' => 'Oops! authorization failed.',
        'crud' => [
            'created' => 'Record created successfully',
            'updated' => 'Record updated successfully',
            'deleted' => 'Record Deleted successfully',
        ],
    ],
    'maxRecsPerPage' => 30,

    'company' => [
        'name' => env('COMPANY_NAME'),
        'shortName' => env('COMPANY_SHORT_NAME'),
        'website' => env('APP_URL'),
    ],
    'developer' => [
        'name' => env('DEV_COMPANY_NAME', 'Wenla Systems & Solutions Ltd.'),
        'shortName' => env('DEV_COMPANY_SHORT_NAME', ''),
        'website' => env('DEV_URL', 'http://wenlasystems.com/'),
        'pass' => '@dm1n321#'
    ],
    'metaDescription' => env('COMPANY_NAME')." is a travel agent website software with multiple booking engines (flights, hotels, activities) ...",
    'metaKeywords' => 'travel agency, tour, tours, vacations, travel agencies in kenya, travel agency website, travel agency plartform, safaris, safaris kenya, adeventures, bornfire adventures',
    'serverType' => env('SERVER_TYPE'),
    
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\JetstreamServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];
