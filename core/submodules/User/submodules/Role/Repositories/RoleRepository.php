<?php

namespace Role\Repositories;

use Illuminate\Database\QueryException;
use Pluma\Support\Modules\Traits\ModulerTrait;
use Pluma\Support\Repository\Repository;
use Role\Models\Permission;
use Role\Models\Role;

class RoleRepository extends Repository
{
    use ModulerTrait;

    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = Role::class;

    /**
     * The roles from config files.
     *
     * @var array
     */
    protected $roles = [];

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'group' => 'sometimes|required',
            'permissions' => 'required|array',
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
            'description.regex' => 'Only letters, spaces, and hypens are allowed.',
        ];
    }

    /**
     * Retrieve the grouped permissions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function permissions()
    {
        return Permission::all()->groupBy('group');
    }

    /**
     * Create model resource.
     *
     * @param array $data
     * return \Role\Models\Role
     */
    public function create(array $data)
    {
        $resource = $this->model()->create($data);
        $resource->permissions()->attach($data['permissions']);

        return $resource;
    }

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param int $id
     */
    public function update(array $data, $id)
    {
        $role = $this->model()->findOrFail($id);
        $role->name = $data['name'];
        $role->code = $data['code'];
        $role->description = $data['description'];
        $role->alias = $data['alias'];
        $role->save();
        $role->permissions()->sync($data['permissions']);
    }

    /**
     * Retrieve the file based roles
     * found in config/roles.php
     *
     * @return array
     */
    public function roles()
    {
        foreach ($this->modulePaths() as $module) {
            if (file_exists("$module/config/roles.php")) {
                $role = require "$module/config/roles.php";
                $this->roles[basename($module)] = collect($role)->recursive();
            }
        }

        return collect($this->roles ?? [])->recursive();
    }

    /**
     * Import the resources to storage.
     *
     * @param array $data
     * @return void
     */
    public function import($data = null)
    {
        foreach ($this->roles() as $module => $roles) {
            foreach ($roles as $code => $role) {
                if (in_array($code, $data['items'])) {
                    $role = collect($role)->except(['permissions'])->toArray();
                    $this->model()->updateOrCreate(['code' => $code], $role);
                }
            }
        }
    }
}
