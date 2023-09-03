<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegraphText;
use function PHPUnit\Framework\stringContains;

class TextController extends Controller
{
    function index() {
        $models = TelegraphText::all();
        return view('models.index', compact('models'));
    }

    function create() {
        return view('models.create');
    }

    function store() {
        $data = request()->validate([
            'title' => 'string',
            'text' => 'string',
            'author' => 'string',
            'email' => 'email'
        ]);
        TelegraphText::create($data);
        return redirect()->route('models.index');
    }

    function show(TelegraphText $model) {
        return view('models.show', compact('model'));
    }

    function edit(TelegraphText $model) {
        return view('models.edit', compact('model'));
    }

    function update(TelegraphText $model) {
        $data = request()->validate([
            'title' => 'string',
            'text' => 'string',
            'author' => 'string',
            'email' => 'string'
        ]);
        $model->update($data);
        return redirect()->route('models.show', $model->id);
    }

    function destroy(TelegraphText $model) {
        $model->delete();
        return redirect()->route('models.index');
    }
}
