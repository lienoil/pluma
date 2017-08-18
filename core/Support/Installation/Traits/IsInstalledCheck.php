<?php

namespace Pluma\Support\Installation\Traits;

use Illuminate\Support\Facades\DB;

trait IsInstalledCheck
{
    public function checkIfAppIsProperlyInstalled()
    {
        try {
            // First, check if can connect to database
            DB::connection()->getPdo();
            // Then, check if .install is deleted
            if (file_exists(public_path('.install'))) {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }

        return true;
    }
}
