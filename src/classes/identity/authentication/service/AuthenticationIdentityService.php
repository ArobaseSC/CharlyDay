<?php


namespace Application\identity\authentication\service;

use Application\datalayer\factory\ConnectionFactory;
use Application\exception\datalayer\DatabaseConnectionException;
use Application\exception\identity\AuthenticationException;
use Application\exception\identity\BadPasswordException;
use PDO;
use PDOException;
use User;


class AuthenticationIdentityService
{

    private const AUTHENTICATION_FAIL_ERROR_MESSAGE = 'Authentication failed';

    /**
     * @throws AuthenticationException
     * @throws DatabaseConnectionException
     * @throws BadPasswordException
     */
    public static function authenticate(string $email, string $password)
    {

        $user = \Application\models\User::where("email", "=", $email)->first();
        if ($user === null) {
            throw new AuthenticationException("erreur d'auth");
        }
        $hash = $user->mdp;


        // si ce n'est pas le bon password
        if (!password_verify($password, $hash)) {
            throw new BadPasswordException();
        }

        return new $user;
    }

    /**
     * @throws AuthenticationException
     * @throws DatabaseConnectionException
     */
    public static function register(string $email, string $password, string $confirm): string
    {






        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

        try {
            $db = ConnectionFactory::getConnection();
        } catch (DatabaseConnectionException $e) {
            throw new DatabaseConnectionException(<<<END
                                <div class="flex justify-center items-center flex-col h-screen pb-72">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-10 w-1/2 flex items-center justify-center flex-col">
                                        <h1 class="text-dark text-4xl font-light pb-5 dark:text-white">Erreur de connexion à la base de données</h1>
                                        <a href='index.php?action=sign-up' class="text-gray-900 dark:text-white font-sm text-lg">S'insrire</a>
                                    </div>
                                </div>
                                END);
        }

        try {

            $query = $db->prepare("INSERT INTO profil (nom, prenom, sexe, genrePref) VALUES (:nom, :prenom, :genre, :genrePrefere)");
            $query->execute([
                'nom' => "",
                'prenom' => "",
                'genre' => "",
                'genrePrefere' => ""
            ]);

            $query = $db->prepare('INSERT INTO user (email, passwrd, role, active) VALUES (:email, :passwrd, :role, false)');
            $query->execute([':email' => $email, ':passwrd' => $hash, ':role' => 1]);
            $id = $db->lastInsertId();
            $token = self::generateActivationToken($id);

        } catch (PDOException $e) {
            throw new DatabaseConnectionException(<<<END
                                <div class="flex justify-center items-center flex-col h-screen pb-72">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-10 w-1/2 flex items-center justify-center flex-col">
                                        <h1 class="text-dark text-4xl font-light pb-5 dark:text-white">Erreur d'insertion dans la base de données</h1>
                                        <a href='index.php?action=sign-up' class="text-gray-900 dark:text-white font-sm text-lg">S'insrire</a>
                                    </div>
                                </div>
                                END);
        }

        return $token;
    }


    public static function generateActivationToken(string $id) : string {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 60;
        $db = ConnectionFactory::getConnection();
        $query = $db->prepare('UPDATE user SET activationToken = :token, activationExpiration = :expiration WHERE id = :id');
        $query->execute([':token' => $token, ':expiration' => $expiration, ':id' => $id]);
        return $token;
    }

    /**
     * @throws AuthenticationException
     * @throws DatabaseConnectionException
     */
    public static function alreadyExists(string $email): bool
    {
        $query = "select * from user where email = ?";
        $context = ConnectionFactory::getConnection();

        $statement = $context->prepare($query);

        $statement->execute([$email]);

        if ($result = $statement->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public static function generateRenewToken(string $email) : string
    {
        $db = ConnectionFactory::getConnection();
        $query = $db->prepare('UPDATE user SET renewExpiration = :expiration, renewToken = :token WHERE email = :email');
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 60;
        $query->execute([':expiration' => $expiration, ':token' => $token, ':email' => $email]);

        return $token;
    }
}