<?php

namespace Source\Support;

use Source\Core\Session;


/**
 * Class Message
 * @package Source\Support
 */
class Message
{
    /** @var string */
    private $type;

    /** @var string */
    private $title;

    /** @var string */
    private $text;

    /** @var string */
    private $class;

    /** @var string */
    private $dismiss;

    /** @var string */
    private $before;

    /** @var string */
    private $after;

    /**
     * @return string
     */
    public function __toString()
    {
        return "<div id='message'>{$this->getText()}</div>";
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->before . $this->text . $this->after;
    }

    /**
     * @return string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function getDismiss(): ?string
    {
        return $this->dismiss;
    }

    /**
     * @return Message
     */
    public function toast(): Message
    {
        $this->type = "toast";
        return $this;
    }

    /**
     * @return string|null
     */
    public function dismiss(bool $dismiss = false): Message
    {
        $this->dismiss = $dismiss;
        return $this;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function before(string $text): Message
    {
        $this->before = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return Message
     */
    public function after(string $text): Message
    {
        $this->after = $text;
        return $this;
    }

    /**
     * @param string $message
     * @param string $title
     * @return Message
     */
    public function info(string $message, ?string $title = null): Message
    {
        $this->class = "info";
        $this->title = $this->filter($title);
        $this->text = $this->filter($message);
        return $this;
    }


    /**
     * @param string $message
     * @param string $title
     * @return Message
     */
    public function success(string $message, string $title = null): Message
    {
        $this->class = "success";
        $this->title = $this->filter($title);
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @param string $title
     * @return Message
     */
    public function warning(string $message, string $title = null): Message
    {
        $this->class = "warning";
        $this->title = $this->filter($title);
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @param string $title
     * @return Message
     */
    public function error(string $message, string $title = null): Message
    {
        $this->class = "danger";
        $this->title = $this->filter($title);
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return object
     */
    public function render(): object
    {
        $message = new \stdClass();
        $message->type = $this->getType();
        $message->class = $this->getClass();
        $message->title = $this->getTitle();
        $message->text = $this->getText();
        return $message;
    }

    /**
     * Set flash Session Key
     */
    public function flash(): void
    {
        (new Session())->set("flash", $this->render());
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(?string $message): ?string
    {
        if ($message) {
            return filter_var($message, FILTER_UNSAFE_RAW);
        }
        return null;
    }
}
