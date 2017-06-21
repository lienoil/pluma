<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Database\\DatabaseServiceProvider',
    3 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    4 => 'Illuminate\\Hashing\\HashServiceProvider',
    5 => 'Illuminate\\Mail\\MailServiceProvider',
    6 => 'Illuminate\\Session\\SessionServiceProvider',
    7 => 'Pluma\\Providers\\ViewServiceProvider',
    8 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
    9 => 'Pluma\\Providers\\EncryptionServiceProvider',
    10 => 'Pluma\\Providers\\ModuleServiceProvider',
    11 => 'Pluma\\Providers\\RouteServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Database\\DatabaseServiceProvider',
    3 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    4 => 'Illuminate\\Session\\SessionServiceProvider',
    5 => 'Pluma\\Providers\\ViewServiceProvider',
    6 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
    7 => 'Pluma\\Providers\\EncryptionServiceProvider',
    8 => 'Pluma\\Providers\\ModuleServiceProvider',
    9 => 'Pluma\\Providers\\RouteServiceProvider',
  ),
  'deferred' => 
  array (
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.mailer' => 'Illuminate\\Mail\\MailServiceProvider',
    'swift.transport' => 'Illuminate\\Mail\\MailServiceProvider',
    'Illuminate\\Mail\\Markdown' => 'Illuminate\\Mail\\MailServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Mail\\MailServiceProvider' => 
    array (
    ),
  ),
);