<?php
namespace App\Entity\Traits;


    use Monolog\DateTimeImmutable;

    trait Timestampable
    {

        #[ORM\Column(type:'datatime_immutable', option: ['default'=>'CURRENT_TIMESTAMP'])]
        private $createdAt;

        #[ORM\Column(type:'datatime_immutable', option: ['default'=>'CURRENT_TIMESTAMP'])]
        private $updatedAt;


        public function getCreatedAt(): ?\DateTimeInterface
        {
            return $this->createdAt;
        }
    
        public function setCreatedAt(\DateTimeInterface $createdAt): self
        {
            $this->createdAt = $createdAt;
    
            return $this;
        }
    
        public function getUpdatedAt(): ?\DateTimeInterface
        {
            return $this->updatedAt;
        }
    
        public function setUpdatedAt(\DateTimeInterface $updatedAt): self
        {
            $this->updatedAt = $updatedAt;
    
            return $this;
        }
    

        /**
         * @ORM\PrePersist
         * @ORM\PreUpdate
         */
        public function updateTimestamps(): ?DateTimeImmutable
        {
            if ($this->getCreatedAt() == null) {

            $this->setCreatedAt(new \DateTimeImmutable);
            }
            
            $this->setUpdatedAt(new \DateTimeImmutable);
        }

    }

