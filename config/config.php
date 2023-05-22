<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'base_url' => env('KUALI_BASE_URL','https://mydomain.ext/kfs'),
    'ef' => [
        'ws_endpoint' => env('KUALI_EF_WS_ENDPOINT','/ws'),
        'system_origination_code' => env('KUALI_EF_ORIGINATION_CODE'),
        'local_dir' => env('KUALI_EF_LOCAL_DIRECTORY','/kfs'),
        'mount_dir' => env('KUALI_EF_MOUNT_DIRECTORY','/mnt/kfs'),
        'default_disk' => env('KUALI_EF_DEFAULT_DISK')
    ],
    'http' => [
        'pv_endpoint' => env('KUALI_HTTP_PV_ENDPOINT'),
    ],
];