<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");

$route->get("/projects", "Web:projects");
$route->get("/about", "Web:about");
$route->get("/people", "Web:team");
$route->get("/team", "Web:team");
$route->get("/team/{expert}", "Web:expert");
$route->get("/services", "Web:services");
$route->get("/contact", "Web:contact");
$route->post("/contact", "Web:contact");
$route->get("/booking", "Web:booking");
$route->post("/booking", "Web:booking");

//jobs
$route->group(null);
$route->group("/jobs");
$route->get("/", "Web:jobs");
$route->get("/p/{page}", "Web:jobs");
$route->get("/{uri}", "Web:project");
$route->post("/buscar", "Web:jobsSearch");
$route->get("/buscar/{search}/{page}", "Web:jobsSearch");
$route->get("/categoria/{category}", "Web:jobsCategory");
$route->get("/categoria/{category}/{page}", "Web:jobsCategory");

/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//jobs
$route->get("/jobs/home", "Jobs:home");
$route->post("/jobs/home", "Jobs:home");
$route->get("/jobs/home/{search}/{page}", "Jobs:home");
$route->get("/jobs/post", "Jobs:post");
$route->post("/jobs/post", "Jobs:post");
$route->get("/jobs/post/{post_id}", "Jobs:post");
$route->post("/jobs/post/{post_id}", "Jobs:post");
$route->get("/jobs/categories", "Jobs:categories");
$route->get("/jobs/categories/{page}", "Jobs:categories");
$route->get("/jobs/category", "Jobs:category");
$route->post("/jobs/category", "Jobs:category");
$route->get("/jobs/category/{category_id}", "Jobs:category");
$route->post("/jobs/category/{category_id}", "Jobs:category");

//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");
$route->get("/users/home/{search}/{page}", "Users:home");
$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");
$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");
$route->get("/users/user/{user_id}/transactions", "Users:transactions");
$route->get("/users/user/{user_id}/trades", "Users:trades");

//booking
$route->get("/booking/home", "Booking:home");
$route->get("/booking/book/{book_id}", "Booking:book");
$route->post("/booking/book", "Booking:book");

//notification center
$route->post("/notifications/count", "Notifications:count");
$route->post("/notifications/list", "Notifications:list");

//END ADMIN
$route->namespace("Source\App");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
