<?php

return [
  'app_id'=> env('FACEBOOK_CLIENT_ID'),
  'app_secret'=> env('FACEBOOK_CLIENT_SECRET'),
  'default_access_token'=> env('FACEBOOK_DEFAULT_ACCESS_TOKEN', ''),
  'login_callback_url' => env('FACEBOOK_REDIRECT_URI'),
  'version'=> env('FACEBOOK_APP_VERSION', 'v10.0')
];
