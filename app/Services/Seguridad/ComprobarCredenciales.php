<?php
namespace App\Services\Seguridad;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UsersRepository;

class ComprobarCredenciales {
    public function __construct(
        public UsersRepository $usersRepository
    )
    {
        //
    }

    public function handle($email,$password){
        try{
            $user = $this->usersRepository->findByEmail($email);
            if ($user == null) {
                return null;
            }elseif(Hash::check($password, $user->password)){
                //crear token
                $carbon  = Carbon::now()->addMinutes(60);
                $tokenObject = $user->createToken('token',['*'],$carbon);
                $token = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $tokenObject->plainTextToken
                ];
                return $token;
            }
            return null;
        }catch(Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }
}
