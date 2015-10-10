<?php
use SunHelperClass\config;

class OrderMail {

    public static function DeadLineFinished()
    {
        date_default_timezone_set(config::$timezone);
        $today = date("Y-m-d");

        $orders = Order::where('to','<',$today)
            ->where('status','=',1)
            ->orderBy('id','desc')->get();


        $info = array();
        $x = 0;
        foreach($orders as $order){
            $single = array();

            $single['email'] =  User::where('details_id','=',$order->member->id)
                    ->where('user_level','=','member')
                    ->get()->first()->email;

            $single['movie name'] = Movie::where("id",'=',$order->movie_id)
                    ->get()->first()->name;

            $single['first name'] = Member::where("id",'=',$order->member_id)
                            ->get()->first()->first_name;

            $single['last name'] = Member::where("id",'=',$order->member_id)
                            ->get()->first()->last_name;

            $info[$x++] = $single;

        }

        foreach($info as $member){
            Mail::send('emails.deadlinefinishedorder',
                array(
                    'first_name'    => $member['first name'],
                    'last_name' 	=> $member['last name'],
                    'movie' 		=> $member['movie name']
                ), function($message) use($member){
                    $message->to($member['email'],$member['first name'])->subject('DVD Rental Notification');
                }
            );
        }

        return "Email has been successfully sent.";
    }

} 