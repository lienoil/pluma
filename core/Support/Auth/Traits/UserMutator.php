<?php

namespace Pluma\Support\Auth\Traits;

use Closure;

trait UserMutator
{
    /**
     * Array of roles.
     *
     * @var array
     */
    protected $rolesnames;

    /**
     * Get the mutated handlename.
     *
     * @return string
     */
    public function getHandlenameAttribute()
    {
        return isset($this->username) ? $this->username : studly_case("$this->firstname $this->lastname");
    }

    /**
     * Get the mutated display role.
     *
     * @return string
     */
    public function getDisplayroleAttribute()
    {
        if (isset($this->roles)) {
            foreach ($this->roles as $role) {
                $this->rolesnames[] = $role->name;
            }
        } else {
            $this->rolesnames[] = __('Guest');
        }

        return implode(" / ", $this->rolesnames);
    }

    public function getFullnameAttribute()
    {
        $name = [];
        $this->prefixname ? $name[] = $this->prefixname : '';
        $this->firstname ? $name[] = $this->firstname : '';
        $name[] = $this->lastname;

        return implode(" ", $name);
    }

    public function getPropernameAttribute()
    {
        $name[] = $this->lastname ? "$this->lastname, " : '';
        $name[] = $this->firstname;

        return implode(" ", $name);
    }

    public function getDisplaynameAttribute()
    {
        $displayname = config("settings.display_name", "%firstname% %lastname%");
        $displayname = preg_replace('/%firstname%/', $this->firstname, $displayname);
        $displayname = preg_replace('/%lastname%/', $this->lastname, $displayname);
        $displayname = preg_replace('/%middlename%/', $this->middlename, $displayname);
        $displayname = preg_replace('/%prefixname%/', $this->firstname, $displayname);
        // $displayname = preg_replace('/%middleinitial%/', Strings::acronym($this->middlename, $this->middlename?true:false), $displayname);
        // $displayname = preg_replace('/%firstinitial%/', Strings::acronym($this->firstname, $this->firstname?true:false), $displayname);
        // $displayname = preg_replace('/%lastinitial%/', Strings::acronym($this->lastname, $this->lastname?true:false), $displayname);
        $displayname = preg_replace('/%fullname%/', $this->fullname, $displayname);
        $displayname = preg_replace('/%propername%/', $this->propername, $displayname);

        return ! empty($displayname) ? $displayname : $this->username;
    }

    /**
     * Gets the mutated avatar of the model.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $gender = strtolower(($this->gender ? $this->gender : 'male'));

        return property_exists($this, 'details') ? $this->details->avatar : url("core/fallback/avatars/{$gender}.png");
    }
}
