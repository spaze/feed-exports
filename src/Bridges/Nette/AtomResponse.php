<?php
declare(strict_types = 1);

namespace Spaze\Exports\Bridges\Nette\Atom;

use Nette\Application\Response;
use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Spaze\Exports\Atom\AtomResponseContentType;
use Spaze\Exports\Atom\Feed;

/**
 * Atom export response.
 *
 * @author Michal Špaček
 */
class AtomResponse implements Response
{

	public function __construct(
		private Feed $feed,
	) {
	}


	public function send(IRequest $httpRequest, IResponse $httpResponse): void
	{
		$httpResponse->setContentType(AtomResponseContentType::ApplicationAtomXml->value, 'utf-8');
		$feed = (string)$this->feed;
		$httpResponse->setHeader('Content-Length', (string)strlen($feed));
		echo $feed;
	}

}
