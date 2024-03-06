<?php

namespace Microsoft\Kiota\Serialization\Multipart;

use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriterFactory;

class MultipartSerializationWriterFactory implements SerializationWriterFactory
{

    /**
     * @inheritDoc
     */
    public function getSerializationWriter(string $contentType): SerializationWriter
    {
        // TODO: Implement getSerializationWriter() method.
    }

    /**
     * @inheritDoc
     */
    public function getValidContentType(): string
    {
        // TODO: Implement getValidContentType() method.
    }
}