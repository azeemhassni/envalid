<?php namespace azi\Rules;


use azi\Arguments;
use azi\Rules\Contracts\RuleInterface;

/**
 * Class Password
 *
 * @package azi\Rules
 */
class Password implements RuleInterface
{
    const NORMAL = 'normal';
    const MEDIUM = 'medium';
    const STRONG = 'strong';

    protected $message = null;

    /**
     * @param $field
     * @param $password
     * @param Arguments $args
     * @return mixed
     */
    public function validate($field, $password, Arguments $args)
    {
        $type = $args->getVariables();

        if ($type && $type != self::NORMAL) {
            return $this->is($type[ 0 ], $password);
        }

        return $this->isNormal($password);
    }

    /**
     * @param $strength
     * @param $password
     * @return bool
     */
    public function is($strength, $password)
    {
        $method = sprintf("is%s", ucwords($strength));
        return call_user_func([$this, $method], $password);
    }

    /**
     * @param $password
     * @return bool
     */
    public function isNormal($password)
    {
        if (strlen($password) < 8) {
            $this->message = '{field} must be at least 8 characters long';
            return false;
        }

        if (!preg_match("#[a-zA-Z]#", $password)) {
            $this->message = '{field} must contain at least one letter';
            return false;
        }


        return true;
    }

    /**
     * Checks a strong password
     *
     * @param $password
     * @return bool
     */
    public function isStrong($password)
    {
        if (!$this->isMedium($password)) {
            return false;
        }

        if (!preg_match("#[!@\#\$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]+#", $password)) {
            $this->message = '{field} must contain at least special character';
            return false;
        }

        return true;
    }

    /**
     * @param $password
     * @return bool
     */
    public function isMedium($password)
    {
        if (!$this->isNormal($password)) {
            return false;
        }

        if (!preg_match("#[a-z]#", $password)) {
            $this->message = '{field} must contain at least one lowercase letter';
            return false;
        }

        if (!preg_match("#[A-Z]#", $password)) {
            $this->message = '{field} must contain at least one uppercase letter';
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        return "{field} must be a good password";
    }
}