<?php

namespace App\Models;

class News
{
    private string $title;
    private string $description;
    private string $url;
    private ?string $picture;

    public function __construct(string $title, string $description, string $url, ?string $picture=null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->picture = $picture;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }
}