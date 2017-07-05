<?php return array (
  'providers' => 
  array (
    0 => 'Pluma\\Providers\\RouteServiceProvider',
    1 => 'Illuminate\\Auth\\AuthServiceProvider',
    2 => 'Illuminate\\Cache\\CacheServiceProvider',
    3 => 'Illuminate\\Cookie\\CookieServiceProvider',
    4 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    5 => 'Illuminate\\Hashing\\HashServiceProvider',
    6 => 'Illuminate\\Mail\\MailServiceProvider',
    7 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    8 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    9 => 'Illuminate\\Session\\SessionServiceProvider',
    10 => 'Illuminate\\Validation\\ValidationServiceProvider',
    11 => 'Pluma\\Providers\\ViewServiceProvider',
    12 => 'Pluma\\Providers\\DatabaseServiceProvider',
    13 => 'Pluma\\Providers\\EncryptionServiceProvider',
    14 => 'Pluma\\Providers\\ModuleServiceProvider',
    15 => 'Pluma\\Providers\\TranslationServiceProvider',
    16 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Pluma\\Providers\\RouteServiceProvider',
    1 => 'Illuminate\\Auth\\AuthServiceProvider',
    2 => 'Illuminate\\Cookie\\CookieServiceProvider',
    3 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    4 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    5 => 'Illuminate\\Session\\SessionServiceProvider',
    6 => 'Pluma\\Providers\\ViewServiceProvider',
    7 => 'Pluma\\Providers\\DatabaseServiceProvider',
    8 => 'Pluma\\Providers\\EncryptionServiceProvider',
    9 => 'Pluma\\Providers\\ModuleServiceProvider',
    10 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
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
    'Illuminate\\Contracts\\Pipeline\\Hub' => 'Illuminate\\Pipeline\\PipelineServiceProvider',
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
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
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