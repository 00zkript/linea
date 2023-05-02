class SocialShare {

    /**
     * @param {string} $url
     * @return string
     */
    static facebook = ($url) => `https://www.facebook.com/sharer/sharer.php?u=` + $url;

    /**
     * @param {string | null} $title
     * @param {string | null} $url
     * @return string
     */
    static twitter = ($title = null, $url = null) => `https://twitter.com/intent/tweet?text=${$title};url=${$url}`;

    /**
     * @param {string} $number
     * @param {string} $message
     * @return string
     */
    static whatsapp = ($number, $message) => {
        $number = $number.replace(/\D/g,'');


        $message = $message.replaceAll(" ", "%20");
        $message = $message.replaceAll("<br>", "%0A");
        $message = $message.replaceAll("<b>", "*");
        $message = $message.replaceAll("</b>", "*");
        $message = $message.replaceAll("<i>", "_");
        $message = $message.replaceAll("</i>", "_");

        return `https://api.whatsapp.com/send?phone=${ $number }&text=${ $message }`;
    };


}

