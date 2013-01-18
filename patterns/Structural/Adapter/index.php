<?php

class Search
{
    protected $word;
    protected $text;

    public function __construct($word, $text)
    {
        $this->word = $word;
        $this->text = $text;
    }

    public function getSearchWord()
    {
        return $this->word;
    }

    public function getSearchText()
    {
        return $this->text;
    }
}

class SearchAdapter
{
    protected $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    public function getSearchWordInText()
    {
        return 'This word "' . $this->search->getSearchWord() . '" was found in text : ' . $this->search->getSearchText();
    }
}

$search = new Search('some', 'some text');

$searchAdapter = new SearchAdapter($search);
echo $searchAdapter->getSearchWordInText();
