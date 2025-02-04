<?php

namespace App\Repositories;

interface IRepository
{
    public function get($id);
    public function create($data);
    public function update($data);

    public function delete($id);
}


