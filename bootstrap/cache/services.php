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
    7 => 'Illuminate\\Translation\\TranslationServiceProvider',
    8 => 'Illuminate\\Validation\\ValidationServiceProvider',
    9 => 'Pluma\\Providers\\ViewServiceProvider',
    10 => 'Pluma\\Providers\\DatabaseServiceProvider',
    11 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
    12 => 'Pluma\\Providers\\EncryptionServiceProvider',
    13 => 'Pluma\\Providers\\ModuleServiceProvider',
    14 => 'Pluma\\Providers\\RouteServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    3 => 'Illuminate\\Session\\SessionServiceProvider',
    4 => 'Pluma\\Providers\\ViewServiceProvider',
    5 => 'Pluma\\Providers\\DatabaseServiceProvider',
    6 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
    7 => 'Pluma\\Providers\\EncryptionServiceProvider',
    8 => 'Pluma\\Providers\\ModuleServiceProvider',
    9 => 'Pluma\\Providers\\RouteServiceProvider',
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
    'translator' => 'Illuminate\\Translation\\TranslationServiceProvider',
    'translation.loader' => 'Illuminate\\Translation\\TranslationServiceProvider',
    'validator' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'validation.presence' => 'Illuminate\\Validation\\ValidationServiceProvider',
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
    'Illuminate\\Translation\\TranslationServiceProvider' => 
    array (
    ),
    'Illuminate\\Validation\\ValidationServiceProvider' => 
    array (
    ),
  ),
);