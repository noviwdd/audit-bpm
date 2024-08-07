<?php

namespace App\Http\Controllers;

use App\Utils\Permission;
use Illuminate\Http\Request;
use App\Models\ManagementUnit;
use App\Services\ManagementUnitService;
use Diatria\LaravelInstant\Traits\InstantControllerTrait;

class ManagementUnitController extends Controller
{
    use InstantControllerTrait;

    protected $service, $model;
    protected $permission = [
        "create" => "can_create_account",
        "view" => "can_view_account",
        "update" => "can_update_account",
        "delete" => "can_delete_account",
    ];

    public function __construct(ManagementUnit $model, ManagementUnitService $service)
    {
        $this->model = $model;
        $this->service = $service->initModel($model);
    }

    public function  view(Request $request, int $id = null) {
        (new Permission($this->permission ?? null))->can("view");
        
        if ($id) {
            $data = $this->model->find($id);
            return view('management-unit.index', [
                'data' => $data
            ]);
        }
        return view('management-unit.index');
    }
}
