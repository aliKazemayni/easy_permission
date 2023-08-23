<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
class RoleController extends Controller
{
    use HasApiDatatable , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new Role();
    }

    private function extraData(Model $item = null): ?array
    {
        return [];
    }

    private function relations(): array
    {
        return [];
    }

    private function requestClass(): FormRequest
    {
        return new StoreRoleRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdateRoleRequest();
    }
}
