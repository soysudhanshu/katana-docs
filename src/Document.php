<?php

namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;

class Document
{
    protected MarkdownConverter $converter;

    public readonly string $content;

    public protected(set) array $tableOfContents = [];

    public function __construct(protected readonly string $markdown)
    {
        $environment = new Environment([]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new HeadingPermalinkExtension);

        $environment->addEventListener(DocumentParsedEvent::class, $this->generateTableOfContents(...));

        $this->converter = new MarkdownConverter($environment);

        $this->content = $this->converter->convert($this->markdown);
    }

    protected function generateTableOfContents(DocumentParsedEvent $event)
    {
        foreach ($event->getDocument()->iterator() as $node) {
            if ($node instanceof Heading && $node->getLevel() > 1) {
                $content = implode(
                    "",
                    array_map(fn($t) => $t->getLiteral(),  iterator_to_array($node->children()))
                );

                $this->tableOfContents[]  = [
                    'heading' => $content,
                    'level' => $node->getLevel(),
                ];
            }
        };
    }

    public function __toString()
    {
        return $this->content;
    }
}
