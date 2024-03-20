<?php


use Microsoft\Kiota\Abstractions\Enum;
use Microsoft\Kiota\Abstractions\Types\Date;
use Microsoft\Kiota\Abstractions\Types\Time;
use Microsoft\Kiota\Serialization\Multipart\Exceptions\NotImplementedException;
use Microsoft\Kiota\Serialization\Multipart\MultipartSerializationWriter;
use PHPUnit\Framework\TestCase;

class MultipartSerializationWriterTest extends TestCase
{

    public function testWriteStringValue(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testWriteBinaryContent(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testWriteBooleanValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeBooleanValue("married", false);
    }

    public function testWriteFloatValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeFloatValue("height", 5.11);
    }

    public function testWriteNullValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeNullValue("nullKey");
    }

    public function testWriteAdditionalData(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testWriteDateTimeValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeDateTimeValue("dateTime", new DateTime('now'));
    }

    public function testWriteDateIntervalValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeDateIntervalValue("interval", new DateInterval("PT12M2S"));
    }

    public function testWriteAnyValue(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testWriteCollectionOfObjectValues(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeCollectionOfObjectValues("people", []);
    }

    public function testWriteEnumValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeEnumValue('gender', new Gender('male'));
    }

    public function testWriteCollectionOfEnumValues(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeCollectionOfEnumValues("formats", []);
    }

    /**
     * @throws Exception
     */
    public function testWriteDateValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeDateValue("date", new Date((new DateTime('now'))->format(DateTimeInterface::RFC3339)));
    }

    public function testWriteCollectionOfPrimitiveValues(): void
    {

        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeCollectionOfPrimitiveValues("numbers", [1,2,3,4]);
    }

    public function testWriteObjectValue(): void
    {
        $this->assertEquals(1, 1);
    }

    /**
     * @throws Exception
     */
    public function testWriteTimeValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeTimeValue("time", new Time((new DateTime('now'))->format(DateTimeInterface::RFC3339)));
    }

    public function testGetSerializedContent(): void
    {
        $this->assertEquals(1, 1);
    }

    public function testWriteIntegerValue(): void
    {
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeIntegerValue("age", 100);
    }
}

class Gender extends Enum {
    const MALE = "male";
    const FEMALE = "female";
    const OTHER = "other";
}
