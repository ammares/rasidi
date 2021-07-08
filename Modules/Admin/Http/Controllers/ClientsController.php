<?php

namespace Modules\Admin\Http\Controllers;

use App\Exports\CsvExport;
use App\Exports\ExcelExport;
use App\Helpers\Helper;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Http\Requests\RenewSubscriptionRequest;
use Modules\Admin\Http\Requests\UpdateClientRequest;

class ClientsController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return Client::loadAll(false);
        }

        $breadcrumbs = [
            ['link' => "\\", 'name' => __('global.home')],
            ['name' => __('global.clients')],
        ];
        return view('admin::pages/clients/index', [
            'breadcrumbs' => $breadcrumbs]);
    }

    public function banUnban($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['ban' => $client->ban == 0 ? 1 : 0]);

        return response()->json([
            'message' => __('global.updated_successfully'),
        ], 200);
    }

    public function export(Request $request)
    {
        switch ($request->input('excel_format')) {
            case 'xlsx':
                return Excel::download(
                    new ExcelExport(Client::loadAll(), 'admin::export.clients'),
                    'Clients ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'xlsx')
                );
                break;

            case 'csv':
                return Excel::download(
                    new CsvExport(Client::loadAll(), 'admin::export.clients'),
                    'Clients ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'csv')
                );
                break;
        }
    }


}
