<?php

namespace Source\App\Admin;

use Source\Models\CategoryJobs;
use Source\Models\Job;
use Source\Models\User;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;

/**
 * Class Jobs
 * @package Source\App\Admin
 */
class Jobs extends Admin
{
    /**
     * Jobs constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/jobs/home/{$s}/1")]);
            return;
        }

        $search = null;
        $posts = (new Job())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $posts = (new Job())->find("MATCH(title, subtitle) AGAINST(:s)", "s={$search}");
            if (!$posts->count()) {
                $this->message->info("Your search returned no results.")->flash();
                redirect("/admin/jobs/home");
            }
        }

        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/jobs/home/{$all}/"));
        $pager->pager($posts->count(), 12, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Jobs",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/jobs/home", [
            "app" => "jobs/home",
            "head" => $head,
            "posts" => $posts->limit($pager->limit())->offset($pager->offset())->order("post_at DESC")->fetch(true),
            "paginator" => $pager->render(),
            "search" => $search
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function post(?array $data): void
    {
        //MCE Upload
        if (!empty($data["upload"]) && !empty($_FILES["image"])) {
            $files = $_FILES["image"];
            $upload = new Upload();
            $image = $upload->image($files, "post-" . time());

            if (!$image) {
                $json["message"] = $upload->message()->render();
                echo json_encode($json);
                return;
            }

            $json["mce_image"] = '<img style="width: 100%;" src="' . url("/storage/{$image}") . '" alt="{title}" title="{title}">';
            echo json_encode($json);
            return;
        }

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);

            $postCreate = new Job();
            $postCreate->author = $data["author"];
            $postCreate->category = $data["category"];
            $postCreate->slider = isset($data["slider"]) ? 1 : 0;
            $postCreate->title = $data["title"];
            $postCreate->uri = str_slug($postCreate->title);
            $postCreate->subtitle = $data["subtitle"];
            $postCreate->content = str_replace(["{title}"], [$postCreate->title], $content);
            $postCreate->video = $data["video"];
            $postCreate->status = $data["status"];
            $postCreate->post_at = date_fmt($data["post_at"]);

            //project images
            if (!empty($_FILES['project_images'])) {
                $projectImages = $_FILES['project_images'];
                $fileCount = count($projectImages["name"]);

                $uploadFileDir = __DIR__ . "/../../../storage/images/projects/";
                $nameDir = $postCreate->uri . "-" . time() . "/";
                $completeDir = $uploadFileDir . $nameDir;
                if (!file_exists($completeDir)) {
                    mkdir($completeDir);
                }

                for ($i = 0; $i < $fileCount; $i++) {

                    // get details of the uploaded file
                    $fileTmpPath = $_FILES['project_images']['tmp_name'][$i];
                    $fileName = $_FILES['project_images']['name'][$i];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));

                    // sanitize file-name
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                    //First file to set a cover
                    if (!isset($firstImage)) {
                        $firstImage = $newFileName;
                    }

                    // check if file has one of the following extensions
                    $allowedfileExtensions = array('jpg', 'png', 'jpeg');

                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        // directory in which the uploaded file will be moved
                        $dest_path = $completeDir . $newFileName;

                        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                            $json["message"] = $this->message->error("Failed to upload some images.")->render();
                            echo json_encode($json);
                            return;
                        }
                    } else {
                        $json["message"] = $this->message->error("Image extensions not allowed.")->render();
                        echo json_encode($json);
                        return;
                    }
                }
                $postCreate->images = $nameDir;
                $postCreate->cover = "images/projects/" . $nameDir . $firstImage;
            }

            //customer data
            $postCreate->client = $data["client"];
            $postCreate->project_name = $data["project_name"];
            $postCreate->project_number = $data["project_number"];
            $postCreate->address = $data["address"];

            //upload project file
            if (!empty($_FILES["project_file"])) {
                $files = $_FILES["project_file"];
                $upload = new Upload();
                $file = $upload->file($files, $postCreate->title);

                if (!$file) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $postCreate->project_file = $file;
            }

            if (!$postCreate->save()) {
                $json["message"] = $postCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Post published successfully...")->flash();
            $json["redirect"] = url("/admin/jobs/post/{$postCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $postEdit = (new Job())->findById($data["post_id"]);

            if (!$postEdit) {
                $this->message->error("You tried to update a post that doesn't exist or has been removed.")->flash();
                echo json_encode(["redirect" => url("/admin/jobs/home")]);
                return;
            }

            $postEdit->author = $data["author"];
            $postEdit->category = $data["category"];
            $postEdit->slider = isset($data["slider"]) ? 1 : 0;
            $postEdit->title = $data["title"];
            $postEdit->uri = str_slug($postEdit->title);
            $postEdit->subtitle = $data["subtitle"];
            $postEdit->content = str_replace(["{title}"], [$postEdit->title], $content);
            $postEdit->video = $data["video"];
            $postEdit->status = $data["status"];
            $postEdit->post_at = date_fmt($data["post_at"]);

            //project images
            if (!empty($_FILES['project_images'])) {
                $projectImages = $_FILES['project_images'];
                $fileCount = count($projectImages["name"]);

                $uploadFileDir = __DIR__ . "/../../../storage/images/projects/";
                $nameDir = ($postEdit->images ?? $postEdit->uri . "-" . time()) . "/";
                $completeDir = $uploadFileDir . $nameDir;
                if (!file_exists($completeDir)) {
                    mkdir($completeDir);
                }

                for ($i = 0; $i < $fileCount; $i++) {

                    // get details of the uploaded file
                    $fileTmpPath = $_FILES['project_images']['tmp_name'][$i];
                    $fileName = $_FILES['project_images']['name'][$i];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));

                    // sanitize file-name
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                    //First file to set a cover
                    if (!isset($firstImage)) {
                        $firstImage = $newFileName;
                    }

                    // check if file has one of the following extensions
                    $allowedfileExtensions = array('jpg', 'png', 'jpeg');

                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        // directory in which the uploaded file will be moved
                        $dest_path = $completeDir . $newFileName;

                        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                            $json["message"] = $this->message->error("Failed to upload some images.")->render();
                            echo json_encode($json);
                            return;
                        }
                    } else {
                        $json["message"] = $this->message->error("Image extensions not allowed.")->render();
                        echo json_encode($json);
                        return;
                    }
                }

                if (empty($postEdit->images)) {
                    $postEdit->images = $nameDir;
                }

                if (empty($postEdit->cover)) {
                    $postEdit->cover = "images/projects/" . $nameDir . $firstImage;
                }
            }

            //customer data
            $postEdit->client = $data["client"];
            $postEdit->project_name = $data["project_name"];
            $postEdit->project_number = $data["project_number"];
            $postEdit->address = $data["address"];

            //upload project file
            if (!empty($_FILES["project_file"])) {
                if ($postEdit->project_file && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postEdit->project_file}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postEdit->project_file}");
                }

                $files = $_FILES["project_file"];
                $upload = new Upload();
                $file = $upload->file($files, $postEdit->title);

                if (!$file) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $postEdit->project_file = $file;
            }

            if (!$postEdit->save()) {
                $json["message"] = $postEdit->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Post successfully updated...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete post
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $postDelete = (new Job())->findById($data["post_id"]);

            if (!$postDelete) {
                $this->message->error("You tried to delete a post that doesn't exist or has already been removed.")->flash();
                echo json_encode(["reload" => true]);
                return;
            }

            if ($postDelete->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postDelete->cover}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$postDelete->cover}");
                (new Thumb())->flush($postDelete->cover);
            }

            if (file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/images/projects/{$postDelete->images}")) {
                array_map('unlink', array_filter((array) glob(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/images/projects/{$postDelete->images}*")));
                rmdir(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/images/projects/{$postDelete->images}");
            }

            $postDelete->destroy();
            $this->message->success("The post was successfully deleted...")->flash();

            echo json_encode(["reload" => true]);
            return;
        }

        //delete image
        if (!empty($data["action"]) && $data["action"] == "deleteImage") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $image = __DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/images/projects/{$data["image"]}";

            if (file_exists($image)) {
                unlink($image);
            }

            echo json_encode(["reload" => true]);
            return;
        }

        //cover image
        if (!empty($data["action"]) && $data["action"] == "coverImage") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $image = "images/projects/{$data["image"]}";

            if (!file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/" . $image)) {
                $json["message"] = $this->message->error("Error on image.")->render();
                echo json_encode($json);
                return;
            }

            $postCover = (new Job())->findById($data["id"]);
            $postCover->cover = $image;
            if (!$postCover->save()) {
                $json["message"] = $this->message->error("Sorry, error on set image cover. Try again.")->render();
                echo json_encode($json);
                return;
            }

            echo json_encode(["reload" => true]);
            return;
        }

        $postEdit = null;
        if (!empty($data["post_id"])) {
            $postId = filter_var($data["post_id"], FILTER_VALIDATE_INT);
            $postEdit = (new Job())->findById($postId);
        }

        if (!empty($postEdit->images)) {
            $projectImages = array_diff(scandir(__DIR__ . "/../../../storage/images/projects/{$postEdit->images}"), array('.', '..'));
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($postEdit->title ?? "New Job"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/jobs/post", [
            "app" => "jobs/post",
            "head" => $head,
            "post" => $postEdit,
            "projectImages" => ($projectImages ?? null),
            "categories" => (new CategoryJobs())->find("type = :type", "type=post")->order("title")->fetch(true),
            "authors" => (new User())->find("level >= :level", "level=5")->fetch(true)
        ]);
    }

    /**
     * @param array|null $data
     */
    public function categories(?array $data): void
    {
        $categories = (new CategoryJobs())->find();
        $pager = new Pager(url("/admin/jobs/categories/"));
        $pager->pager($categories->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Categories",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/jobs/categories", [
            "app" => "jobs/categories",
            "head" => $head,
            "categories" => $categories->order("title")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function category(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);

            $categoryCreate = new CategoryJobs();
            $categoryCreate->title = $data["title"];
            $categoryCreate->uri = str_slug($categoryCreate->title);
            $categoryCreate->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, "jobs-category-" . $categoryCreate->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryCreate->cover = $image;
            }

            if (!$categoryCreate->save()) {
                $json["message"] = $categoryCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Category created successfully...")->flash();
            $json["redirect"] = url("/admin/jobs/category/{$categoryCreate->id}");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $categoryEdit = (new CategoryJobs())->findById($data["category_id"]);

            if (!$categoryEdit) {
                $this->message->error("You tried to edit a category that doesn't exist or has been removed.")->flash();
                echo json_encode(["redirect" => url("/admin/jobs/categories")]);
                return;
            }

            $categoryEdit->title = $data["title"];
            $categoryEdit->uri = str_slug($categoryEdit->title);
            $categoryEdit->description = $data["description"];

            //upload cover
            if (!empty($_FILES["cover"])) {
                if ($categoryEdit->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryEdit->cover}");
                    (new Thumb())->flush($categoryEdit->cover);
                }

                $files = $_FILES["cover"];
                $upload = new Upload();
                $image = $upload->image($files, "jobs-category-" . $categoryEdit->title);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $categoryEdit->cover = $image;
            }

            if (!$categoryEdit->save()) {
                $json["message"] = $categoryEdit->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Category updated successfully...")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_UNSAFE_RAW);
            $categoryDelete = (new CategoryJobs())->findById($data["category_id"]);

            if (!$categoryDelete) {
                $json["message"] = $this->message->error("The category does not exist or has been deleted before.")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->posts()->count()) {
                $json["message"] = $this->message->warning("It is not possible to remove because there are registered posts.")->render();
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->cover && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}")) {
                unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$categoryDelete->cover}");
                (new Thumb())->flush($categoryDelete->cover);
            }

            $categoryDelete->destroy();

            $this->message->success("The category has been successfully deleted...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }

        $categoryEdit = null;
        if (!empty($data["category_id"])) {
            $categoryId = filter_var($data["category_id"], FILTER_VALIDATE_INT);
            $categoryEdit = (new CategoryJobs())->findById($categoryId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Category",
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("widgets/jobs/category", [
            "app" => "jobs/categories",
            "head" => $head,
            "category" => $categoryEdit
        ]);
    }
}
