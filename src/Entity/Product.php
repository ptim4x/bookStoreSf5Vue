<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ApiResource(
    attributes: ["order" => ["title" => "ASC"]],
    normalizationContext: ['groups' => ['read:product']],
    itemOperations: ['get'],
    collectionOperations: ['get'],
)]
class Product
{
    public const MAX_YEAR = '2023';
    public const MIN_RANKING = 0;
    public const MAX_RANKING = 10;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:product"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:product"})
     */
    #[Assert\Length(['max' => 255, 'maxMessage' => "Le titre est trop long."])]
    private $title;

    /**
     * @ORM\Column(type="string", length=3)
     * @Groups({"read:product"})
     */
    #[Assert\Country(['alpha3' => true, 'message' => "Le code pays doit être au format ISO 3166-1 alpha-3 (Code pays à 3 caractères)."])]
    private $country;

    /**
     * @ORM\Column(type="string", length=4)
     * @Groups({"read:product"})
     */
    #[Assert\LessThanOrEqual(['value' => self::MAX_YEAR, 'message' => "L'année doit être cohérente (inférieur ou égale à {{ value }})."])]
    private $year;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     * @Groups({"read:product"})
     */
    #[Assert\Length(['max' => 250, 'maxMessage' => "Le titre original ne doit pas dépasser {{ max }} caractères."])]
    #[Assert\Expression(['expression' => "this.getCountry() == 'FRA' or value != ''", 'message' => "Le titre original est obligatoire si la nationalité n'est pas France (FRA)."])]
    private $original_title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:product"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class)
     */
    #[Assert\Count(['min' => 1, 'minMessage' => 'Au moins un genre est requis.'])]
    private $genre;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"read:product"})
     */
    #[Assert\Range(['min' => self::MIN_RANKING, 'max' => self::MAX_RANKING, 'notInRangeMessage' => 'La note doit être comprise entre {{ min }} et {{ max }}.'])]
    private $ranking;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     * @Groups({"read:product"})
     */
    #[Assert\Positive(['message' => 'Le prix doit être un nombre positif.'])]
    private $price;

    /**
     * @ORM\Column(type="product_type_enum")
     * @Groups({"read:product"})
     */
    #[Assert\Choice(['callback' => [ 'App\DBAL\Types\ProductTypeEnumType', 'getValues' ]])]
    private $product_type;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    public function setOriginalTitle(?string $original_title): self
    {
        $this->original_title = $original_title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    /**
     * @Groups({"read:product"})
     * @SerializedName("genre")
     * @return string[]
     */
    public function getGenreNames(): array
    {
        $genres=[];
        foreach($this->genre as $genre) {
            $genres[] = $genre->getName();
        }

        return $genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setRanking(int $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function setProductType($product_type): self
    {
        $this->product_type = $product_type;

        return $this;
    }
}
