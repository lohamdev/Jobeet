<?php

namespace App\Entity;

use App\Repository\AffiliateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AffiliateRepository::class)
 */
class Affiliate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=CategoryAffiliate::class, mappedBy="affiliate")
     */
    private $categoryAffiliates;

    public function __construct()
    {
        $this->categoryAffiliates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, CategoryAffiliate>
     */
    public function getCategoryAffiliates(): Collection
    {
        return $this->categoryAffiliates;
    }

    public function addCategoryAffiliate(CategoryAffiliate $categoryAffiliate): self
    {
        if (!$this->categoryAffiliates->contains($categoryAffiliate)) {
            $this->categoryAffiliates[] = $categoryAffiliate;
            $categoryAffiliate->setAffiliate($this);
        }

        return $this;
    }

    public function removeCategoryAffiliate(CategoryAffiliate $categoryAffiliate): self
    {
        if ($this->categoryAffiliates->removeElement($categoryAffiliate)) {
            // set the owning side to null (unless already changed)
            if ($categoryAffiliate->getAffiliate() === $this) {
                $categoryAffiliate->setAffiliate(null);
            }
        }

        return $this;
    }
}
