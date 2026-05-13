<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->get();

        $query = Package::where('is_active', true)->with('category');

        if ($request->category && $request->category !== 'semua-paket') {
            $query->whereHas('category', fn($q) =>
                $q->where('slug', $request->category)
            );
        }

        $packages = $query->latest()->get();

        return view('user.packages.index', compact('packages', 'categories'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
                    ->where('is_active', true)
                    ->with(['category', 'items'])
                    ->firstOrFail();

        $related = Package::where('category_id', $package->category_id)
                    ->where('id', '!=', $package->id)
                    ->where('is_active', true)
                    ->limit(3)
                    ->get();

        return view('user.packages.show', compact('package', 'related'));
    }
}
