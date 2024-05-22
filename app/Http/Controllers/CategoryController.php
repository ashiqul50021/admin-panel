<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\User;
use Exception;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        view()->share("user_category", "active");
    }



    public function index()
    {
        $categories = Category::paginate(config("system.pagination.per_page"));
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(CategoryFormRequest $request)
    {
        $data = $request->getData();
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category was successfully added.');
    }


    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }


    public function update(Category $category, CategoryFormRequest $request)
    {
        $data = $request->getData();
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category was successfully updated.');
    }


    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category was successfully deleted.');
        } catch (Exception $exception) {
            return redirect()->route('categories.index')->with('error', 'Something Went Wrong.');
        }
    }
}
