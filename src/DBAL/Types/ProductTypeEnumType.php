<?php
namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ProductTypeEnumType extends AbstractEnumType
{
    public const BOOK = 'book';
    public const EBOOK = 'ebook';
    public const AUDIO_BOOK = 'audio-book';

    protected static $choices = [
        self::BOOK => 'Livre',
        self::EBOOK => 'Livre électronique',
        self::AUDIO_BOOK => 'Livre audio'
    ];
}