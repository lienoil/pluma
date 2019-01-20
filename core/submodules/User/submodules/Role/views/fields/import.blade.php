<p>{{ __('Roles allow you to manage user acces on each page or action. Some Modules will have a pre-configured role or set of roles. By default, these roles are not installed.') }}</p>
<p>{{ __('By continuing, the application will try to install the roles declared in each modules, if any.') }}</p>
<p>{{ __("After the installation, you may have to setup or customize the role's permissions.") }}</p>

<p>{{ __('Check all roles to be imported') }}:</p>
<div class="p-2">
  @field('treeview', [
    'label' => null,
    'actions' => [],
    'icon' => 'mdi mdi-shield-account-outline',
    'items' => $repository->roles(),
    'value' => [1],
    'id' => 'code',
    'key' => 'name',
    'text' => 'description',
  ])
</div>
