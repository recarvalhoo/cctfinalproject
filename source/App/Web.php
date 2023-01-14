<?php

namespace Source\App;

use Source\App\Admin\Notifications;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\Booking;
use Source\Models\CategoryJobs;
use Source\Models\Job;
use Source\Models\Notification;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Models\User;
use Source\Support\Email;

/**
 * Web Controller
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");

        (new Access())->report();
        (new Online())->report();
    }

    /**
     * SITE HOME
     * @return void
     */
    public function home(): void
    {

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        //Jobs Init
        $jobs = (new Job())->find();

        //Categories
        $listCategories = (new CategoryJobs())->find()->fetch(true);
        foreach ($listCategories as $key => $listCategory) {
            $listCategory->count = (new Job())->find(
                "category = :category AND status = :status",
                "category={$listCategory->id}&status=post"
            )->count();
            if (!$listCategory->count) {
                unset($listCategories[$key]);
            }
        }

        echo $this->view->render("home", [
            "head" => $head,
            "jobs" => $jobs->order("rand()")->limit(5)->fetch(true),
            "slider" => $jobs->find("slider = 1")->order("rand()")->fetch(true),
            "categories" => $listCategories,
            "latest" => $jobs->find()->order("post_at DESC")->limit(999)->fetch(true),
        ]);
    }

    /**
     * SITE ABOUT US
     * @return void
     */
    public function about(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render("about", [
            "head" => $head
        ]);
    }

    /**
     * SITE ABOUT US
     * @return void
     */
    public function services(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render("services", [
            "head" => $head
        ]);
    }

    /**
     * SITE TEAM
     * @return void
     */
    public function team(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render("team", [
            "head" => $head,
            "expertsBoss" => (new User())->find("experts = 1 AND boss = 1")->order("id DESC")->fetch(true),
            "experts" => (new User())->find("experts = 1 AND boss != 1")->order("rand()")->fetch(true)
        ]);
    }

    // /**
    //  * SITE PEOPLE
    //  * @return void
    //  */
    // public function people(): void
    // {
    //     $head = $this->seo->render(
    //         CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
    //         CONF_SITE_DESC,
    //         url(),
    //         url("/shared/assets/images/share.png")
    //     );

    //     echo $this->view->render("people", [
    //         "head" => $head,
    //         "expertsBoss" => (new User())->find("experts = 1 AND boss = 1")->order("rand()")->fetch(true),
    //         "experts" => (new User())->find("experts = 1 AND boss != 1")->order("rand()")->fetch(true)
    //     ]);
    // }

    /**
     * SITE EXPERT (INDIVIDUAL)
     * @param array|null $data
     * @return void
     */
    public function expert(?array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        $data = filter_var_array($data, FILTER_UNSAFE_RAW);
        $expert = (new User())->findById($data["expert"]);

        if (!$expert || !$expert->experts) {
            redirect(url());
            return;
        }

        echo $this->view->render("expert", [
            "head" => $head,
            "expert" => $expert
        ]);
    }

    /**
     * SITE PROJECTS
     * @return void
     */
    public function projects(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        //Jobs Init
        $jobs = (new Job())->find();

        //Categories
        $listCategories = (new CategoryJobs())->find()->fetch(true);
        foreach ($listCategories as $key => $listCategory) {
            $listCategory->count = (new Job())->find(
                "category = :category AND status = :status",
                "category={$listCategory->id}&status=post"
            )->count();
            if (!$listCategory->count) {
                unset($listCategories[$key]);
            }
        }

        echo $this->view->render("projects", [
            "head" => $head,
            "categories" => $listCategories,
            "projects" => $jobs->order("rand()")->fetch(true),
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function project(array $data): void
    {
        $post = (new Job())->findByUri($data['uri']);
        if (!$post) {
            redirect("/404");
        }

        $user = Auth::user();
        if (!$user || $user->level < 5) {
            $post->views += 1;
            $post->save();
        }

        $head = $this->seo->render(
            "{$post->title} - " . CONF_SITE_NAME,
            $post->subtitle,
            url("/jobs/{$post->uri}"),
            ($post->cover ? image($post->cover, 1200, 628) : url("/shared/assets/images/share.png"))
        );

        //Categories
        $listCategories = (new CategoryJobs())->find()->fetch(true);
        foreach ($listCategories as $key => $listCategory) {
            $listCategory->count = (new Job())->find(
                "category = :category AND status = :status",
                "category={$listCategory->id}&status=post"
            )->count();
            if (!$listCategory->count) {
                unset($listCategories[$key]);
            }
        }

        //Related
        $related = (new Job())->find("category = :c AND id != :i", "c={$post->category}&i={$post->id}")->order("rand()")->limit(5)->fetch(true);
        if (empty($related)) {
            $related = (new Job())->find()->order("rand()")->limit(5)->fetch(true);
        }

        //Photos
        $scan = array_diff(scandir(__DIR__ . "/../../storage/images/projects/{$post->images}"), array('.', '..', '.DS_Store'));
        foreach ($scan as $photo) {
            $photos[] = "/images/projects/{$post->images}" . $photo;
        }

        echo $this->view->render("job-post", [
            "head" => $head,
            "post" => $post,
            "photos" => $photos,
            "related" => $related,
            "categories" => $listCategories,
            "random" => (new Job())->find()->order("rand()")->limit(3)->fetch(true)
        ]);
    }

    /**
     * SITE CONTACT
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public function contact(array $data): void
    {
        if (!empty($data['csrf'])) {

            if (empty($data["message"])) {
                $json["message"] = $this->message->warning("To send write your message.")->render();
                echo json_encode($json);
                return;
            }

            if (request_limit("webcontact", 3, 60 * 5)) {
                $json["message"] = $this->message->warning("Please allow 5 minutes to send new contacts, suggestions or complaints.")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("message", $data["message"])) {
                $json["message"] = $this->message->info("We have already received your message. Thank you for contacting us and we will respond shortly.")->render();
                echo json_encode($json);
                return;
            }

            $subject = "Contact: " . date_fmt("now", "Y-m-d H:i:s");
            $message = filter_var($data["message"], FILTER_UNSAFE_RAW);

            $view = new View(__DIR__ . "/../../shared/views/email");
            $body = $view->render("mail", [
                "subject" => $subject,
                "message" => "<h1>Contact</h1>" . "<br>" .
                    "Name: " . $data["name"] . "<br>" .
                    "E-mail: " . $data["email"] . "<br>" .
                    "Message: " . str_textarea($message) . "<br>"
            ]);

            (new Email())->bootstrap(
                $subject,
                $body,
                CONF_SITE_EMAIL,
                "Contact " . CONF_SITE_NAME
            )->send();

            $json["message"] = $this->message->success("We have received your message, {$data["name"]}. Thank you for contacting us, we will respond shortly.")->render();
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render("contact", [
            "head" => $head
        ]);
    }

    /**
     * SITE BOOKING
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public function booking(array $data): void
    {

        if (!empty($data['csrf'])) {

            if (empty($data["name"]) || empty($data["email"]) || empty($data["budget"]) || empty($data["message"])) {
                $json["message"] = $this->message->warning("Fill in the required fields.")->render();
                echo json_encode($json);
                return;
            }

            if (request_limit("booking", 3, 60 * 5)) {
                $json["message"] = $this->message->warning("Please allow 5 minutes to send a new booking.")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("message", $data["message"])) {
                $json["message"] = $this->message->info("We have already received your message. Thank you for contacting us and we will respond shortly.")->render();
                echo json_encode($json);
                return;
            }

            //Check Available
            $available = (new Booking())->find("date = :date AND (accepted = 1 OR accepted IS NULL)", "date={$data["dateTime"]}")->count();
            if ($available) {
                $json["message"] = $this->message->info("Unavailable. Try again with another date and time.")->render();
                echo json_encode($json);
                return;
            }

            //Mail
            $subject = "Consultation Request: " . date_fmt("now");
            $message = filter_var($data["message"], FILTER_UNSAFE_RAW);
            $content = "<h1>Consultation Request</h1>" . "<br>" .
                "Name: " . $data["name"] . "<br>" .
                "E-mail: " . $data["email"] . "<br>" .
                "Phone: " . $data["phone"] . "<br>" .
                "Type of Project: " . $data["projectType"] . "<br>" .
                "Budget: " . $data["budget"] . "<BR>" .
                "Message: " . str_textarea($message) . "<br>" .
                "Date and Time: <strong>" . $data["dateTime"] . "</strong>";

            $view = new View(__DIR__ . "/../../shared/views/email");
            $body = $view->render("mail", [
                "subject" => $subject,
                "message" => $content
            ]);

            (new Email())->bootstrap(
                $subject,
                $body,
                CONF_SITE_EMAIL,
                "Consultation Request " . CONF_SITE_NAME
            )->send();

            (new Email())->bootstrap(
                $subject,
                $body,
                $data["email"],
                "Consultation Request " . CONF_SITE_NAME
            )->send();

            //Notification Admin
            $notification = (new  Notification());
            $notification->email = $data["email"];
            $notification->content = $content;
            $notification->uri = "admin/booking/home";
            $notification->save();

            //Booking Admin
            $booking = (new Booking());
            $booking->date = $data["dateTime"];
            $booking->email = $data["email"];
            $booking->content = $content;
            $booking->save();

            $json["message"] = $this->message->success("We have received your booking request. We will respond as soon as possible.")->render();
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render("booking", [
            "head" => $head
        ]);
    }

    /**
     * SITE LOGIN (TO ADMIN)
     * @param array|null $data
     * @return void
     */
    public function login(?array $data): void
    {
        if (Auth::user()) {
            redirect("/app");
        }

        if (isset($data["otherAccount"])) {
            setcookie("authEmail", false, time() - 3600, "/");
            $json["reload"] = true;
            echo json_encode($json);
            return;
        }

        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Error to send, please use the form")->render();
                echo json_encode($json);
                return;
            }

            if (request_limit("weblogin", 5, 60 * 5)) {
                $json['message'] = $this->message
                    ->error("You have exceeded the attempt limit. Please, wait 5 minutes and try again!",)
                    ->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['email'])) {
                $json['message'] = $this->message->warning("Enter your email adress")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['password'])) {
                $json['message'] = $this->message->warning("Enter your password")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                (new Session())->unset("weblogin");

                $user = $auth->user();
                $user->ingress += 1;
                $user->save();

                $json['redirect'] = url("/app");
            } else {
                $json['message'] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $cookie = filter_input(INPUT_COOKIE, "authEmail");
        if ($cookie) {
            $user = (new User())->findByEmail($cookie);
            if ($user) {
                $name = $user->fullName();
                $photo = ($user->photo()
                    ? image($this->user->photo, 360, 360)
                    : url("/shared/assets/images/avatar.jpg")
                );
            }
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/shared/assets/images/share.png")
        );

        echo $this->view->render(($cookie ? "auth/lock" : "auth/signin"), [
            "head" => $head,
            "cookie" => $cookie,
            "name" => ($name ?? null),
            "photo" => ($photo ?? null)
        ]);
    }

    /**
     * SITE ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problems":
                $error->code = "Oops...";
                $error->title = "We are having problems!";
                $error->message = "It looks like our service is currently unavailable. We are already looking at it but if you need it, send us an email.";
                $error->linkTitle = "SEND E-MAIL";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "maintenence":
                $error->code = "Oops...";
                $error->title = "Sorry. We are under maintenance!";
                $error->message = "We'll be back soon! Right now we are working to improve our content.";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Content not available.";
                $error->message = "We're sorry, but the content you tried to access does not exist, is currently unavailable, or has been removed.";
                $error->linkTitle = "Keep browsing!";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            url("/shared/assets/images/share.png"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}
