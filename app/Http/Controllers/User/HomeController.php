<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        $packages   = Package::where('is_active', true)
                        ->with('category')
                        ->latest()
                        ->get();

        return view('user.home', compact('categories', 'packages'));
    }
}
