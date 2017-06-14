<?php

/**
 * Check.class [ HELPERS ]
 * Classe responsável por manipular e validar dados no sistema.
 */
class Check {

    private static $Dado;
    private static $Formato;

    public static function Email($Email) {
        self::$Dado = (string) strtolower(trim($Email));
        self::$Formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        return preg_match(self::$Formato, self::$Dado) ? true : false;
    }

    public static function UrlAmigavel($URL) {
        self::$Formato = [];
        self::$Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        self::$Dado = strtr(utf8_decode($URL), utf8_decode(self::$Formato['a']), self::$Formato['b']);
        self::$Dado = strtolower(strip_tags(trim(self::$Dado)));
        self::$Dado = preg_replace('/(\s){1,}/', '-', self::$Dado);
        return utf8_encode(self::$Dado);
    }

    public static function GuardaData($Data) {
        self::$Formato = explode(' ', $Data);
        self::$Dado = explode('/', self::$Formato[0]);
        if (empty(self::$Formato[1])):
            self::$Formato[1] = date('H:i:s');
        endif;
        self::$Dado = self::$Dado[2] . '-' . self::$Dado[1] . '-' . self::$Dado[0];
        self::$Dado .= ' ' . self::$Formato[1];
        return self::$Dado;
    }

    public static function PegaData($Data) {
        self::$Formato = explode(' ', $Data);
        self::$Dado = explode('-', self::$Formato[0]);
        self::$Dado = self::$Dado[2] . "/" . self::$Dado[1] . "/" . self::$Dado[0];
        self::$Dado .= " " . self::$Formato[1];
        return self::$Dado;
    }

    public static function Words($String, $Limite, $Pointer = null) {
        self::$Dado = (string) strip_tags(trim($String));
        self::$Formato = (int) $Limite;
        $ArrWords = explode(" ", self::$Dado);
        if (count($ArrWords) > $Limite):
            self::$Dado = (!empty($Pointer)) ? implode(" ", array_slice($ArrWords, 0, self::$Formato)) . " " . $Pointer : implode(" ", array_slice($ArrWords, 0, self::$Formato)) . " ...";
            return self::$Dado;
        else:
            return self::$Dado;
        endif;
    }

    public static function CatByName($CategoriaNome) {
        $read = new Read;
        $read->ExeRead('ws_categories', null, 'WHERE category_name = :categoryName', "categoryName={$CategoriaNome}");
        if ($read->getRowCount()):
            return $read->getResultado()[0]['category_id'];
        else:
            echo "Categoria " . strtoupper($CategoriaNome) . " não localizada!";
            die;
        endif;
    }

    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('ws_siteviews_online', 'WHERE online_endview < :now', "now={$now}");
        $read = new Read;
        $read->ExeRead('ws_siteviews_online');
        return $read->getRowCount();
    }

    public static function Image($ImageURL, $ImageDesc, $ImageW = null, $ImageH = null) {
        self::$Dado = "uploads/" . $ImageURL;
        $patch = HOME;
        if (file_exists(self::$Dado) && !is_dir(self::$Dado)):
            $imagem = self::$Dado;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" />";
        else:
            return "<img src=\"{$patch}/tim.php?src={$patch}/uploads/noFace.jpg&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" />";
        endif;
    }

}
