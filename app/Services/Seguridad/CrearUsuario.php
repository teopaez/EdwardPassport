<?php
namespace App\Services\Seguridad;

use Illuminate\Support\Facades\Hash;
use App\Repositories\UsersRepository;

class CrearUsuario
{
    public function __construct(
        public UsersRepository $usersRepository
    )
    {
        //
    }

    public function handle($name,$email,$password){
        try{
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ];
            return $this->usersRepository->create($data);
        }catch(\Exception $e){
            return null;
        }
    }
}
