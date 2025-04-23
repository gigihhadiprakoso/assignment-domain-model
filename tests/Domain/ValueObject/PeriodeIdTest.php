<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\PeriodeId;

class PeriodeIdTest extends TestCase
{
    public function testCanBeCreatedWithValidId()
    {
        $id = '20241';
        $periodeId = new PeriodeId($id);

        $this->assertInstanceOf(PeriodeId::class, $periodeId);
        $this->assertEquals($id, $periodeId->id());
    }

    public function testThrowsExceptionWithNonNumericId()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid class PeriodeId format.");

        new PeriodeId('20A41');
    }

    public function testThrowsExceptionWithTooShortId()
    {
        $this->expectException(InvalidArgumentException::class);
        new PeriodeId('1234'); // 4 digit
    }

    public function testThrowsExceptionWithTooLongId()
    {
        $this->expectException(InvalidArgumentException::class);
        new PeriodeId('123456'); // 6 digit
    }

    public function testEqualsReturnsTrueForSameId()
    {
        $id = '20241';
        $periodeId1 = new PeriodeId($id);
        $periodeId2 = new PeriodeId($id);

        $this->assertTrue($periodeId1->equals($periodeId2));
    }

    public function testEqualsReturnsFalseForDifferentId()
    {
        $periodeId1 = new PeriodeId('20241');
        $periodeId2 = new PeriodeId('20242');

        $this->assertFalse($periodeId1->equals($periodeId2));
    }
}
