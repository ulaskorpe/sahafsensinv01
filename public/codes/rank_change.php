<?php


if($oldLang==$request['lang']){

    if($oldOrder != $request['order']){
        if($request['order']>$oldOrder){
            WorldData::where('id', '!=', $wd['id'])
                ->where('lang', '=', $wd['lang'])
                ->where('order','>',$oldOrder)
                ->where('order','<=',$request['order'])->decrement('order',1);
        }else{
            WorldData::where('order','<',$oldOrder)
                ->where('order','>=',$request['order'])
                ->where('id', '!=', $wd['id'])
                ->where('lang', '=', $wd['lang'])
                ->increment('order',1);
        }
    }///order changed

    }else{ // lang has changed
        ////old lang
        WorldData::where('order', '>=', $oldOrder)
            ->where('id', '!=', $wd['id'])
            ->where('lang', '=', $oldLang)
            ->decrement('order', 1);
        //// new lang
        WorldData::where('order', '>=', $request['order'])
            ->where('id', '!=', $wd['id'])
            ->where('lang', '=', $request['lang'])
            ->increment('order', 1);


    }
