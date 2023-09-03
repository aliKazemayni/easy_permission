<?php

namespace Alikazemayni\EasyPermission\Http\Controllers;

use Alikazemayni\EasyPermission\Models\Section;
use Alikazemayni\EasyPermission\Http\Requests\Section\StoreSectionRequest;
use Alikazemayni\EasyPermission\Http\Requests\Section\UpdateSectionRequest;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasIndex;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

class SectionController extends Controller
{
    use HasIndex , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new Section();
    }

    private function extraData(Model $item = null): ?array
    {
        return [];
    }

    private function relations(): array
    {
        return [
            'permission' => fn($q) => $q->with(
                [
                    'users' => function($user){
                        return $user->select('id')->find(request()->user_id);
                    },
                    'role' => function($role) {
                        return $role->where('roles.id',request()->role_id);
                    }
                ]
            ),
        ];
    }

    private function requestClass(): FormRequest
    {
        return new StoreSectionRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdateSectionRequest();
    }

    private function indexView(): View
    {
        // TODO: Implement indexView() method.
    }
}
