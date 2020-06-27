<?php

namespace App\Traits;

trait SearchTrait
{
    /**
     * Replaces spaces with full text search wildcards.
     *
     * @param $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        $replaceSysbol = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($replaceSysbol, '', $term);

        $words = explode(' ', $term);
        if (is_array($words) && count($words)) {
            foreach ($words as $key => $word)
            {
                if (strlen($word) >= 1) {
                    $words[$key] = '+' . $word . '*';
                }
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    /**
     * Matches a full text search of term and orders by relevance.
     *
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);
        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $this->fullTextWildcards($term));

        return $query;
    }
}
