<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="category")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity=CategoryAffiliate::class, mappedBy="category")
     */
    private $categoryAffiliates;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->categoryAffiliates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCategory($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCategory() === $this) {
                $job->setCategory(null);
            }
        }

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
            $categoryAffiliate->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryAffiliate(CategoryAffiliate $categoryAffiliate): self
    {
        if ($this->categoryAffiliates->removeElement($categoryAffiliate)) {
            // set the owning side to null (unless already changed)
            if ($categoryAffiliate->getCategory() === $this) {
                $categoryAffiliate->setCategory(null);
            }
        }

        return $this;
    }
}
