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

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Entity;

use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

class Settings implements SettingsInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var SettingsType
     */
    protected $type;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->type = new SettingsType(SettingsType::TYPE_INPUT);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): ?string
    {
        return $this->getTranslation()->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function setContent(string $content): void
    {
        $this->getTranslation()->setContent($content);
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): TranslationInterface
    {
        return new SettingsTranslation();
    }

    /**
     * {@inheritdoc}
     */
    public function setType(SettingsType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return SettingsType
     */
    public function getType(): SettingsType
    {
        return $this->type;
    }
}
