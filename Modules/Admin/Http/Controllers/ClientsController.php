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

    public function gatewayDetails(Request $request, Client $client)
    {
        return response()->json([
            'data' => Client::hardwareDetails($client->id),
        ], 200);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $input = $request->validated();

        if (isset($input["latitude"]) & isset($input["longitude"])) {
            $country_and_city = Helper::getCountryAndCityByGeoCordinate($input["latitude"], $input["longitude"], App()->getLocale());
            if ($country_and_city['status'] != 200) {
                return response()->json([
                    'message' => $country_and_city['message'],
                ], 200);
            }

            $input['city_id'] = $country_and_city['city_id'];
            $input['country_id'] = $country_and_city['country_id'];
        }

        $client->update($input);

        return response()->json(['message' => __('global.updated_successfully')], 201);
    }

    public function activateDeactivate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['active' => $client->active == 0 ? 1 : 0]);

        return response()->json([
            'message' => __('global.updated_successfully'),
        ], 200);
    }

    public function banUnban($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['ban' => $client->ban == 0 ? 1 : 0]);

        return response()->json([
            'message' => __('global.updated_successfully'),
        ], 200);
    }

    public function resetPassword($id)
    {
        $client = Client::findOrFail($id);
        $password = str::random(8);
        $client->update(['password' => Hash::make($password)]);
        $message = __('global.password_reset') . '<button class="mx-2 btn btn-warning waves-effect waves-float waves-light" onclick="copyToClipboard(\'' . $password . '\')">'
        . __('global.copy') . '</button>';

        return response()->json(['message' => $message], 200);
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

    public function renewSubscription(RenewSubscriptionRequest $request, $id)
    {
        $post_data = $request->validated();

        $client = Client::findOrFail($id);
        $client->gateway()->update($post_data);

        return response()->json([
            'message' => __('global.updated_successfully'),
        ], 200);
    }
}
