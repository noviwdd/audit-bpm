<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Permission;
use Illuminate\Http\Request;
use App\Services\ManagementUserService;
use Diatria\LaravelInstant\Models\Role;
use Diatria\LaravelInstant\Traits\InstantControllerTrait;

class ManagementUserController extends Controller
{
    use InstantControllerTrait;
    
    protected $service, $model;
    protected $permission = [
        "create" => "can_create_users",
        "view" => "can_view_users",
        "update" => "can_update_users",
        "delete" => "can_delete_users",
    ];

    public function __construct(User $model, ManagementUserService $service)
    {
        $this->model = $model;
        $this->service = $service->initModel($model);
    }

    public function  view(Request $request, int $id = null) {
        (new Permission($this->permission ?? null))->can("view");
        
        if ($id) {
            $data = $this->model->find($id);
            return view('management-user.index', [
                'data' => $data,
                'roles' => Role::all()
            ]);
        }
        return view('management-user.index', [
            'tables' => $this->model->all(),
            'roles' => Role::all()
        ]);
    }
}
