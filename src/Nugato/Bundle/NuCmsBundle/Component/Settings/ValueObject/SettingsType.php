<?php

/*
 * This file is part of the NuCms package.
 *
 * (c) Jacek Bednarek
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject;

use Nugato\Bundle\NuCmsBundle\Component\Settings\Exception\InvalidSettingsTypeException;

class SettingsType
{
    public const TYPE_INPUT = 'input';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPES = [self::TYPE_INPUT, self::TYPE_CHECKBOX];

    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    protected function validate(string $value)
    {
        if (!in_array($value, self::TYPES)) {
            throw new InvalidSettingsTypeException('Wrong settings type `'.$value.'`');
        }
    }
}
