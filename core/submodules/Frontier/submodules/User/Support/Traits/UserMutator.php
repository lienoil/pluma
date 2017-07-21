<?php

namespace User\Support\Traits;

// use Pluma\Models\Permission;
// use Pluma\Helpers\Strings;
use Closure;

trait UserMutator
{
    public function getHandlenameAttribute()
    {
        return isset($this->username) ? $this->username : studly_case("$this->firstname $this->lastname");
    }

    public function getRolenameAttribute()
    {
        return $this->rolesList;
    }

    public function getFullnameAttribute()
    {
        $name = [];
        $this->prefixname ? $name[] = $this->prefixname : '';
        $this->firstname ? $name[] = $this->firstname : '';
        // $this->middlename ? $name[] = Strings::acronym($this->middlename) : '';
        $name[] = $this->lastname;

        return implode(" ", $name);
    }

    public function getPropernameAttribute()
    {
        $name[] = $this->lastname ? "$this->lastname, " : '';
        $name[] = $this->firstname;
        // $name[] = $this->middlename ? Strings::acronym($this->middlename) : '';

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

    public function getRolesListAttribute()
    {
        if (is_null($this->roles)) return false;

        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $role->name;
        }

        return implode(" / ", $roles);
    }
}
