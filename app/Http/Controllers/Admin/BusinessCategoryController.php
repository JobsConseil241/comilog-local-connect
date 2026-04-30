<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => BusinessCategory::withCount('pmes', 'opportunities')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.form', ['category' => new BusinessCategory()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = Str::slug($data['name']);

        BusinessCategory::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée.');
    }

    public function edit(BusinessCategory $category): View
    {
        return view('admin.categories.form', ['category' => $category]);
    }

    public function update(Request $request, BusinessCategory $category): RedirectResponse
    {
        $data = $this->validateData($request, $category->id);
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(BusinessCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255|unique:business_categories,name' . ($ignoreId ? ',' . $ignoreId : ''),
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|max:16',
            'is_active' => 'nullable|boolean',
        ]);
    }
}
