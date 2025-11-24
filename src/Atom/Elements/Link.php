<?php
declare(strict_types = 1);

namespace Spaze\Exports\Atom\Elements;

/**
 * Atom link element.
 *
 * @author Michal Špaček
 */
class Link
{

	/**
	 * @param int|null $length An advisory length of the linked content in octets
	 */
	public function __construct(
		private string $href,
		private ?LinkRel $rel = null,
		private ?string $type = null,
		private ?string $hreflang = null,
		private ?string $title = null,
		private ?int $length = null,
	) {
	}


	public function getHref(): string
	{
		return $this->href;
	}


	public function getRel(): ?LinkRel
	{
		return $this->rel;
	}


	public function getType(): ?string
	{
		return $this->type;
	}


	public function getHreflang(): ?string
	{
		return $this->hreflang;
	}


	public function getTitle(): ?string
	{
		return $this->title;
	}


	public function getLength(): ?int
	{
		return $this->length;
	}

}
