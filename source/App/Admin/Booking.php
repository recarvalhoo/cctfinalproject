<?php

namespace Source\App\Admin;

use Source\Core\View;
use Source\Models\Booking as ModelsBooking;
use Source\Models\User;
use Source\Support\Email;
use Source\Support\Thumb;
use Source\Support\Upload;

/**
 * Class Booking
 * @package Source\App\Admin
 */
class Booking extends Admin
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function home(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Usuários",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/booking/home", [
            "app" => "booking/home",
            "head" => $head,
            "booking" => (new ModelsBooking())->find()->fetch(true)
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function book(?array $data): void
    {
        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $bookDelete = (new ModelsBooking())->findById($data["id"]);

            if (!$bookDelete) {
                $this->message->error("You tried to delete a request that does not exist.")->flash();
                echo json_encode(["redirect" => url("/admin/booking/home")]);
                return;
            }

            $bookDelete->destroy();

            $this->message->success("Request deleted successfully!")->flash();
            echo json_encode(["redirect" => url("/admin/booking/home")]);

            return;
        }

        //reply
        if (!empty($data["action"]) && $data["action"] == "reply") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);

            $book = (new ModelsBooking())->findById($data["id"]);

            //Mail
            $subject = "Consultation Response: ";
            $view = new View(__DIR__ . "/../../../shared/views/email");
            $body = $view->render("mail", [
                "subject" => $subject,
                "message" => $data["content"]
            ]);

            $email = (new Email())->bootstrap(
                $subject,
                $body,
                $book->email,
                "Consultation Response " . CONF_SITE_NAME
            )->send();

            if (!$email) {
                $this->message->error("Error on reply. Try again...")->flash();
                echo json_encode(["redirect" => url("/admin/booking/home")]);
                return;
            }

            $book->accepted = $data["accept"];
            $book->save();

            $this->message->success("Response sent successfully.")->flash();
            echo json_encode(["redirect" => url("/admin/booking/home")]);
            return;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        if (!empty($data["book_id"])) {
            $bookId = filter_var($data["book_id"], FILTER_VALIDATE_INT);
            $book = (new ModelsBooking())->findById($bookId);
        }

        echo $this->view->render("widgets/booking/book", [
            "app" => "booking/book",
            "head" => $head,
            "book" => $book,
            "preview" => $book->content
        ]);
    }
}
