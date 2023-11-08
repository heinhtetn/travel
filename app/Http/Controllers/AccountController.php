<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = User::where('is_admin', '0')->orderBy('created_at', 'desc');

            return DataTables::of($user)

            ->editColumn('created_at', function($e) {
                return Carbon::parse($e->created_at)->format("F j, Y, g:i a");
            })
            
            ->addColumn('action', function($a) {
                $promote = '<a href="" class="promoteButton btn btn-success btn-sm" data-id="'. $a->id .'">Promote</a>';

                return '<div class="action">' . $promote . '</div>';

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.accounts.index');
    }

    public function account(Request $request)
    {
        if($request->ajax())
        {
            $account = User::where('is_admin', '1')->orderBy('created_at', 'desc');

            return DataTables::of($account)

            ->editColumn('created_at', function($e) {
                return Carbon::parse($e->created_at)->format("F j, Y, g:i a");
            })
            
            ->addColumn('action', function($a) {
                $promote = '<a href="" class="promoteButton btn btn-success btn-sm" data-id="'. $a->id .'">Promote</a>';

                return '<div class="action">' . $promote . '</div>';

            })->rawColumns(['action'])->make(true);
        }

        return view('admin.accounts.account');
    }

    public function promote_user(User $user)
    {
        $user->is_admin = 1;
        $user->save();

        return response()->json(['message' => 'User promoted to admin.']);
    }

}
