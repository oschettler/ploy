<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public static function say($update_id, $message)
    {
        $log = new self;
        $log->update_id = $update_id;
        $log->message = $message;
        $log->save();
    }
}