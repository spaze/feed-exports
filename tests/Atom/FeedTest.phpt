<?php
declare(strict_types = 1);

namespace Spaze\Exports\Atom;

use DateTimeImmutable;
use Spaze\Exports\Atom\Constructs\Person;
use Spaze\Exports\Atom\Constructs\Text;
use Spaze\Exports\Atom\Elements\Entry;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/** @testCase */
class FeedTest extends TestCase
{

	public function testToString(): void
	{
		$now = new DateTimeImmutable('2020-10-20 10:20:20 Europe/Prague');

		$feed = new Feed('https://url', 'Feed Title');
		$feed->setLinkSelf('https://url');
		$feed->setUpdated($now);
		$feed->setAuthor(new Person('foo bar'));

		$entry = new Entry(
			'https://href/1',
			new Text('<em>title-1</em>', Text::TYPE_HTML),
			new DateTimeImmutable('2019-12-20 12:20:20 Europe/Prague'),
			new DateTimeImmutable('2019-12-16 12:20:20 Europe/Prague'),
		);
		$entry->setContent(new Text('<strong>content-1</strong>'));
		$feed->addEntry($entry);

		$entry = new Entry(
			'https://href/2',
			new Text('<em>title-2</em>', Text::TYPE_HTML),
			new DateTimeImmutable('2018-12-20 12:20:20 Europe/Prague'),
			new DateTimeImmutable('2018-12-16 12:20:20 Europe/Prague'),
		);
		$entry->setContent(new Text('<strong>content-2</strong>'));
		$feed->addEntry($entry);

		Assert::same(file_get_contents(__DIR__ . '/feed.xml'), (string)$feed);
	}

}

$testCase = new FeedTest();
$testCase->run();
