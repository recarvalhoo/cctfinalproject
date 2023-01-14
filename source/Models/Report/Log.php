<?php


namespace Source\Models\Report;

use Source\Core\Model;
use Source\Core\Session;

/**
 * Class Log
 * @package Source\Models\Report
 */
class Log extends Model
{
    /**
     * Log constructor.
     */
    public function __construct()
    {
        parent::__construct("report_log", ["id"], ["ip", "url", "agent"]);
    }

    /**
     * @return $this
     */
    public function report(): Log
    {
        $session = new Session();

        if ($session->authUser) {
            $lastLog = $this->find("user = :user", "user={$session->authUser}")->order("id DESC")->fetch();
            if ($lastLog->url != (filter_input(INPUT_GET, "route", FILTER_UNSAFE_RAW) ?? "/")) {
                $this->user = $session->authUser;
                $this->url = (filter_input(INPUT_GET, "route", FILTER_UNSAFE_RAW) ?? "/");
                $this->ip = filter_input(INPUT_SERVER, "REMOTE_ADDR");
                $this->agent = filter_input(INPUT_SERVER, "HTTP_USER_AGENT");
                $this->save();
            }
        }

        return $this;
    }
}
