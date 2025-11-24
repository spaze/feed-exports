<?php
declare(strict_types = 1);

namespace Spaze\Exports\Atom\Constructs;

/**
 * Atom text construct.
 *
 * @author Michal Špaček
 */
class Text
{

	public function __construct(
		private string $text,
		private ?TextType $type = null,
	) {
	}


	public function getText(): string
	{
		return $this->text;
	}


	public function getType(): ?TextType
	{
		return $this->type;
	}

}
