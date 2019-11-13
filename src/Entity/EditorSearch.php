<?php
/**
 * Created by IntelliJ IDEA.
 * User: Guest
 * Date: 11/12/2019
 * Time: 6:57 PM
 */

namespace App\Entity;


class EditorSearch
{
    /**
     * @var string|null
     */
    private $name;


    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}