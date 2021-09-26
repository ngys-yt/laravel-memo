<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function getMyMemo(){
        $query_tag = \Request::query('tag');
        // ==== ベースのメソッド ====
        $query = Memo::query()->select('memos.*')
                //ログインしているユーザーによって表示する画面を変える
                ->where('user_id', '=', \Auth::id())
                ->whereNull('deleted_at')
                ->orderBy('updated_at', 'DESC');// ASC=小さい順 DESC=大きい順
        // ==== ベースのメソッドここまで ====
        
        // もしクエリパラメータtagがあればタグで絞り込み
        if(!empty($query_tag)){
            $query  ->leftJoin('memo_tags', 'memo_tags.memo_id', '=', 'memos.id')
                    ->where('memo_tags.tag_id', '=', $query_tag);
        }

        $memos = $query->get();
            
        return $memos;
    }
}
