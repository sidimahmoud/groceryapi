<?php

namespace App\Repository\Eloquent;

use App\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   /**
     * Create user
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        /** @var User $user */
        $user = parent::create($data);
        
        return $user;
    }

}