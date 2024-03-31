<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlacesController extends Controller
{
    // عرض قائمة الأماكن السياحية
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
    }

    // عرض تفاصيل مكان سياحي محدد
    public function show($id)
    {
        $place = Place::findOrFail($id);
        return view('places.show', compact('place'));
    }

    // إضافة مكان سياحي جديد
    public function create()
    {
        return view('places.create');
    }

    // حفظ مكان سياحي جديد
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // يمكنك إضافة المزيد من القواعد الخاصة بالتحقق من البيانات هنا
        ]);

        Place::create($validatedData);

        return redirect('/places')->with('success', 'تمت إضافة المكان السياحي بنجاح.');
    }

    // عرض نموذج لتعديل مكان سياحي محدد
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('places.edit', compact('place'));
    }

    // تحديث مكان سياحي محدد
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // يمكنك إضافة المزيد من القواعد الخاصة بالتحقق من البيانات هنا
        ]);

        Place::whereId($id)->update($validatedData);

        return redirect('/places')->with('success', 'تم تحديث المكان السياحي بنجاح.');
    }

    // حذف مكان سياحي محدد
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return redirect('/places')->with('success', 'تم حذف المكان السياحي بنجاح.');
    }
}
