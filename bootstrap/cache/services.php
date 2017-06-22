<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Auth\\AuthServiceProvider',
    1 => 'Illuminate\\Cookie\\CookieServiceProvider',
    2 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    3 => 'Illuminate\\Hashing\\HashServiceProvider',
    4 => 'Illuminate\\Mail\\MailServiceProvider',
    5 => 'Illuminate\\Session\\SessionServiceProvider',
    6 => 'Pluma\\Providers\\ViewServiceProvider',
    7 => 'Pluma\\Providers\\DatabaseServiceProvider',
    8 => 'Pluma\\Support\\Installation\\Providers\\InstallationServiceProvider',
    9 => 'Pluma\\Providers\\EncryptionServiceProvider',
    10 => 'Pluma\\Providers\\ModuleServiceProvider',
    11 => 'Pluma\\Providers\\RouteServiceProvider',
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