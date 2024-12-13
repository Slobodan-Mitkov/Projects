<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('position.index');
    }

    public function create()
    {
        return view('position.create');
    }

    public function store(Request $request)
    {
        return view('position.store');
    }

    public function show($id)
    {
        return view('position.show');
    }

    public function edit($id)
    {
        return view('position.edit');
    }

    public function update(Request $request, $id)
    {
        return view('position.update');
    }
}
