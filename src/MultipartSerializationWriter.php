<?php

namespace Microsoft\Kiota\Serialization\Multipart;

use DateInterval;
use DateTime;
use GuzzleHttp\Psr7\BufferStream;
use GuzzleHttp\Psr7\CachingStream;
use GuzzleHttp\Psr7\Stream;
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

    private CachingStream $writer;

    public function __construct()
    {
        $this->writer = new CachingStream(Utils::streamFor(null));
    }

    /**
     * @inheritDoc
     */
    public function writeStringValue(?string $key, ?string $value): void
    {
        if (!empty($key)) {
            $this->writer->write($key);
        }
        if ($value !== null && $key !== null) {
            $this->writer->write(": ");
        }
        if ($value != null) {
            $this->writer->write($value);
        }
        $this->writer->write("\n");
    }

    /**
     * @inheritDoc
     */
    public function writeBooleanValue(?string $key, ?bool $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeFloatValue(?string $key, ?float $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeIntegerValue(?string $key, ?int $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeDateTimeValue(?string $key, ?DateTime $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfObjectValues(?string $key, ?array $values): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeObjectValue(?string $key, ?Parsable $value, ?Parsable ...$additionalValuesToMerge): void
    {
        $tempWriter = $this->createNewWriter();
        if ($value !== null) {
            $this->serializeValue($this, $value);
        }

    }

    /**
     * @inheritDoc
     */
    public function getSerializedContent(): StreamInterface
    {
        $result = Utils::streamFor($this->writer);
        $this->writer->rewind();
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function writeEnumValue(?string $key, ?Enum $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfEnumValues(?string $key, ?array $values): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeNullValue(?string $key): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeAdditionalData(?array $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeDateValue(?string $key, ?Date $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeTimeValue(?string $key, ?Time $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeDateIntervalValue(?string $key, ?DateInterval $value): void
    {
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function writeCollectionOfPrimitiveValues(?string $key, ?array $value): void
    {
        throw new NotImplementedException(__METHOD__);
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
        if (!empty($value)) {
            $this->writer->write($value);
        }
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