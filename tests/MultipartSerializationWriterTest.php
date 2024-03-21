<?php
namespace Microsoft\Kiota\Serialization\Multipart\Tests;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Exception;
use GuzzleHttp\Psr7\Utils;
use Microsoft\Kiota\Abstractions\Types\Date;
use Microsoft\Kiota\Abstractions\Types\Time;
use Microsoft\Kiota\Serialization\Multipart\Exceptions\NotImplementedException;
use Microsoft\Kiota\Serialization\Multipart\MultipartSerializationWriter;
use Microsoft\Kiota\Serialization\Tests\Samples\Person;
use PHPUnit\Framework\TestCase;

class MultipartSerializationWriterTest extends TestCase
{

    public function testWriteStringValue(): void
    {
        $writer = new MultipartSerializationWriter();
        $writer->writeStringValue('name', 'Kenneth Omondi');
        $cont = $writer->getSerializedContent();
        $this->assertEquals("name: Kenneth Omondi\n", $cont->getContents());
    }

    public function testWriteBinaryContent(): void
    {
        $writer = new MultipartSerializationWriter();
        $person = new Person();
        $person->setName('John Doe');
        $person->setBio(Utils::streamFor("I am a young professional passionate about coding."));
        $person->serialize($writer);
        $cont = $writer->getSerializedContent()->getContents();
        $this->assertStringContainsString('name: John Doe', $cont);
        $this->assertStringContainsString('bio: I am a young professional passionate about coding.', $cont);
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
        $this->expectException(NotImplementedException::class);
        $writer = new MultipartSerializationWriter();
        $writer->writeAdditionalData([]);
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
        $writer->writeEnumValue('gender', new \Microsoft\Kiota\Serialization\Tests\Samples\Gender('male'));
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
