<?php

/**
 * Upload.class [ HELPERS ]
 * Responsável por executar o upload de imagens, arquivos e midias no sistema.
 */
class Upload {

    private $File;
    private $Name;
    private $Send;

    /** IMAGE UPLOAD */
    private $Width;
    private $Image;

    /** RESULT SET */
    private $Result;
    private $Error;

    /** DIRETÓRIOS */
    private $Folder;
    private static $BaseDir;

    /** Informe qual será a pasta base onde sera feita o upload da imagem.
     * Caso nenhum seja informado o upload será feito na pasta [uploads]
     * no diretório raiz do projeto. */
    public function __construct($BaseDir = null) {
        self::$BaseDir = ((string) $BaseDir ? $BaseDir . "/" : '../uploads/');
        if (!file_exists(self::$BaseDir) && !is_dir(self::$BaseDir)):
            mkdir(self::$BaseDir, 0777);
        endif;
    }

    /** Faz uploads de imagens para o servidor.
     * 
     * @param array $Image = Array com a imagem vindo de algum formulário
     * @param type $Name = Usado para renomear o arquivo enviado
     * @param type $Width = Usado para redimensionar o arquivo enviado, o padrão é 1024;
     * @param type $Folder = Pasta para qual o arquivo será enviado, o padrão é images./
     */
    public function Image(array $Image, $Name = null, $Width = null, $Folder = null) {
        $this->File = $Image;
        $this->Name = ((string) $Name ? $Name : substr($Image['name'], 0, strrpos($Image['name'], '.')));
        $this->Width = ((int) $Width ? $Width : 1024);
        $this->Folder = ((string) $Folder ? $Folder : 'images');
        $this->CheckFolder($this->Folder);
        $this->setFileName();
        $this->PreUploadImage();
    }

    public function Files(array $File, $Name = null, $Folder = null, $MaxSizeFile = null) {
        $this->File = $File;
        $this->Name = ((string) $Name ? $Name : substr($File['name'], 0, strrpos($File['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'files');
        $MaxSizeFile = ((int) $MaxSizeFile ? $MaxSizeFile : 2);
        $FileAccept = [
            '.doc' => "application/msword",
            '.docx' => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            '.pdf' => "application/pdf"
        ];

        if ($this->File['size'] > ($MaxSizeFile * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Erro. Tamanho máximo permitido é de: {$MaxSizeFile} MB";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = "Erro. O tipo de arquivo não é válido. [" . implode(', ', array_keys($FileAccept)) . "]";
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    public function Media(array $Media, $Name = null, $Folder = null, $MaxSizeFile = null) {
        $this->File = $Media;
        $this->Name = ((string) $Name ? $Name : substr($Media['name'], 0, strrpos($Media['name'], '.')));
        $this->Folder = ((string) $Folder ? $Folder : 'medias');
        $MaxSizeFile = ((int) $MaxSizeFile ? $MaxSizeFile : 40);
        $FileAccept = [
            '.MP3' => 'audio/mp3',
            '.MP4' => 'video/mp4',
            '.AVI' => 'video/avi'
        ];
        if ($this->File['size'] > ($MaxSizeFile * (1024 * 1024))):
            $this->Result = false;
            $this->Error = "Erro. Tamanho máximo permitido é de: {$MaxSizeFile} MB";
        elseif (!in_array($this->File['type'], $FileAccept)):
            $this->Result = false;
            $this->Error = "Erro. O tipo de arquivo não é válido. [" . implode(', ', array_keys($FileAccept)) . "]";
        else:
            $this->CheckFolder($this->Folder);
            $this->setFileName();
            $this->MoveFile();
        endif;
    }

    /** Retorna o resultado do upload. Caso falhe, o valor é null.
     * Se não, retorna o caminho completo onde a imagem foi salva. */
    public function getResult() {
        return $this->Result;
    }

    /** Retorna uma mensagem de erro caso o upload falhe. */
    public function getError() {
        return $this->Error;
    }

    /**     * ***************************************
     *  ***************PRIVATES*****************
     *  ****************************************
     */
    private function CheckFolder($Folder) {
        list($y, $m) = explode('/', date('Y/m'));
        $this->CreateFolder("{$Folder}");
        $this->CreateFolder("{$Folder}/{$y}");
        $this->CreateFolder("{$Folder}/{$y}/{$m}/");
        $this->Send = "{$Folder}/{$y}/{$m}/";
    }

    private function CreateFolder($Folder) {
        if (!file_exists(self::$BaseDir . $Folder) && !is_dir(self::$BaseDir . $Folder)):
            mkdir(self::$BaseDir . $Folder, 0777);
        endif;
    }

    private function setFileName() {
        $FileName = Check::UrlAmigavel($this->Name) . strrchr($this->File['name'], '.');
        if (file_exists(self::$BaseDir . $this->Send . $FileName)):
            $FileName = Check::UrlAmigavel($this->Name) . "-" . time() . strrchr($this->File['name'], '.');
        endif;
        $this->Name = $FileName;
    }

    private function PreUploadImage() {
        switch ($this->File['type']):
            case "image/jpg":
            case "image/jpeg":
            case "image/pjpeg":
                $this->Image = imagecreatefromjpeg($this->File['tmp_name']);
                break;
            case "image/png";
            case "image/x-png";
                $this->Image = imagecreatefrompng($this->File['tmp_name']);
                break;
        endswitch;
        $this->CreateImage();
    }

    private function CreateImage() {
        if (!$this->setResult($this->Image)):

        else:
            $x = imagesx($this->Image);
            $y = imagesy($this->Image);
            $ImageX = ($this->Width < $x ? $this->Width : $x);
            $ImageH = ($ImageX * $y) / $x;
            $NewImage = imagecreatetruecolor($ImageX, $ImageH);
            imagealphablending($NewImage, false);
            imagesavealpha($NewImage, true);
            imagecopyresampled($NewImage, $this->Image, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);
            $this->CopyImage($NewImage);
        endif;
    }

    private function CopyImage($NewImage) {
        switch ($this->File['type']):
            case "image/jpg":
            case "image/jpeg":
            case "image/pjpeg":
                imagejpeg($NewImage, self::$BaseDir . $this->Send . $this->Name);
                break;
            case "image/png";
            case "image/x-png";
                imagepng($NewImage, self::$BaseDir . $this->Send . $this->Name);
                break;
        endswitch;
        $this->setResult($NewImage);
        imagedestroy($this->Image);
        imagedestroy($NewImage);
    }

    private function setResult($Termo) {
        if (!$Termo):
            $this->Result = false;
            $this->Error = "Tipo de arquivo inválido. Envie [.jpg ou .png]";
            return false;
        else:
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
            return true;
        endif;
    }

    /** Faz o upload de arquivos e mídias */
    private function MoveFile() {
        if (move_uploaded_file($this->File['tmp_name'], self::$BaseDir . $this->Send . $this->Name)):
            $this->Result = $this->Send . $this->Name;
            $this->Error = null;
        else:
            $this->Result = false;
            $this->Error = "Não foi possível enviar o arquivo. Por favor, tente novamente.";
        endif;
    }

}
