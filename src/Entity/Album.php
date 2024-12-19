<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $ref_artist = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'ref_comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $ref_album = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'ref_album')]
    private Collection $ref_comments;

    #[ORM\ManyToOne(inversedBy: 'ref_albums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $ref_artists = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'ref_albums')]
    private Collection $ref_playlist;

    public function __construct()
    {
        $this->ref_comments = new ArrayCollection();
        $this->ref_playlist = new ArrayCollection();
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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getRefArtist(): ?Artist
    {
        return $this->ref_artist;
    }

    public function setRefArtist(?Artist $ref_artist): static
    {
        $this->ref_artist = $ref_artist;

        return $this;
    }

    public function getRefAlbum(): ?self
    {
        return $this->ref_album;
    }

    public function setRefAlbum(?self $ref_album): static
    {
        $this->ref_album = $ref_album;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRefComments(): Collection
    {
        return $this->ref_comments;
    }

    public function addRefComment(self $refComment): static
    {
        if (!$this->ref_comments->contains($refComment)) {
            $this->ref_comments->add($refComment);
            $refComment->setRefAlbum($this);
        }

        return $this;
    }

    public function removeRefComment(self $refComment): static
    {
        if ($this->ref_comments->removeElement($refComment)) {
            // set the owning side to null (unless already changed)
            if ($refComment->getRefAlbum() === $this) {
                $refComment->setRefAlbum(null);
            }
        }

        return $this;
    }

    public function getRefArtists(): ?Artist
    {
        return $this->ref_artists;
    }

    public function setRefArtists(?Artist $ref_artists): static
    {
        $this->ref_artists = $ref_artists;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getRefPlaylist(): Collection
    {
        return $this->ref_playlist;
    }

    public function addRefPlaylist(Playlist $refPlaylist): static
    {
        if (!$this->ref_playlist->contains($refPlaylist)) {
            $this->ref_playlist->add($refPlaylist);
            $refPlaylist->addRefAlbum($this);
        }

        return $this;
    }

    public function removeRefPlaylist(Playlist $refPlaylist): static
    {
        if ($this->ref_playlist->removeElement($refPlaylist)) {
            $refPlaylist->removeRefAlbum($this);
        }

        return $this;
    }

}
