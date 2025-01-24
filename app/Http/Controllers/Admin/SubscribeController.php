<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Subscribe;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscribeStoreRequest;
use App\Http\Requests\Admin\SubscribeUpdateRequest;


class SubscribeController extends Controller
{

    public function index(): View
    {
        return view('admin.subscribe.index', [
            'subscribes' => Subscribe::query()->select(['id', 'email'])->latest()->get()
        ]);
    }

    // public function create(): View
    // {
    //     return view('admin.subscribe.create');
    // }

    // public function store(SubscribeStoreRequest $request): RedirectResponse
    // {
    //     $subscribe = Subscribe::create($request->validated());

    //     return redirect()->route('admin.subscribes.index')->with('success', 'Subscribe Created Successfully!');
    // }

    public function show(Subscribe $subscribe): View
    {
        return view('admin.subscribe.show', compact('subscribe'));
    }

    // public function edit(Subscribe $subscribe): View
    // {
    //     return view('admin.subscribe.edit', compact('subscribe'));
    // }

    // public function update(SubscribeUpdateRequest $request, Subscribe $subscribe): RedirectResponse
    // {
    //     $subscribe->update($request->validated());

    //     return redirect()->route('admin.subscribes.index')->with('success', 'Subscribe Updated Successfully!');
    // }

    public function destroy(Subscribe $subscribe): RedirectResponse
    {
        $subscribe->delete();

        return redirect()->route('admin.subscribes.index')->with('error', 'Subscribe Deleted Successfully!');
    }
}
