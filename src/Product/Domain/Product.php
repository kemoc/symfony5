<?php
declare(strict_types=1);

namespace Product\Domain;

use Doctrine\ORM\Mapping as ORM;
/*
 * @ORM\Entity()
 */
class Product
{
    /**
     * @ORM\Id()
     * ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private int $id;

    /**
     *
     * @var string
     */
    private string $name;

    public function __construct(
        int $id,
        string $name,
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
