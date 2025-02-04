<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\IRepository;

class UsersRepository implements IRepository
{

    public function __construct(
        public User $model
    )
    {
        //
    }

    public function get($id)
    {
    }

    public function findByEmail($email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
    }

}
