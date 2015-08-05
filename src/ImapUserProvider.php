<?php 

namespace peckrob\Laravel5ImapAuthentication;

use Illuminate\Auth\GenericUser;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\Exception\AuthenticationFailedException;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class ImapUserProvider implements UserProvider {

    protected $model;
    private $config;

    public function __construct($model, $config)
    {
        $this->model = $model;
        $this->config = $config;
    }

    public function retrieveById($identifier)
    {
        return new $this->model([
            "id" => $identifier,
            "email" => $identifier
        ]);
    }

    public function retrieveByToken($user, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {       
        if ($credentials !== null) {
            return new $this->model([
                "id" => $credentials["email"],
                "email" => $credentials["email"]
            ]);
        }
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $server = new Server($this->config["server"]);

        try {
            $connection = $server->authenticate($credentials["email"], $credentials["password"]);
        } catch (AuthenticationFailedException $e) {
            return false;
        }
        
        return true;
    }

}