<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use symfony\Component\String\Slugger\SluggerInterface;

trait SlugTrait
{

    #[ORM\Column(type: 'string', length: 255)]
    private string $slug;

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?String
    {
        return $this->slug;
    }
}

