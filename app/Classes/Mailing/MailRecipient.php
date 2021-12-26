<?php

namespace App\Classes\Mailing;

use App\Action;
use App\LoginSource;
use App\User;
use Illuminate\Support\Facades\DB;


class MailRecipient
{
    public static function getCatA()
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

        return $users;
    }

    public static function getCatB()
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

        return $users;
    }

    public static function getCatC(int $without_action_id)
    {
        $prevMonthTms = new \DateTime();
        $prevMonthTms->modify('-1 month');
        $prevMonthTmsFormatted = $prevMonthTms->format('Y-m-d H:i:s');

        $users = User::where('user_role_id', 3)->get();

        // Акция, во время которой пользователей не было в сети
        $withoutAction = Action::find($without_action_id);

        foreach ($users as $key => $item)
        {
            // Авторизации за последние 30 дней
            $login_sources = LoginSource::where('user_id', $item->id)
                ->where('tms', '>', $prevMonthTmsFormatted)
                ->get();

            // Авторизации во время исключаемой акции
            $ls_without_actoin = LoginSource::where('user_id', $item->id)
                // Авторизация после начала исключаемой акции
                ->where('tms', '>', $withoutAction->date_start)
                // Авторизация до завершения исключаемой акции
                ->where('tms', '<', $withoutAction->date_end)
                ->get();

            if (count($login_sources) == 1 && count($ls_without_actoin) == 0)
            {
                continue;
            }
            else
            {
                unset($users[$key]);
            }
        }

        return $users;
    }

    public static function getCatACount()
    {
         return count(self::getCatA());
    }

    public static function getCatBCount()
    {
        return count(self::getCatB());
    }

    public static function getCatCCount(int $without_action_id)
    {
        return count(self::getCatC($without_action_id));
    }
}
