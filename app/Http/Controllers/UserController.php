<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\Invoice;
use App\Notifications\sendMessage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;
use App\Repositories\UserRepository\EloquentUserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $user_repository;

    /**
     * 
     * @var UserRepositoryInterface
     * @param  mixed $user_repository
     * @return void
     */
    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @method GET
     * @return JsonResponse
     */
    public function index()
    {
        //        $users = $this->user_repository->all();
        $users = resolve(EloquentUserRepository::class)->all();

        return response()->json(['users' => $users], Response::HTTP_OK);
    }

    public function sendNotification()
    {
        $price = [
            'id' => 1,
            'amount' => 895420,
        ];
        Notification::send(User::all(), new Invoice($price));
        //        $user = User::find(1);
        //        $user->notify(new Invoice($price));

        //        $message = [
        //            'text'=>'یک مقاله اضافه شد',
        //        ];
        //        $user = User::find(1);
        //        $user->notify(new sendMessage($message));
    }

    /**
     * showNotification
     * @method GET
     * @return void
     */
    public function showNotification()
    {
        $user = User::find(1);

        return $user->notifications;

        //        return $user->unreadnotifications[0]->markAsRead();
        //        return $user->unreadnotifications;

        //        return $user->readnotifications;
    }

    public function excelExport()
    {
        return Excel::download(new UsersExport, 'users_with_password.xlsx');
    }

    public function excelImport()
    {
        Excel::import(new UsersImport, request()->file('excel')->store('temp'));
        return redirect('/')->with('success', 'All good!');
    }
}
