<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
Use App\Models\Product;
Use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
Use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = Product::with(['user', 'category']);

            return Datatables::of($query)->addColumn('action', function($item) {
                return '
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('product.edit', $item->id) .'">
                                Sunting
                            </a>
                            <form action="'. route('product.destroy', $item->id) .'" method="post">
                                '. method_field('delete') . csrf_field() .'
                                <button type="submit" class="dropdown-item text-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })->rawColumns(['action'])->make();
        }

        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $categories = Category::all();

        $item = Product::findOrFail($id);

        return view('pages.admin.product.edit', [
            'item' => $item,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
