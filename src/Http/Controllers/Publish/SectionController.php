<?php

namespace Alikazemayni\EasyPermission\Http\Controllers\Publish;

use Alikazemayni\EasyPermission\Http\Controllers\Controller;
use Alikazemayni\EasyPermission\Http\Requests\Section\StoreSectionRequest;
use Alikazemayni\EasyPermission\Http\Requests\Section\UpdateSectionRequest;
use Alikazemayni\EasyPermission\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

class SectionController extends Controller
{
    use HasApiDatatable , HasShow , HasStore , HasUpdate , HasDestroy;

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
        return [];
    }

    private function requestClass(): FormRequest
    {
        return new StoreSectionRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdateSectionRequest();
    }
}
