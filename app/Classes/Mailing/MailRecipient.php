<?php

namespace App\Classes\Mailing;

use App\LoginSource;
use App\User;
use Illuminate\Support\Facades\DB;


class MailRecipient
{
    public static function getCatACount()
    {
        $prevMonthTms = new \DateTime();
        $prevMonthTms->modify('-1 month');
        $prevMonthTmsFormatted = $prevMonthTms->format('Y-m-d H:i:s');

        $users = User::where('user_role_id', 3)->get();

        foreach ($users as $key => $item)
        {
            $login_sources = LoginSource::where('user_id', $item->id)
                ->where('tms', '>', $prevMonthTmsFormatted)
                ->get();

            if (count($login_sources) > 0)
            {
                unset($users[$key]);
            }
        }

         return count($users);
    }

    public static function getCatBCount()
    {
        $prevMonthTms = new \DateTime();
        $prevMonthTms->modify('-1 month');
        $prevMonthTmsFormatted = $prevMonthTms->format('Y-m-d H:i:s');

        $users = User::where('user_role_id', 3)->get();

        foreach ($users as $key => $item)
        {
            $login_sources = LoginSource::where('user_id', $item->id)
                ->where('tms', '>', $prevMonthTmsFormatted)
                ->get();

            if (count($login_sources) != 2)
            {
                unset($users[$key]);
            }
        }

        return count($users);
    }

    public static function getCatCCount(int $without_action_id)
    {



        return -1;
    }
}
