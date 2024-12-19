<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Album>
     */
    #[ORM\ManyToMany(targetEntity: Album::class, inversedBy: 'ref_playlist')]
    private Collection $ref_albums;

    public function __construct()
    {
        $this->ref_albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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
        }

        return $this;
    }

    public function removeRefAlbum(Album $refAlbum): static
    {
        $this->ref_albums->removeElement($refAlbum);

        return $this;
    }
}
