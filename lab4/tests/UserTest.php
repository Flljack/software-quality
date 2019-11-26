<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAndPassword()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')
        );
    }

    public function testCannotBeCreatedFromInvalidsSmallLettersPassword()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'qwerty123');
    }

    public function testCannotBeCreatedFromInvalidsCapitalLettersPassword()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'QWERTY123');
    }

    public function testCannotBeCreatedFromInvalidsOnlyLettersPassword()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('user@example.com', 'Qwerty');
    }

    public function testCannotBeCreatedFromInvalidEmailAddress()
    {
        $this->expectException(InvalidArgumentException::class);

        User::fromString('invalid', 'Qwerty123');
    }

    public function testCanBeUsedGetEmail()
    {
        $this->assertEquals(
            'user@example.com',
            User::fromString('user@example.com', 'Qwerty123')->getEmail()
        );
    }

    public function testCanBeUsedGetPassword()
    {
        $this->assertEquals(
            'Qwerty123',
            User::fromString('user@example.com', 'Qwerty123')->getPassword()
        );
    }

    public function testCanBeAddOptionalInformationOnlyName()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation('Dmitry')
        );
    }

    public function testCanBeAddOptionalInformationOnlySurname()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation(null, 'Ryazanov')
        );
    }

    public function testCanBeAddOptionalInformationOnlyDateOfBirth()
    {
        $this->assertInstanceOf(
            User::class,
            User::fromString('user@example.com', 'Qwerty123')->addOptionalInformation(null, null, DateTime::createFromFormat('Y-m-d', '1998-12-20'))
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
