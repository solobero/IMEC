<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminServiceController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['services'] = Service::all();

        return view('admin.service.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Service::validate($request);

        $newService = new Service;
        $newService->setName($request->input('name'));
        $newService->setDescription($request->input('description'));
        $newService->setCategory($request->input('category'));
        $newService->setPrice($request->input('price'));
        $newService->setImage('default.png');
        $newService->save();

        if ($request->hasFile('image')) {
            $imageName = $newService->getId().'.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public/services', $imageName);
            $newService->setImage($imageName);
            $newService->save();
        }

        return back()->with('success', 'Servicio creado correctamente.');
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData['service'] = Service::findOrFail($id);

        return view('admin.service.edit')->with('viewData', $viewData);
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
            $imageName = $service->getId().'.'.$request->file('image')->extension();
            $request->file('image')->storeAs('public/services', $imageName);
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
