<?php

namespace App\Classes\Mailing;

class MailBuilder
{
    public static function buildMailText(
        string $templateBody,
        string $firstName = '',
        string $secondName = '',
        string $title = '',
        string $description = '',
        string $dateStart = '',
        string $dateEnd = ''
    )
    {
        $result = $templateBody;
        $result = str_replace('%first_name%', $firstName, $result);
        $result = str_replace('%second_name%', $secondName, $result);
        $result = str_replace('%title%', $title, $result);
        $result = str_replace('%description%', $description, $result);
        $result = str_replace('%$date_start%', $dateStart, $result);
        $result = str_replace('%date_end%', $dateEnd, $result);

        return $result;
    }
}
