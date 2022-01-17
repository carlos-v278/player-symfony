<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
#[ORM\Entity(repositoryClass: MusicRepository::class)]
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */

class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title_m;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\ManyToOne(targetEntity: Album::class, inversedBy: 'musics')]
    #[ORM\JoinColumn(nullable: false)]
    private $album;

    #[ORM\ManyToOne(targetEntity: Artist::class, inversedBy: 'musics')]
    #[ORM\JoinColumn(nullable: false)]
    private $artist;

    #[ORM\Column(type: 'string', length: 255)]
    #[ORM\JoinColumn(nullable: false)]
    private $fileM;

    /**
     * @Vich\UploadableField(mapping="music_audios", fileNameProperty="fileM")
     * @var File
     */
    private $audioFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleM(): ?string
    {
        return $this->title_m;
    }

    public function setTitleM(string $title_m): self
    {
        $this->title_m = $title_m;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getFileM(): ?string
    {
        return $this->fileM;
    }

    public function setFileM(string $fileM): self
    {
        $this->fileM = $fileM;

        return $this;
    }

        public function setAudioFile(?File $audioFile = null): void
    {
    $this->audioFile = $audioFile;
    if (null !== $audioFile) {
        // It is required that at least one field changes if you are using doctrine
        // otherwise the event listeners won't be called and the file is lost
        $this->updatedAt = new \DateTimeImmutable();
    }
    }

    public function getAudioFile(): ?File
    {
    return $this->audioFile;
    }
}
