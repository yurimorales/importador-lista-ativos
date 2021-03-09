<?php

namespace App\Entity;

use App\Repository\TipoUsoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tb_tipo_uso")
 * @ORM\Entity(repositoryClass=TipoUsoRepository::class)
 */
class TipoUso
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity=Ativos::class, mappedBy="fkTipoUsoId")
     */
    private $ativos;

    public function __construct()
    {
        $this->ativos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|Ativos[]
     */
    public function getAtivos(): Collection
    {
        return $this->ativos;
    }

    public function addAtivo(Ativos $ativo): self
    {
        if (!$this->ativos->contains($ativo)) {
            $this->ativos[] = $ativo;
            $ativo->setFkTipoUsoId($this);
        }

        return $this;
    }

    public function removeAtivo(Ativos $ativo): self
    {
        if ($this->ativos->removeElement($ativo)) {
            // set the owning side to null (unless already changed)
            if ($ativo->getFkTipoUsoId() === $this) {
                $ativo->setFkTipoUsoId(null);
            }
        }

        return $this;
    }
}
