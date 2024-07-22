<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ApiServiceContract
{
    public function index();
    public function store(array $data);
    public function show($model);
    public function update($model, array $data);
    public function destroy($model);
}
