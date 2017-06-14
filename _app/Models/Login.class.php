<?php

/**
 * Login.class [ Models ]
 * Efetua login, logoof, verifica sessão e cookies.
 */
class Login {

    private $Level;
    private $User;
    private $Pass;
    private $Result;

    public function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->Level):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function ExeLogin($Data) {
        $this->User = strip_tags(trim($Data['user']));
        $this->User = (Check::Email($this->User)) ? $this->User : null;
        $this->Pass = strip_tags(trim($Data['pass']));
        $this->Pass = md5($this->Pass);
        $this->getUser();
    }

    private function getUser() {
        $read = new Read;
        $read->ExeRead('agnit_users', null, 'WHERE user_email = :user', "user={$this->User}");
        if (!$read->getResultado()):
            $status = "Negado";
            $this->geraLog($status);
            $this->Result = null;
        else:
            $this->Result = $read->getResultado()[0];
            $read->ExeRead('agnit_users', null, 'WHERE user_email = :user AND user_pass = :senha', "user={$this->User}&senha={$this->Pass}");
            if (!$read->getResultado()):
                $status = "Negado";
                $this->geraLog($status, $this->Result['users_id']);
                $this->Result = null;
            else:
                if($this->Result['user_level'] < $this->Level ):
                    $status = "Sem permissão";
                    $this->geraLog($status, $this->Result['users_id']);
                    $this->Result = 'restrito';
                else:
                    $this->Result = $read->getResultado()[0];
                    $status = "Permito";
                    $this->geraLog($status, $this->Result['users_id']);
                    $this->Execute();
                endif;
            endif;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;
        $_SESSION['userlogin'] = $this->Result;
        $this->Result = 'true';
    }

    private function geraLog($status, $idUser = null) {
        $dados['user_id'] = ($idUser ? $idUser : null);
        $dados['user_email'] = $this->User;
        $dados['user_pass'] = $this->Pass;
        $dados['users_log_status'] = $status;

        $create = new Create;
        $create->ExeCreate('agnit_users_log', $dados);
    }

}
