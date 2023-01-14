<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Booking
 * @package Source\Models
 */
class Booking extends Model
{
    /**
     * Booking constructor.
     */
    public function __construct()
    {
        parent::__construct("booking", ["id"], ["content", "date"]);
    }
}
