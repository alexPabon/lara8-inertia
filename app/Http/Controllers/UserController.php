<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class UserController extends Controller
{
    public function userTeams(){

        $users = $this->getUsers();


//return $users['users'];
        return Inertia::render('Dashboard',['users'=>$users['users'], 'paginationVue'=>$users['paginationVue']]);
    }

    public function users(){
        $users = $this->getUsers();
        return Inertia::render('Dashboard',['users'=>$users['users'], 'paginationVue'=>$users['paginationVue']]);
    }

    public function teams(){
        $users = $this->getUsers();
        return Inertia::render('Dashboard',['users'=>$users['users'], 'paginationVue'=>$users['paginationVue']]);
    }

    public function getUsers(){


        $perPage = $_GET['perPage']??Session::get('usersPerPage')??20;
        $page = $_GET['page']??Session::get('usersPage')??1;

        $users = User::paginate($perPage,['*'],'page',$page);

        if($users->lastPage()<$page){
            $page = 1;

            $users = User::paginate($perPage,['*'],'page',$page);
        }

        $users->setPath(route('getUsers'));

        $usersId = $users->pluck('id')->toArray();
        $sessionActive = DB::table('sessions')->whereNotNull('user_id')->whereIn('user_id',$usersId)->orderBy('last_activity','ASC')->distinct()->pluck('last_activity','user_id')->toArray();


        $users->transform(function($user) use ($sessionActive){


            $defaultValue  = 500000;
            $lastActivity = $sessionActive[$user->id]??$defaultValue;
            $inactive = date(strtotime(now())) - $lastActivity;
            $now = Carbon::now()->format('d');
            $day = Carbon::now()->subSecond($inactive)->format('d');

            if($now == $day) {
                $user->last_activity = ($lastActivity!=$defaultValue)?date('H:i',$lastActivity):null;
            }
            else{
                $user->last_activity = ($lastActivity!=$defaultValue)?date('H:i d/m/y',$lastActivity):null;
            }

            $user->timeInactive = $inactive;

            return $user;
        });

        $users->each(function ($user) use ($sessionActive){
            $user->allTeams = $user->allTeams()->pluck('name')->join(', ');
            $user->userPrivieles = json_decode($user->privilege()->pluck('privileges')->first()??[]);
            $user->active = in_array($user->id,$sessionActive);
        });

        $users->items();

        $users->paginationVue = $this->preparePaginationVue($users);

        Session::put('usersPerPage',$perPage);
        Session::put('usersPage',$page);
        
        return ['users'=>$users, 'paginationVue'=>$users->paginationVue];
    }
}
