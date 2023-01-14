<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\App\AppAddress;
use Source\Models\App\AppConfig;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\Models
 */
class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["id"], ["email", "password"]);
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    /**
     * @param User $user
     * @param boolean $resendCode
     * @return boolean
     */
    public function register(User $user, bool $resendCode = false): bool
    {
        if (!$resendCode) {
            if (!$user->save()) {
                $this->message = $user->message;
                return false;
            }

            //Initial Address
            $address = (new AppAddress());
            $address->user_id = $user->id;
            $address->save();

            //Activation Code
            if (!$user->code) {
                $user->code = rand(1111, 9999);
                $user->save();
            }
        }

        $view = new View(__DIR__ . "/../../shared/views/email");
        $message = $view->render("confirm", [
            "first_name" => $user->first_name,
            "code" => $user->code,
            "confirm_link" => url("/confirma/{$user->email}")
        ]);

        (new Email())->bootstrap(
            "Activate your account on " . CONF_SITE_NAME,
            $message,
            $user->email,
            "{$user->first_name} {$user->last_name}"
        )->send();

        return true;
    }

    /**
     * @param string $email
     * @param string $password
     * @param int $level
     * @return User|null
     */
    public function attempt(string $email, string $password, int $level = 1): ?User
    {
        if (!is_email($email)) {
            $this->message->warning("The email entered is not valid.");
            return null;
        }

        if (!is_passwd($password)) {
            $this->message->warning("The password entered is not valid.");
            return null;
        }

        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->message->error("The given email is not registered.");
            return null;
        }

        if (!passwd_verify($password, $user->password)) {
            $this->message->error("The entered password does not match.");
            return null;
        }

        if ($user->level < $level) {
            $this->message->error("Sorry, but you don't have permission to login here.");
            return null;
        }

        if (passwd_rehash($user->password)) {
            $user->password = $password;
            $user->save();
        }

        return $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @param int $level
     * @return bool
     */
    public function login(string $email, string $password, bool $save = false, int $level = 1): bool
    {
        $user = $this->attempt($email, $password, $level);
        if (!$user) {
            return false;
        }

        if ($save) {
            setcookie("authEmail", $email, time() + 604800, "/");
        } else {
            setcookie("authEmail", false, time() - 3600, "/");
        }

        //LOGIN
        (new Session())->set("authUser", $user->id);
        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function forget(string $email): bool
    {
        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->message->warning("The email provided is not registered.");
            return false;
        }

        $user->code = md5(uniqid(rand(), true));
        $user->save();

        $view = new View(__DIR__ . "/../../shared/views/email");
        $message = $view->render("forget", [
            "first_name" => $user->first_name,
            "forget_link" => url("/recuperar/{$user->email}/{$user->code}")
        ]);

        (new Email())->bootstrap(
            "Retrieve your password on " . CONF_SITE_NAME,
            $message,
            $user->email,
            "{$user->first_name} {$user->last_name}"
        )->send();

        return true;
    }

    /**
     * @param string $email
     * @param string $code
     * @param string $password
     * @param string $passwordRe
     * @return bool
     */
    public function reset(string $email, string $code, string $password, string $passwordRe): bool
    {
        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->message->warning("Recovery account not found.");
            return false;
        }

        if ($user->code != $code) {
            $this->message->error("Sorry, but the verification code is not valid.");
            return false;
        }

        if (!is_passwd($password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->info("Your password must be between {$min} and {$max} characters.");
            return false;
        }

        if ($password != $passwordRe) {
            $this->message->warning("You entered two different passwords.");
            return false;
        }

        $user->password = $password;
        $user->code = null;
        $user->save();
        return true;
    }
}
