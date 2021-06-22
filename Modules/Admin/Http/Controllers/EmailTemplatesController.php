<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\MailLog;
use App\Models\MailLogContent;
use App\Traits\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Http\Requests\EmailTemplateRequest;

class EmailTemplatesController extends Controller
{
    use SendEmail;

    public function index()
    {
        $email_templates = array_merge(['client' => [], 'staff' => []], EmailTemplate::loadAllByCategory());
        if (\Request::ajax()) {
            return response()->json([
                'data' => $email_templates,

            ], 200);
        }
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.email_templates')],
        ];

        return view('admin::pages/settings/email_templates/index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/email_templates", 'name' => __('global.email_templates')],
            ['name' => __('global.new')]
        ];
        return view('admin::pages/settings/email_templates/create', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(EmailTemplateRequest $request)
    {
        $input = $request->validated();
        try {
            EmailTemplate::create($input);
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }
        
        return redirect()->route('settings.email_templates');
    }

    public function edit(EmailTemplate $email_template)
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/email_templates", 'name' => __('global.email_templates')],
            ['name' => __('global.edit') . ': ' . $email_template->name],
        ];

        return view('admin::pages/settings/email_templates/edit', [
            'email_template' => $email_template,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function update(EmailTemplateRequest $request, EmailTemplate $email_template)
    {
        $input = $request->validated();
        try {
            $email_template->update($input);
            toastr()->success(__('global.updated_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.email_templates');
    }

    public function loadMailLogs($id, $status)
    {
        if (\Request::ajax()) {
            try {
                $category = EmailTemplate::where('id', $id)->pluck('category')->first();
                return response()->json([
                    'mail_logs' => MailLog::loadByTemplateByStatus($id, $category, $status),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function clearMailLogs($id, $status)
    {
        if (\Request::ajax()) {
            try {
                $mail_log = MailLog::where([
                    'email_template_id' => $id,
                    'status' => $status,
                ]);

                MailLogContent::whereIn('mail_log_id', $mail_log->pluck('id'))->delete();

                $mail_log->delete();

                return response()->json([
                    'message' => __('global.deleted_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function activateDeactivate($id)
    {
        if (\Request::ajax()) {
            try {
                $email_template = EmailTemplate::findOrFail($id);
                $email_template->update(['active' => $email_template->active == 0 ? 1 : 0]);

                return response()->json([
                    'message' => __('global.updated_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function sendTestMail(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $email_template = EmailTemplate::findOrfail($id);
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'message' => $validator->errors()->first(),
                    ], 400);
                }

                $this->sendEmail($request->input('email'), $email_template->getAttributes()['name'], [], false);
                return response()->json([
                    'message' => __('global.sent_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }
}
