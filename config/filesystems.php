<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
<<<<<<< HEAD
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),
=======
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

<<<<<<< HEAD
    'cloud' => env('FILESYSTEM_CLOUD', 's3'),
=======
    'cloud' => 's3',
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
<<<<<<< HEAD
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
<<<<<<< HEAD
            'url' => env('APP_URL').'/storage',
=======
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
<<<<<<< HEAD
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
=======
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
>>>>>>> f87259c8f0a22fc60bf3c85dc0ec1809fb92c25c
        ],

    ],

];
