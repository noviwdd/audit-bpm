<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Utils\Permission;
use Illuminate\Http\Request;
use App\Services\UnitService;
use Diatria\LaravelInstant\Traits\InstantControllerTrait;

class UnitController extends Controller
{
    use InstantControllerTrait;
    
    protected $service, $model;
    protected $permission = [
        "create" => "can_create_units",
        "view" => "can_view_units",
        "update" => "can_update_units",
        "delete" => "can_delete_units",
    ];

    public function __construct(Unit $model, UnitService $service)
    {
        $this->model = $model;
        $this->service = $service->initModel($model);
    }

    public function  view(Request $request, int $id = null) {
        (new Permission($this->permission ?? null))->can("view");
        
        if ($id) {
            $data = $this->model->find($id);
            return view('unit.index', [
                'data' => $data,
            ]);
        }
        return view('unit.index', [
            'tables' => $this->model->all()
        ]);
    }
}
