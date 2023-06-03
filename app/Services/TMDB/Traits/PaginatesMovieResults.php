<?php

namespace App\Services\TMDB\Traits;

trait PaginatesMovieResults
{
    public $current_page = 1;
    public $total_pages = 1;
    public $total_results = 0;
    public $search = '';


    public function nextPage()
    {
        $this->current_page++;
    }

    public function previousPage()
    {
        $this->current_page--;
    }
}
