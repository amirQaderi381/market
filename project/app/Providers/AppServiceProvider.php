<?php

namespace App\Providers;

use App\Models\User\Role;
use App\Models\Notification;
use App\Models\Market\Comment;
use App\Models\Market\CartItem;
use App\Models\User\Permission;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // auth()->loginUsingId(19);

        // dd(auth()->user()->roles);
        // dd(auth()->user()->permissions);
        // $role = Role::find(1);
        // $permission = Permission::find(2);
        // dd($role->permissions);
        //  dd($role->users);
        // dd($permission->roles);
        // dd($permission->users);

       view()->composer('admin.layouts.header', function ($view) {
           $view->with('unseenComments',Comment::where('seen',0)->get());
           $view->with('notifications', Notification::where('read_at', null)->get());
       });

       view()->composer('customer.layouts.header',function($view)
       {
           if(Auth::check())
           {
              $view->with('cartItems',CartItem::where('user_id',Auth::user()->id)->get());
           }
       });
    }
}
