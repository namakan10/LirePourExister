<?php
/**
 * Created by IntelliJ IDEA.
 * User: Guest
 * Date: 11/17/2019
 * Time: 10:28 PM
 */

namespace App\Entity;


class BookSearch
{
    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $availability;


    /**
     * @var string|null
     */
    private $language;

    /**
     * @return null|string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param null|string $language
     */
    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }



    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $name
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    /**
     * @param null|string $availability
     */
    public function setAvailability(?string $availability): void
    {
        $this->availability = $availability;
    }


}