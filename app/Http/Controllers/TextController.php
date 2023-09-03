<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegraphText;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class TextController extends Controller
{
    /**
     * @return View
     */
    public function index(): View {
        $models = TelegraphText::all();
        return view('models.index', compact('models'));
    }

    /**
     * @return View
     */
    public function create(): View {
        return view('models.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $data = $request->validate([
            'title' => 'string',
            'text' => 'string',
            'author' => 'string',
            'email' => 'email'
        ]);
        TelegraphText::create($data);
        return redirect()->route('models.index');
    }

    /**
     * @param TelegraphText $model
     * @return View
     */
    public function show(TelegraphText $model): View {
        return view('models.show', compact('model'));
    }

    /**
     * @param TelegraphText $model
     * @return View
     */
    public function edit(TelegraphText $model): View {
        return view('models.edit', compact('model'));
    }

    /**
     * @param Request $request
     * @param TelegraphText $model
     * @return RedirectResponse
     */
    public function update(Request $request, TelegraphText $model): RedirectResponse {
        $data = $request->validate([
            'title' => 'string',
            'text' => 'string',
            'author' => 'string',
            'email' => 'string'
        ]);
        $model->update($data);
        return redirect()->route('models.show', $model->id);
    }

    /**
     * @param TelegraphText $model
     * @return RedirectResponse
     */
    public function destroy(TelegraphText $model): RedirectResponse {
        $model->delete();
        return redirect()->route('models.index');
    }
}
