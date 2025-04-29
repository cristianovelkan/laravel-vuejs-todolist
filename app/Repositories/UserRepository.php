<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    /**
     * Select all items
     * @return array
     */
    public function getAll($request)
    {
        return $this->entity->all();
    }

    /**
     * Select by ID
     * @param int $id
     * @return object
     */
    public function getById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create new item
     * @param UserRegisterRequest $user
     * @return object
     */
    public function create(Request $data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);
        $user->save();

        return $user;
    }

    /**
     * Update item
     * @param $id
     * @param array $item
     * @return object
     */
    public function update($id, Request $request)
    {
        $user = $this->entity->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        return $user->save();
    }

    /**
     * Delete item
     * @param object $item
     */
    public function delete($id)
    {
        $user = $this->entity->findOrFail($id);
        return $user->delete();
    }
}
