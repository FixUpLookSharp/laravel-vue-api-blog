<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class Chat extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(__NAMESPACE__ . '\Message', 'chat_id');
    }

    public function subscriber1()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'subscriber1_id');
    }

    public function subscriber2()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'subscriber2_id');
    }

    public function wasOnline(Chat $chat)
    {

        //сделать чтоб выдавал правильное время глаголы
        $toDay = Carbon::now()->format('d.m.Y H:i'); // текущая дата
        if(Auth::user()->id == $chat->subscriber1->id){
            $userDat = $chat->subscriber2->is_online->format('d.m.Y H:i'); // дата когда пользователь был в сети
        }else{
            $userDat = $chat->subscriber1->is_online->format('d.m.Y H:i'); // дата когда пользователь был в сети
        }
        $user_date_unix = strtotime($userDat);
        $to_date_unix = strtotime($toDay);
        $resMinute = ($to_date_unix-$user_date_unix) / (60);
        $resHours = ($to_date_unix-$user_date_unix) / (60 * 60);
        $resDay = ($to_date_unix-$user_date_unix) / (60 * 60 * 24);

        if ($resMinute < 60) {
            $wasOnline = floor($resMinute) . ' мин. назад';
        }elseif ($resHours < 25 && $resMinute >= 61) {
            $wasOnline = floor($resHours) . ' ч. назад';
        } elseif($resDay < 32 && $resHours >=25) {
            $wasOnline = floor($resDay) . ' д. назад';
        } else {
            $wasOnline = $userDat;
        }

        return 'Был(а) в сети ' . $wasOnline;
    }
}
