<?php

namespace Modules\Admin\Http\Controllers;

use App\Exports\CsvExport;
use App\Exports\ExcelExport;
use App\Models\ContactUs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return ContactUs::loadAll(false);
        }

        return view('admin::pages/contact_us/index');
    }

    public function markAsReplied(ContactUs $contact_us)
    {
        if ($contact_us->replied_at === null) {
            $contact_us->update(['replied_at' => Carbon::now()]);
            $message = 'Message Marked As Replied Successfully';
        } else {
            $message = 'Message is Already Marked As Replied';
        }

        return response()->json(['message' => $message], 200);
    }

    public function export(Request $request)
    {
        switch ($request->input('excel_format')) {
            case 'xlsx':
                return Excel::download(
                    new ExcelExport(ContactUs::loadAll(), 'admin::export.contact_us'),
                    'Contact Us Messages ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'xlsx')
                );
                break;

            case 'csv':
                return Excel::download(
                    new CsvExport(ContactUs::loadAll(), 'admin::export.contact_us'),
                    'Contact Us Messages ' . date('Y-m-d H.i') . '.'
                    . $request->input('excel_format', 'csv')
                );
                break;

                // Anther case (Maybe PDF Later)
                // return...
                // break;
        }
    }
}
