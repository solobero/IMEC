<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminServiceController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData["services"] = Service::all();

        return view('admin.service.index')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Service::validate($request);
        $newService = new Service();
        $newService->setName($request->input('name'));
        $newService->setDescription($request->input('description'));
        $newService->setCategory($request->input('category'));
        $newService->setImage("game.png");
        $newService->setPrice($request->input('price'));
        $newService->save();

        if ($request->hasFile('image')) {
            $imageName = $newService->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $newService->setImage($imageName);
            $newService->save();
        }

        return back();
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData["service"] = Service::findOrFail($id);
        return view('admin.service.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        Service::validate($request);
        $service = Service::findOrFail($id);
        $service->setName($request->input('name'));
        $service->setDescription($request->input('description'));
        $service->setCategory($request->input('category'));
        $service->setPrice($request->input('price'));
        $service->save();

        if ($request->hasFile('image')) {
            $imageName = $service->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put
            ($imageName,
            file_get_contents($request->file('image')->getRealPath())
        );
            $service->setImage($imageName);
        }

        $service->save();
        return redirect()->route('admin.service.index');
    }

    public function delete($id): RedirectResponse
    {
        Service::destroy($id);
        return back();
    }
}