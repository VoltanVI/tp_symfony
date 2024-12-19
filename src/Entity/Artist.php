<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Album>
     */
    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: 'ref_artists')]
    private Collection $ref_albums;

    public function __construct()
    {
        $this->ref_albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getRefAlbums(): Collection
    {
        return $this->ref_albums;
    }

    public function addRefAlbum(Album $refAlbum): static
    {
        if (!$this->ref_albums->contains($refAlbum)) {
            $this->ref_albums->add($refAlbum);
            $refAlbum->setRefArtists($this);
        }

        return $this;
    }

    public function removeRefAlbum(Album $refAlbum): static
    {
        if ($this->ref_albums->removeElement($refAlbum)) {
            // set the owning side to null (unless already changed)
            if ($refAlbum->getRefArtists() === $this) {
                $refAlbum->setRefArtists(null);
            }
        }

        return $this;
    }
}
