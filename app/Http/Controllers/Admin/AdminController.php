<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addons;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $title = 'Dashboard';
        $totalProfit = Order::where('paid', 1)->sum('amount');
        $pendingProfit = Order::where('paid', 0)->sum('amount');
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalUsers = User::count();
        $activeCarts = Cart::select('user_id')->distinct()->get()->count();
        $totalProducts = Product::count();
        $totalAddons = Addons::count();
        $ordersStats = $this->getOrdersStats();
        $profitStats = $this->getProfitStats();

        return view('admin.index', [
            'title' => $title,
            'totalProfit' => $totalProfit,
            'pendingProfit' => $pendingProfit,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'todayOrders' => $todayOrders,
            'activeCarts' => $activeCarts,
            'totalProducts' => $totalProducts,
            'totalAddons' => $totalAddons,
            'ordersStats' => $ordersStats,
            'profitStats' => $profitStats
        ]);
    }

    private function getOrdersStats()
    {
        $ordersPerMonth = DB::table('orders')
            ->select(DB::raw("DATE_FORMAT(created_at, '%m') as month"), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $sortedMonths = $ordersPerMonth->sortBy('month');

        return $sortedMonths->mapWithKeys(function ($month) {
            return [substr(date('F', mktime(0, 0, 0, $month->month, 10)), 0, 3) => $month->count];
        });
    }


    private function getProfitStats()
    {
        $ordersPerMonth = DB::table('orders')
            ->select(DB::raw("DATE_FORMAT(created_at, '%m') as month"), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('month')
            ->get();

        $sortedMonths = $ordersPerMonth->sortBy('month');

        return $sortedMonths->mapWithKeys(function ($month) {
            return [substr(date('F', mktime(0, 0, 0, $month->month, 10)), 0, 3) => $month->total_amount];
        });
    }


    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:admin,email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Welcome back ' . auth('admin')->user()->name . ' !');
        }

        return back()->with(['error' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('admin.login'))->with('success', 'See you soon!');
    }

}
