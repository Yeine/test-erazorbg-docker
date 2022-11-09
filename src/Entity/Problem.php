<?php

namespace App\Entity;

use App\Repository\ProblemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProblemRepository::class)]
class Problem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'problems')]
    private Collection $otherProblems;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'otherProblems')]
    private Collection $problems;

    public function __construct()
    {
        $this->otherProblems = new ArrayCollection();
        $this->problems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getOtherProblems(): Collection
    {
        return $this->otherProblems;
    }

    public function addOtherProblem(self $otherProblem): self
    {
        if (!$this->otherProblems->contains($otherProblem)) {
            $this->otherProblems->add($otherProblem);
        }

        return $this;
    }

    public function removeOtherProblem(self $otherProblem): self
    {
        $this->otherProblems->removeElement($otherProblem);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProblems(): Collection
    {
        return $this->problems;
    }

    public function addProblem(self $problem): self
    {
        if (!$this->problems->contains($problem)) {
            $this->problems->add($problem);
            $problem->addOtherProblem($this);
        }

        return $this;
    }

    public function removeProblem(self $problem): self
    {
        if ($this->problems->removeElement($problem)) {
            $problem->removeOtherProblem($this);
        }

        return $this;
    }
}
