<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cache\\CacheServiceProvider',
    2 => 'Illuminate\\Cookie\\CookieServiceProvider',
    3 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    4 => 'Illuminate\\Hashing\\HashServiceProvider',
    5 => 'Illuminate\\Mail\\MailServiceProvider',
    6 => 'Illuminate\\Session\\SessionServiceProvider',
    7 => 'Illuminate\\Validation\\ValidationServiceProvider',
    8 => 'Pluma\\Providers\\ViewServiceProvider',
    9 => 'Pluma\\Providers\\DatabaseServiceProvider',
    10 => 'Pluma\\Providers\\EncryptionServiceProvider',
    11 => 'Pluma\\Providers\\ModuleServiceProvider',
    12 => 'Pluma\\Providers\\RouteServiceProvider',
    13 => 'Pluma\\Providers\\TranslationServiceProvider',
    14 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    3 => 'Illuminate\\Session\\SessionServiceProvider',
    4 => 'Pluma\\Providers\\ViewServiceProvider',
    5 => 'Pluma\\Providers\\DatabaseServiceProvider',
    6 => 'Pluma\\Providers\\EncryptionServiceProvider',
    7 => 'Pluma\\Providers\\ModuleServiceProvider',
    8 => 'Pluma\\Providers\\RouteServiceProvider',
    9 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
  ),
  'deferred' => 
  array (
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.transport' => 'Illuminate\\Mail\\MailServiceProvider',
    'Illuminate\\Mail\\Markdown' => 'Illuminate\\Mail\\MailServiceProvider',
    'validator' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'validation.presence' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'translator' => 'Pluma\\Providers\\TranslationServiceProvider',
    'translation.loader' => 'Pluma\\Providers\\TranslationServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Mail\\MailServiceProvider' => 
    array (
    ),
    'Illuminate\\Validation\\ValidationServiceProvider' => 
    array (
    ),
    'Pluma\\Providers\\TranslationServiceProvider' => 
    array (
    ),
  ),
);