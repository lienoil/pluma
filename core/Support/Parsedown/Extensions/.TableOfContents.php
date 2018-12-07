<?php

namespace Parsedown\Extensions\TableOfContents;

use Parsedown;

class TableOfContents extends Parsedown
{
    /**
     * Initialize the class constructor.
     * Performs the initial markdown parsing.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->text($file);
    }

    protected function fetchText($Text)
    {
        return trim(strip_tags($this->line($Text)));
    }

    protected function createAnchorID($Text)
    {
        return  urlencode($this->fetchText($Text));
    }

    #
    # contents list
    #
    function contentsList($Return_as = 'string')
    {
        if ('string' === strtolower($Return_as)) {
            $result = '';
            if (! empty($this->contentsListString)) {
                $result = $this->text($this->contentsListString);
            }
            return $result;
        } elseif ('json' === strtolower($Return_as)) {
            return json_encode($this->contentsListArray);
        } else {
            return $this->contentsListArray;
        }
    }

    #
    # Setters
    #
    protected function setContentsList($Content)
    {
        $this->setContentsListAsArray($Content);
        $this->setContentsListAsString($Content);
    }

    protected function setContentsListAsArray($Content)
    {
        $this->contentsListArray[] = $Content;
    }
    protected $contentsListArray = array();

    protected function setContentsListAsString($Content)
    {
        $text  = $this->fetchText($Content['text']);
        $id    = strtolower(str_replace('%23+', '', $Content['id']));
        $level = (integer) trim($Content['level'], 'h');
        $link  = $Content['text'];
        // if ($Content['text'] !== 'Alerts') {
        //     dd($text, $Content);
        // }

        if ($this->firstHeadLevel === 0) {
            $this->firstHeadLevel = $level;
        }
        $cutIndent = $this->firstHeadLevel - 1;
        if ($cutIndent > $level) {
            $level = 1;
        } else {
            $level = $level - $cutIndent;
        }

        $indent = str_repeat('  ', $level);

        $this->contentsListString .= "${indent}- ${link}\n";
    }
    protected $contentsListString = '';
    protected $firstHeadLevel = 0;

    /**
     * Overrides the parent blockHeader method
     * to render markdown list.
     *
     * @param array $line
     * @return array
     */
    protected function blockHeader($line): array
    {
        if (preg_match('/\#([A-Za-z0-9\-\.])/i', $line['body'])) {
            $block = parent::blockHeader($line);
            $text = $this->line($block['element']['text']) ?? "";
            $level = $block['element']['name'];
            $id = $this->createAnchorID($text);

            //Set attributes to head tags
            $block['element']['attributes'] = [
                'id'   => $id,
                'name' => $id,
            ];

            $this->setContentsList([
                'text'  => $text,
                'id'    => $id,
                'level' => $level,
            ]);

            return $block;
        }
    }
}
