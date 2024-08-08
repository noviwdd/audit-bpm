<?php
namespace App\Services;

use App\Models\User;
use Diatria\LaravelInstant\Traits\InstantServiceTrait;
use Illuminate\Support\Collection;

class ManagementUserService {
    use InstantServiceTrait {
        store as protected storeTrait;
    }

    /**
     * Class model yang digunakan
     * 
     * @var App\Models\User
     */
    protected $model;

    /**
     * Path pagination
     * 
     * @var string
     */
    protected $paginationPath = '/management-user/table';

    /**
     * List kolom yang akan ditampilkan
     * 
     * @var array
     */
    protected $columns = [];

    /**
     * List kolom yang required ketika akan menyimpan data
     * 
     * @var array
     */
    protected $columnsRequired = [];
    
    /**
     * @param App\Models\User $model class
     */
    public function initModel()
    {
        $this->model = (new User());
        return $this;
    }

    public function store(Collection $params)
    {
        if ($params->has('password')) {
            $params->put('password', bcrypt($params->get('password')));
        } else {
            $params->pull('password');
        }
        return $this->storeTrait($params);
    }
}