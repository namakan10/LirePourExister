<?php
/**
 * Created by IntelliJ IDEA.
 * User: Guest
 * Date: 11/9/2019
 * Time: 8:43 PM
 */

namespace App\Entity;


class ThemeSearch
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