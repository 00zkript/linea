<?php


namespace App\Http\Traits;


trait SocialTrait
{

    /**
     * @param $url
     * @return string
     */
    public static function facebook($url): string
    {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
    }

    /**
     * @param null $title
     * @param null $url
     * @return string
     */
    public static function twitter($title = null, $url = null): string
    {
        return 'https://twitter.com/intent/tweet?text=' . $title . ';url=' . $url . ' ';
    }


    /**
     * @param $number
     * @param $message
     * @return string
     */
    public static function whatsapp($number, $message): string
    {
        $number  = str_replace(" ", "", $number);
        $number  = str_replace("+", "", $number);

        $message = str_replace(" ", "%20", $message);
        $message = str_replace("<br>", "%0A", $message);
        $message = str_replace("<b>", "*", $message);
        $message = str_replace("</b>", "*", $message);
        $message = str_replace("<i>", "_", $message);
        $message = str_replace("</i>", "_", $message);

        return 'https://api.whatsapp.com/send?phone=' . $number . '&text=' . $message . '';
    }

}
