<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    //construct_ConstructUserClass_ReturnUserClass
    public function testConstruct_ConstructUserClass_ReturnUserClass()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123'),
            'Невалид пароль или email'
        );
    }

    public function testEnsureIsValidPassword_InvalidPassowrdNullCapitalLatters_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'qwerty123');
    }

    public function testEnsureIsValidPassword_InvalidPassowrdNullSmallLatters_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'QWERTY123');
    }

    public function testEnsureIsValidPassword_InvalidPassowrdNullDigitals_ReturnException()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'Qwerty');
    }

    public function testEnsureIsValidEmail_InvalidEmailByFilter_ReturnExceptionq()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('invalid', 'Qwerty123');
    }

    public function testGetEmail_ReturnCurrentEmail()
    {
        $this->assertEquals(
            'user@example.com',
            User::fromString('user@example.com', 'Qwerty123')->getEmail(),
            'Email не совпадает с email при создании'
        );
    }

    public function testGetPassword_ReturnCurrentPassword()
    {
        $this->assertEquals(
            'Qwerty123',
            User::fromString('user@example.com', 'Qwerty123')->getPassword(),
            'Password не совпадает с password при создании'
        );
    }

    public function testAddOptionalInformation_mutationOptionalVars_ReturnUserClass()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryzanov')
        );
    }
    public function testGetName_MutationAndGetName_String()
    {
        $this->assertEquals(
            'Dmitry',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getName(),
            'Мутация не изменила параметр класса'
        );
    }

    public function testGetSurname_MutationAndGetSurname_String()
    {
        $this->assertEquals(
            'Ryazanov',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getSurname(),
            'Мутация не изменила параметр класса'
        );
    }

    public function testGetDateOfBirth_MutationAndGetDateOfBirth_String()
    {
        $this->assertEquals(
            '1998-12-20',
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry', 'Ryazanov', DateTime::createFromFormat('Y-m-d', '1998-12-20'))->getDateOfBirth(),
            'Мутация не изменила параметр класса'
        );
    }

    public function testChangePassword_changePassword_UserClass()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->changePassword('Qwerty123', 'DimaNepobedima32'),
            'Пароль не совпадает с текущим либо новый пароль не соотвествует требованиям'
        );
    }

    public function testChangePassword_changePassword_Exception()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'Qwerty123')->changePassword('Qwerty12345', 'DimaNepobedima32');
    }
}
