<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    //construct_ConstructUserClass_ReturnUserClass
    public function construct_ConstructUserClass_ReturnUserClass()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123'),
            'Ошибка в создании класса'
        );
    }

    public function EnsureIsValidPassword_InvalidPassowrdNullCapitalLatters_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'qwerty123');
    }

    public function EnsureIsValidPassword_InvalidPassowrdNullSmallLatters_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'QWERTY123');
    }

    public function EnsureIsValidPassword_InvalidPassowrdNullDigitals_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'Qwerty');
    }

    public function EnsureIsValidEmail_InvalidEmailByFilter_ReturnExceptionq()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('invalid', 'Qwerty123');
    }

    public function GetEmail_ReturnCurrentEmail()
    {
        $this->assertEquals(
            'user@example.com',
            User::fromString('user@example.com', 'Qwerty123')->getEmail(),
            'Email не совпадает с email при создании'
        );
    }

    public function GetPassword_ReturnCurrentPassword()
    {
        $this->assertEquals(
            'Qwerty123',
            User::fromString('user@example.com', 'Qwerty123')->getPassword(),
            'Password не совпадает с password при создании'
        );
    }

    public function AddOptionalInformation_mutationOptionalVars_ReturnUserClass()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryzanov', '1998-12-20')
        );
    }
    public function testMutationName()
    {
        $this->assertEquals(
            'Dmitry',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getName()
        );
    }

    public function testMutationSurname()
    {
        $this->assertEquals(
            'Ryazanov',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getSurname()
        );
    }

    public function testMutationDateOfBirth()
    {
        $this->assertEquals(
            '1998-12-20',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getDateOfBirth()
        );
    }

    public function testCanBeChangePassword()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->changePassword('Qwerty123', 'DimaNepobedima32')
        );
    }

    public function testCannotBeChangePassword()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->changePassword('Qwerty123', 'DimaNepobedima32')
        );
    }

    public function testMutationOnChangePassword()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'Qwerty123')->changePassword('Qwerty12345', 'DimaNepobedima32');
    }
}
