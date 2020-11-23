<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Collection;

use Doctrine\Common\Collections as DoctrineCollections;
use Itspire\Common\Util\EquatableInterface;

class CollectionWrapper implements CollectionWrapperInterface
{
    use CollectionHolderTrait;

    /** Supported Class FQDN */
    private string $supportedClass;
    protected ?DoctrineCollections\Collection $elements = null;

    public function __construct(string $supportedClass, ?array $elements = [])
    {
        if (false === strpos($supportedClass, '\\')) {
            throw new \InvalidArgumentException('Invalid fully qualified class name : ' . $supportedClass);
        }

        $this->supportedClass = $supportedClass;

        if (!empty($elements)) {
            foreach ($elements as $element) {
                $this->checkElementIsValid($element);
            }
        }

        $this->elements = new DoctrineCollections\ArrayCollection($elements);
    }

    public function addElement(EquatableInterface $element): self
    {
        $this->initListIfNull($this->elements);

        $this->checkElementIsValid($element);

        if (
            0 === $this->getElements()->count()
            || false === $this->checkEquatableExists($this->elements, $element)
        ) {
            $this->elements->add($element);
        }

        return $this;
    }

    public function removeElement(EquatableInterface $element): self
    {
        $this->initListIfNull($this->elements);

        $this->checkElementIsValid($element);

        $filteredElements = $this->filterEquatableExists($this->elements, $element);

        if (1 <= $filteredElements->count()) {
            foreach ($filteredElements as $filteredElement) {
                $this->elements->removeElement($filteredElement);
            }
        }

        return $this;
    }

    public function getElements(): DoctrineCollections\Collection
    {
        return $this->initListIfNull($this->elements);
    }

    private function initListIfNull(?DoctrineCollections\Collection $list): DoctrineCollections\Collection
    {
        $list ??= new DoctrineCollections\ArrayCollection();

        return $list;
    }

    private function checkElementIsValid(EquatableInterface $element): void
    {
        if (!is_a($element, $this->supportedClass) || !$element instanceof EquatableInterface) {
            throw new \InvalidArgumentException(
                'At least one element you tried to add to the collection is not an instance of ' . $this->supportedClass
            );
        }
    }
}
