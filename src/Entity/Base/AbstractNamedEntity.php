<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

#[UniqueEntity('name', message: "This name is already in use.")]
#[UniqueEntity('slug', message: "This slug is already in use.")]
abstract class AbstractNamedEntity extends AbstractNameableEntity implements Stringable {

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Please provide a name.")]
    #[Assert\Length(max: 255, maxMessage: "That name is too long.")]
    protected ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Please provide a slug.")]
    #[Assert\Length(max: 255, maxMessage: "That slug is too long.")]
    #[Assert\Regex(pattern: "/^[a-zA-Z0-9]+$/", message: "A slug can only contain letters and digits.")]
    protected ?string $slug = null;

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = u($name)->collapseWhitespace();

        return $this;
    }

    public function getSlug(): ?string {
        return $this->slug;
    }

    public function setSlug(string $slug): static {
        $this->slug = trim($slug);

        return $this;
    }

    public function __toString(): string {
        return $this->name;
    }

}