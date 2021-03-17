<?php

namespace App\Entity;

use App\Repository\AtivosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tb_ativos")
 * @ORM\Entity(repositoryClass=AtivosRepository::class)
 */
class Ativos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default": 2020})
     */
    private $ano;

    /**
     * @ORM\ManyToOne(targetEntity=TipoUso::class, inversedBy="ativos")
     * @ORM\JoinColumn(name="fk_tipo_uso_id", referencedColumnName="id")
     */
    private $fkTipoUsoId;

    /**
     * @ORM\ManyToOne(targetEntity=Categorias::class, inversedBy="ativos")
     * @ORM\JoinColumn(name="fk_categorias_id", referencedColumnName="id")
     */
    private $fkCategoriasId;
    
    /**
     * @ORM\Column(name="descricao_destaque", type="text", nullable=true)
     */
    private $descricao_destaque;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(name="sugestao_posologica", type="text", nullable=true)
     */
    private $sugestao_posologica;

    /**
     * @ORM\Column(name="link_artigo", type="text")
     */
    private $link_artigo;

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

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(?int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    public function getFkTipoUsoId(): ?TipoUso
    {
        return $this->fkTipoUsoId;
    }

    public function setFkTipoUsoId(?TipoUso $fkTipoUsoId): self
    {
        $this->fkTipoUsoId = $fkTipoUsoId;

        return $this;
    }

    public function getDescricaoDestaque(): ?string
    {
        return $this->descricao_destaque;
    }

    public function setDescricaoDestaque(?string $descricao_destaque): self
    {
        $this->descricao_destaque = $descricao_destaque;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getSugestaoPosologica(): ?string
    {
        return $this->sugestao_posologica;
    }

    public function setSugestaoPosologica(?string $sugestao_posologica): self
    {
        $this->sugestao_posologica = $sugestao_posologica;

        return $this;
    }

    public function getLinkArtigo(): ?string
    {
        return $this->link_artigo;
    }

    public function setLinkArtigo(string $link_artigo): self
    {
        $this->link_artigo = $link_artigo;

        return $this;
    }

    public function getFkCategoriasId(): ?Categorias
    {
        return $this->fkCategoriasId;
    }

    public function setFkCategoriasId(?Categorias $fkCategoriasId): self
    {
        $this->fkCategoriasId = $fkCategoriasId;

        return $this;
    }

}
