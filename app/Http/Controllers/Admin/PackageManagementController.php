<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageManagementController extends Controller
{
    public function index()
    {
        $packages = Package::with('category')->latest()->paginate(15);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'min_pax'     => 'required|integer|min:1',
            'menu_type'   => 'required|string',
        ]);

        $data         = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($data);
        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket berhasil dibuat.');
    }

    public function edit(Package $package)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->except(['_token', '_method', 'image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($data);
        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket berhasil dihapus.');
    }
}
