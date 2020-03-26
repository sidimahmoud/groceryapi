<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param array $attributes
    * @return bool
    */
    public function update(array $attributes): bool;

   /**
    * @param array $attributes
    * @return bool
    */
   public function delete(): bool;

   /**
    * @param $id
    * @return Model
    */
   public function findById(int $id): Model;
   /**
    * @return Collection
    */
   public function all(): Collection;
}