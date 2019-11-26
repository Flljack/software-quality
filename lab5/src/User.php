<?php

final class User
{
    private $email;
    private $password;
    public $name;
    public $surname;
    public $dateOfBirth;

    private function __construct(string $email, string $password)
    {
        $this->ensureIsValidEmail($email);
        $this->ensureIsValidPassword($password);

        $this->password = $password;
        $this->email = $email;
    }

    public static function fromString(string $email, string $password)
    {
        return new self($email, $password);
    }

    public function addOptionalInformation(string $name = null, string $surname = null, DateTime $dateOfBirth = null)
    {
        if (!is_null($name)) {
            $this->name = $name;
        }
        if (!is_null($surname)) {
            $this->surname = $surname;
        }
        if (!is_null($dateOfBirth)) {
            $this->dateOfBirth = $dateOfBirth;
        }
        return $this;
    }

    private function ensureIsValidPassword(string $password)
    {
        if (!preg_match("/([0-9]+)/", $password)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" Not enough numbers',
                    $password
                )
            );
        }

        if (!preg_match("/([a-z]+)/", $password)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" Not enough small letters',
                    $password
                )
            );
        }
        if (!preg_match("/([A-Z]+)/", $password)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" Not enough capital letters',
                    $password
                )
            );
        }
    }

    private function ensureIsValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

    public function changePassword(string $currentPassword, string $newPassword)
    {
        if ($this->password === $currentPassword) {
            $this->ensureIsValidPassword($newPassword);
            $this->password = $newPassword;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" current password does not match',
                    $currentPassword
                )
            );
        }
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth->format('Y-m-d');
    }

    public function getPassword()
    {
        return $this->password;
    }
}