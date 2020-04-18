<?php

namespace App\Repository\Eloquent;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $allowedFilters = [];
    
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
    
    //Work arround for update fonction not the final solution
    /**
     * Update model
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return User::where('id', '=', $data['id'] )
                ->update($data);
    }

}