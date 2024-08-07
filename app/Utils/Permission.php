<?php
namespace App\Utils;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class Permission
{
    protected $permission, $action;
    public function __construct(array $permission)
    {
        $this->permission = $permission;
    }

    public function can($action)
    {
        $this->action = $action;

        $user = User::where("id", Auth::id())->first();
        
        if (!$user) {
            throw new Exception("Unauthorized", 401);
        }

        $haveAccess = in_array(
            $this->getAction(),
            $user->permissions->toArray()
        );

        if (!$haveAccess) {
            throw new ErrorException("Permission denied", 403);
        }

        return $haveAccess;
    }

    public function getAction()
    {
        return Helper::get($this->permission, $this->action);
    }
}
