<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Auth;
use Mail;
use SMS;

class Client extends Model
{
    protected $guarded = ['id', 'public_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

    public function quotes() {
        return $this->hasMany('App\Quote');
    }

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($client) {
             $client->user_activity()->create([
                 'user_id' => $client->user_id,
                 'activity_type' => 'client'
             ]);
        });

        static::created(function($client) {
            $to_notify = User::all()->except($client->user->id);

            foreach ($to_notify as $user) {
                SMS::send($user->phone_number, 'ClientApp: A new client record ('.$client->name.') has been added.');
            }
        });

        // static::created(function($client) {
        //     $users = User::all()->except(Auth::user()->id);
        //
        //     foreach ($users as $user) {
        //         $data = [
        //             'name' => $user->name,
        //             'title' => 'New Client Record',
        //             'description' => 'There\'s a new client on ClientApp',
        //             'client' => $client
        //         ];
        //
        //         Mail::queue('emails.new-client', $data, function ($message) use ($user) {
        //             $message->to($user->email, $user->name);
        //             $message->subject('New Client Record');
        //         });
        //     }
        // });

        static::deleting(function($client) {
             $client->user_activity()->delete();
        });
    }
}
