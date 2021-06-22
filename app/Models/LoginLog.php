<?php

namespace App\Models;

use App\Traits\DataViewer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class LoginLog extends Model
{
    protected $fillable = [
        'email',
        'username',
        'role_id',
        'password',
        'user_id',
        'status',
        'note',
        'ip_address',
        'user_agent',
        'user_active',
    ];

    const FAILED = 'Failed';
    const BANNED = 'Banned';
    const SUCCESS = 'Success';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function record(Request $request, $status = 'Failed', $note = '')
    {
        $user = User::whereEmail($request['email'])->first();

        return static::create([
            'email' => $request['email'],
            'username' => $user->name ?? '',
            'role_id' => $user->roles[0]->id ?? null,
            'password' => $request['password'],
            'user_id' => $user->id ?? null,
            'status' => $status,
            'note' => $note,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'user_active' => $user->active ?? null,
        ]);
    }

    public static function loadAll($export = false)
    {
        $query = LoginLog::select([
            'id',
            'created_at as login_date',
            'email',
            'username',
            'role_id',
            'ip_address',
            'status',
            'note',
        ])->with('role');

        return DataViewer::searchDataGrid($query, [
            'email',
            'username',
            'ip_address',
            'status',
            'note',
        ], $export);
    }
}
