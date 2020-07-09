<?php

namespace App\Console\Commands;
use App\User;
use App\Notifications\NotifyPaidUsers;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use DB;
use Mail;
use DateTime;
class EMailforUpgradation extends Command
{
    protected $signature = 'email:paidusers';
    protected $description = 'Email Paid users';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {

        $getpackege = DB::table('packeges')->whereRaw('packege_price > 0')->latest()->get();
        
        $getuserdetail =User::join('packege_paymets','users.id','=','packege_paymets.user_id')->where( 'expires_on', '=', date('Y-m-d', strtotime("3 days")))
           ->get();
       
        $getuserAfterExpiry=User::join('packege_paymets','users.id','=','packege_paymets.user_id')->where( 'expires_on', '=', date('Y-m-d', strtotime("-5 days")))
           ->get();
        $suspenduser=User::join('packege_paymets','users.id','=','packege_paymets.user_id')->where( 'expires_on', '=', date('Y-m-d', strtotime("-7 days")))
           ->get();
        foreach ($suspenduser as $suspended) {
            $actSuspend = User::find($suspended->user_id);
             $actSuspend->is_active = 0;
             $actSuspend->update();
             Mail::send(array(),array(),function($message) use($actSuspend) {
                $message->to($actSuspend->email, "Test")
                ->from('gulraizazam0@gmail.com')
                ->subject("Account Suspended");
                
            });
        }
        foreach ( $getpackege as $key ) {
            $pageurl = 'http://beatbyte.co/upgradepkg/'.$key->id;
        }
         
        foreach ($getuserdetail as $user) {
            $gettoken = DB::table('verify_users')->select('token')->where('user_id',$user->id)->first();

            $getuserdata = ['key'=>$user->expires_on];
            Mail::send('frontend.beforeexpiryemail',['pagelink'=>'http://beatbyte.co/upgradepkg/', 'unique'=>$user->expires_on,'token'=>$gettoken->token],function($message) use($user,$pageurl) {
                $message->to($user->email, "Test")
                ->from('gulraizazam0@gmail.com')
                ->subject("Upgrade Account");
                
            });
        }
        foreach ($getuserAfterExpiry as $user) {
            $gettoken = DB::table('verify_users')->select('token')->where('user_id',$user->id)->first();
            
            $getuserdata = ['key'=>$user->expires_on];
            Mail::send('frontend.afterexpiryemail',['pagelink'=>'http://beatbyte.co/upgradepkg/', 'unique'=>$user->expires_on,'token'=>$gettoken->token],function($message) use($user,$pageurl) {
                $message->to($user->email, "Test")
                ->from('gulraizazam0@gmail.com')
                ->subject("Upgrade Account");
                
            });
        }
    }
}
