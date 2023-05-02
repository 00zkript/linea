<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Storage;

Trait CopyFileFromAnotherServer
{


    /**
     * Método de copia usando el facade Storage
     * @param string $url Url del archivo a copiar
     * @param string $dir Carpeta destino
     * @param string $disk Disco a usar para el archivo
     * @param string $fileName Nombre de archivo
     * @return string Nombre del archivo ingresado
     */
    public function methodStorage(string $url, string $dir, $disk = 'public', $fileName = ''): string
    {
        if (empty($url)){
            return false;
        }

        $fileName = !empty($fileName) ? $fileName : basename($url);

        try {
            $contents = file_get_contents($url);
            Storage::disk($disk)->put("$dir/$fileName",$contents);

            return true;
        }catch (\Throwable $th){
            return false;
        }

    }

    /**
     * Método de copia usando la función copy()
     * @param string $url Url del archivo a copiar
     * @param string $path Carpeta destino
     * @param string $fileName Nombre de archivo
     * @return string Nombre del archivo ingresado
     */
    public function methodCopy(string $url, string $path, $fileName = ''): string
    {
        if (empty($url)){
            return false;
        }

        $fileName = !empty($fileName) ? $fileName : basename($url);

        try {
            if (!file_exists(public_path($path))){
                mkdir($path);
            }

            return copy(
                $url,
                public_path("$path/$fileName")
            );

        }catch (\Throwable $th){
            return false;
        }

    }

    /**
     * Método de copia usando la función fopen()
     * @param string $url Url del archivo a copiar
     * @param string $path Carpeta destino
     * @param string $fileName Nombre de archivo
     * @return string Nombre del archivo ingresado
     */
    public function methodFopen(string $url, string $path, $fileName = ''): string
    {
        if (empty($url)){
            return false;
        }

        $fileName = !empty($fileName) ? $fileName : basename($url);

        try {

            if (!file_exists(public_path($path))){
                mkdir($path);
            }


            $fileInitial = fopen($url, "r");

            $fileFinal   = fopen(
                public_path("$path/$fileName"),
                "w"
            );

            while(!feof($fileInitial))
                fwrite($fileFinal, fread($fileInitial, 1), 1);

            fclose($fileFinal);
            fclose($fileInitial);


            return true;
        }catch (\Throwable $th){
            return false;
        }


    }

    /**
     * Método de copia usando la función file_get_content()
     * @param string $url Url del archivo a copiar
     * @param string $path Carpeta destino
     * @param string $fileName Nombre de archivo
     * @return string Nombre del archivo ingresado
     */
    public function methodFileGetContent(string $url, string $path, $fileName = ''): string
    {
        if (empty($url)){
            return false;
        }

        $fileName = !empty($fileName) ? $fileName : basename($url);

        try {
            if (!file_exists(public_path($path))){
                mkdir($path);
            }


            $contents = file_get_contents($url);

            file_put_contents(
                public_path("$path/$fileName"),
                $contents
            );

            return true;
        }catch (\Throwable $th){
            return false;
        }

    }

    /**
     * Método de copia usando CURL
     * NOTA: no funciona en algunos casos
     * @param string $url Url del archivo a copiar
     * @param string $path Carpeta destino
     * @param string $fileName Nombre de archivo
     * @return string Nombre del archivo ingresado
     */
    public function methodCurl(string $url, string $path, $fileName = ''): string
    {
        if (empty($url)){
            return false;
        }

        $fileName = !empty($fileName) ? $fileName : basename($url);

        try {

            if (!file_exists(public_path($path))){
                mkdir($path);
            }


            $fileFinal = fopen(
                public_path("$path/$fileName"),
                "w"
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
            curl_setopt($ch, CURLOPT_FILE, $fileFinal);

            fclose($fileFinal);
            curl_close($ch);


            return true;
        }catch (\Throwable $th){
            return false;
        }



    }

}
