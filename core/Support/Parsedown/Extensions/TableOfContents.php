<?php

namespace Parsedown\Extensions\TableOfContents;

use Parsedown;

class TableOfContents extends Parsedown
{
    /**
     * The contents list string instance.
     *
     * @var string
     */
    protected $contentsListString = '';

    /**
     * The first <li> level depth.
     *
     * @var integer
     */
    protected $firstHeadLevel = 0;

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

    /**
     * Retrieves the parsed file as string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->text($this->contentsListString) ?? "";
    }

    /**
     * Overrides the parent blockHeader method
     * to render markdown list.
     *
     * @param array $line
     * @return mixed
     */
    protected function blockHeader($line)
    {
        if (preg_match('/\#([A-Za-z0-9\-\.])/i', $line['body'])) {
            $block = parent::blockHeader($line);
            $text = $this->line($block['element']['text']) ?? "";
            $level = $block['element']['name'];

            $this->setContentsList([
                'text'  => $text,
                'level' => $level,
            ]);

            return $block;
        }
    }

    /**
     * Sets the Contents List.
     *
     * @param   string $content
     * @return  void
     */
    protected function setContentsList($content)
    {
        $text  = $this->qualifyLine($content['text']);
        $level = (integer) trim($content['level'], 'h');
        $link  = $content['text'];

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

    /**
     * Strips the given text of HTML tags.
     *
     * @param string $line
     * @return string
     */
    protected function qualifyLine($line): string
    {
        return trim(strip_tags($this->line($line)));
    }
}
