<?php

namespace Microsoft\Kiota\Serialization\Multipart;

use DateInterval;
use DateTime;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\BufferStream;
use GuzzleHttp\Psr7\PumpStream;
use GuzzleHttp\Psr7\Utils;
use Microsoft\Kiota\Abstractions\Enum;
use Microsoft\Kiota\Abstractions\Serialization\Parsable;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;
use Microsoft\Kiota\Abstractions\Types\Date;
use Microsoft\Kiota\Abstractions\Types\Time;
use Microsoft\Kiota\Serialization\Multipart\Exceptions\NotImplementedException;
use Psr\Http\Message\StreamInterface;

class MultipartSerializationWriter implements SerializationWriter
{
    /** @var callable|null  */
    private $onAfterObjectSerialization = null;
    /** @var callable|null  */
    private $onBeforeObjectSerialization = null;
    /** @var callable|null */
    private $onStartObjectSerialization = null;

    private BufferStream $writer;

    public function __construct()
    {
        $this->writer = new BufferStream();
    }

    /**
     * @inheritDoc
     */
    public function writeStringValue(?string $key, ?string $value): void
    {
        // TODO: Implement writeStringValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeBooleanValue(?string $key, ?bool $value): void
    {
        // TODO: Implement writeBooleanValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeFloatValue(?string $key, ?float $value): void
    {
        // TODO: Implement writeFloatValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeIntegerValue(?string $key, ?int $value): void
    {
        // TODO: Implement writeIntegerValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeDateTimeValue(?string $key, ?DateTime $value): void
    {
        throw new NotImplementedException('writeDateTimeValue');
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfObjectValues(?string $key, ?array $values): void
    {
        throw new NotImplementedException('writeCollectionOfObjectValues');
    }

    /**
     * @inheritDoc
     */
    public function writeObjectValue(?string $key, ?Parsable $value, ?Parsable ...$additionalValuesToMerge): void
    {
        $tempWriter = $this->createNewWriter();


    }

    /**
     * @inheritDoc
     */
    public function getSerializedContent(): StreamInterface
    {
        return Utils::streamFor($this->writer);
    }

    /**
     * @inheritDoc
     */
    public function writeEnumValue(?string $key, ?Enum $value): void
    {
        // TODO: Implement writeEnumValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfEnumValues(?string $key, ?array $values): void
    {
        // TODO: Implement writeCollectionOfEnumValues() method.
    }

    /**
     * @inheritDoc
     */
    public function writeNullValue(?string $key): void
    {
        // TODO: Implement writeNullValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeAdditionalData(?array $value): void
    {
        // TODO: Implement writeAdditionalData() method.
    }

    /**
     * @inheritDoc
     */
    public function writeDateValue(?string $key, ?Date $value): void
    {
        // TODO: Implement writeDateValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeTimeValue(?string $key, ?Time $value): void
    {
        // TODO: Implement writeTimeValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeDateIntervalValue(?string $key, ?DateInterval $value): void
    {
        // TODO: Implement writeDateIntervalValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfPrimitiveValues(?string $key, ?array $value): void
    {
        // TODO: Implement writeCollectionOfPrimitiveValues() method.
    }

    /**
     * @inheritDoc
     */
    public function writeAnyValue(?string $key, $value): void
    {
        // TODO: Implement writeAnyValue() method.
    }

    /**
     * @inheritDoc
     */
    public function writeBinaryContent(?string $key, ?StreamInterface $value): void
    {
        // TODO: Implement writeBinaryContent() method.
    }

    /**
     * @inheritDoc
     */
    public function setOnBeforeObjectSerialization(?callable $value): void
    {
        $this->onBeforeObjectSerialization = $value;
    }

    /**
     * @inheritDoc
     */
    public function getOnBeforeObjectSerialization(): ?callable
    {
        return $this->onBeforeObjectSerialization;
    }

    /**
     * @inheritDoc
     */
    public function setOnAfterObjectSerialization(?callable $value): void
    {
        $this->onAfterObjectSerialization = $value;
    }

    /**
     * @inheritDoc
     */
    public function getOnAfterObjectSerialization(): ?callable
    {
        return $this->onAfterObjectSerialization;
    }

    /**
     * @inheritDoc
     */
    public function setOnStartObjectSerialization(?callable $value): void
    {
        $this->onStartObjectSerialization = $value;
    }

    /**
     * @inheritDoc
     */
    public function getOnStartObjectSerialization(): ?callable
    {
        return $this->onStartObjectSerialization;
    }

    /**
     * @param MultipartSerializationWriter $writer
     * @template T of Parsable
     * @param T $value
     * @return void
     */
    public function serializeValue(MultipartSerializationWriter $writer, $value): void
    {
        if ($this->onBeforeObjectSerialization !== null) {
            call_user_func($this->onBeforeObjectSerialization, $value);
        }
        $value->serialize($writer);
        if ($this->onStartObjectSerialization !== null) {
            call_user_func($this->onStartObjectSerialization, $value);
        }
    }

    private function createNewWriter(): MultipartSerializationWriter
    {
        $writer = new MultipartSerializationWriter();
        $writer->onBeforeObjectSerialization = $this->onBeforeObjectSerialization;
        $writer->onAfterObjectSerialization = $this->onAfterObjectSerialization;
        $writer->onStartObjectSerialization = $this->onStartObjectSerialization;
        return $writer;
    }
}