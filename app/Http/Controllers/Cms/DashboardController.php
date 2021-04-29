<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard()
    {
        $params = ['title_page' => 'Dashboard'];
        return view('cms.dashboard.admin_index', $params);
    }

}
