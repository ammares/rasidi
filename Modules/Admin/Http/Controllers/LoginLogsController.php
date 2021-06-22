<?php

namespace Modules\Admin\Http\Controllers;

use App\Exports\CsvExport;
use App\Exports\ExcelExport;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class LoginLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (1 != Auth::user()->id) {
                abort(404);
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return LoginLog::loadAll();
        }

        $breadcrumbs = [
            ['link' => "admin/reports", 'name' => __('global.reports')],
            ['name' => __('global.login_logs')],
        ];

        return view('admin::pages.reports.login_logs.index', [
            'roles' => Role::select('id as key', 'name as option')->pluck('option', 'key'),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function export(Request $request)
    {
        switch ($request->input('excel_format')) {
            case 'xlsx':
                return Excel::download(
                    new ExcelExport(LoginLog::loadAll(true), 'admin::export.login_logs'),
                    __('global.login_logs') . ' ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'xlsx')
                );
                break;

            case 'csv':
                return Excel::download(
                    new CsvExport(LoginLog::loadAll(true), 'admin::export.login_logs'),
                    __('global.login_logs') . ' ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'csv')
                );
                break;
        }

    }
}
