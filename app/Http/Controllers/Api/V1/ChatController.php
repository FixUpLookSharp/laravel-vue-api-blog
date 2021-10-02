<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\PrivateMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function store(User $user)
    {
        $author_id = Auth::guard()->user()->id;
        $recepient_id = $user->id;
        $chat = new Chat();

        if (!Chat::query()
                ->where('subscriber1_id', $author_id)
                ->where('subscriber2_id', $recepient_id)
                ->exists() &&
            !Chat::query()
                ->where('subscriber2_id', $author_id)
                ->where('subscriber1_id', $recepient_id)
                ->exists()) {
            $chat->subscriber1_id = $author_id;
            $chat->subscriber2_id = $recepient_id;
            $chat->save();

            return response()->json($chat->id);
        }

        $newChat = Chat::query()
            ->where('subscriber1_id', $author_id)
            ->where('subscriber2_id', $recepient_id)
            ->orWhere(function ($query) use ($author_id, $recepient_id) {
                $query->where('subscriber1_id', $recepient_id);
                $query->where('subscriber2_id', $author_id);
            })->value('id');

//        return redirect('chat/' . $newChat);

        return response()->json($newChat);


    }

    public function chatDialogs()
    {
        $dialogs = Chat::query()->where('subscriber1_id', Auth::guard()->user()->id)
            ->orWhere('subscriber2_id', Auth::guard()->user()->id)->get();

//        $dialogs = [];
//
//        for ($i = 0; $i < count($dialog); $i++) {
//            if (Message::query()->where('chat_id', $dialog[$i]->id)->exists()) {
//                $dialogs[] = $dialog[$i];
//            }
//        }

        $newDialogs = [];


        for($i = 0; $i < count($dialogs); $i++) {
            if (Auth::user()->id == $dialogs[$i]->subscriber1->id) {
                $newDialogs[$i] = [
                    'id' => $dialogs[$i]->id,
                    'auth' => Auth::user()->id,
                    'url' =>  '/api/V1/chat/' . $dialogs[$i]->id,
                    'subscriberPhoto' => $dialogs[$i]->subscriber2->photo,
                    'subscriberId' => $dialogs[$i]->subscriber2->id,
                    'subscriberIsOnline' => $dialogs[$i]->subscriber2->isOnline(),
                    'subscriberName' => $dialogs[$i]->subscriber2->name,
                    'subscriberNickname' => $dialogs[$i]->subscriber2->nickname, //не работает
                ];

            } elseif (Auth::user()->id == $dialogs[$i]->subscriber2->id) {
                $newDialogs[$i] = [
                    'id' => $dialogs[$i]->id,
                    'auth' => Auth::user()->id,
                    'url' =>  '/api/V1/chat/' . $dialogs[$i]->id,
                    'subscriberPhoto' => $dialogs[$i]->subscriber1->photo,
                    'subscriberId' => $dialogs[$i]->subscriber1->id,
                    'subscriberIsOnline' => $dialogs[$i]->subscriber1->isOnline(),
                    'subscriberName' => $dialogs[$i]->subscriber1->name,
                    'subscriberNickname' => $dialogs[$i]->subscriber1->nickname,
                ];
            }
        }

        return response()->json($newDialogs);
//        return view('chat.testChat', compact('newDialogs'));
    }


    public function showMessage($id)
    {
        $chat = Chat::query()->where('id', $id)->first();

        if (!$chat) {
            return response()->json(['dialogs' => false]);
        }

        if (Gate::denies('chat', $chat)) {
            return response()->json(['dialogs' => false]);
        }


        $messageAll = [];
        foreach ($chat->messages as $item) {
            $messageAll[] = [
                'itemRecepientId' => $item->recepient->id,
                'itemAuthorPhoto' => $item->author->photo,
                'itemMessage' => $item->message,
                'itemCreatedAtFormat' => $item->created_at->format('H:i'),
            ];


        }

        if (Auth::user()->id == $chat->subscriber1->id) {
            $arr = [
                'authUser' => Auth::user()->id,
                'chatId' => $chat->id,
                'chatSubscriberId' => $chat->subscriber2->id,
                'chatSubscriberPhoto' => $chat->subscriber2->photo,
                'chatSubscriberIsOnline' => $chat->subscriber2->isOnline(),
                'chatSubscriberName'=> $chat->subscriber2->name,
                'chatSubscriberCountMessage'=> $chat->subscriber1->count_message($chat->id),
                'chatWasOnline' => $chat->wasOnline($chat),
//                'routeSubscriber' => route('chat.create',  $chat->subscriber2_id),
//                'routeAccountShow' => route('account.show', $chat->subscriber2_id),
            ];

        } elseif (Auth::user()->id == $chat->subscriber2->id) {
            $arr = [
                'authUser' => Auth::user()->id,
                'chatId' => $chat->id,
                'chatSubscriberId' => $chat->subscriber1->id,
                'chatSubscriberPhoto' => $chat->subscriber1->photo,
                'chatSubscriberIsOnline' => $chat->subscriber1->isOnline(),
                'chatSubscriberName' => $chat->subscriber1->name,
                'chatSubscriberCountMessage'=> $chat->subscriber2->count_message($chat->id),
                'chatWasOnline' => $chat->wasOnline($chat),
//                'routeSubscriber' => route('chat.create',  $chat->subscriber1_id),
//                'routeAccountShow' => route('account.show', $chat->subscriber1_id),
            ];
        }


        return ['chat' => $arr, 'messageAll' => $messageAll ];
    }

    public function create(MessageRequest $request, User $user)
    {
        $author_id = Auth::user()->id;
        $recepient_id = $user->id;
        $messages = $request->input('message');
        $chat_id = $request->input('chatId');
        $channel = $request->input('channel');

        $message = new Message();

        $message->author_id = $author_id;
        $message->recepient_id = $recepient_id;
        $message->chat_id = $chat_id;
        $message->message = $messages;
        $message->save();

        $req = [
            'authUserId' => $author_id,
            'itemAuthorPhoto' => $message->author->photo,
            'itemCreatedAtFormat' => $message->created_at->format('H:i'),
            "itemMessage" => $message->message,
            'itemRecepientId' => $message->recepient_id,
            "channels" => [
                0 => $channel
            ],
        ];

        PrivateMessage::dispatch($req);

        return  response()->json($req);
    }

    public function search(SearchRequest $request)
    {
        $saerchName = $request->input('search');

        $newDialogs = [];


        $users = User::query()
            ->where('name', 'like', $saerchName . '%')
            ->where('id', '!=', Auth::user()->id)
            ->get();



        for($i = 0; $i < count($users); $i++) {
            $newDialogs[$i] = [
                'authId' => Auth::user()->id,
                'subscriberPhoto' => $users[$i]->photo,
                'subscriberId' => $users[$i]->id,
                'subscriberIsOnline' => $users[$i]->isOnline(),
                'subscriberName' => $users[$i]->name,
            ];
        }

        return response()->json($newDialogs);
    }

//    public function storeSearch(User $user)
//    {
//        $author_id = Auth::user()->id;
//        $recepient_id = $user->id;
//        $chat = new Chat();
//
//        if (!Chat::query()
//                ->where('subscriber1_id', $author_id)
//                ->where('subscriber2_id', $recepient_id)
//                ->exists() &&
//            !Chat::query()
//                ->where('subscriber2_id', $author_id)
//                ->where('subscriber1_id', $recepient_id)
//                ->exists()) {
//            $chat->subscriber1_id = $author_id;
//            $chat->subscriber2_id = $recepient_id;
//            $chat->save();
//
//            return response()->json($chat->id);
//        }
//
//        $newChat = Chat::query()
//            ->where('subscriber1_id', $author_id)
//            ->where('subscriber2_id', $recepient_id)
//            ->orWhere(function ($query) use ($author_id, $recepient_id) {
//                $query->where('subscriber1_id', $recepient_id);
//                $query->where('subscriber2_id', $author_id);
//            })->value('id');
//
//        return  response()->json($newChat);
//
//    }
}
